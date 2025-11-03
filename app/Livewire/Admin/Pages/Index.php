<?php
namespace App\Livewire\Admin\Pages;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;
use App\Support\Uploads;

class Index extends Component
{
    use WithFileUploads, Uploads, AuthorizesRequests;

    public $editingId=null,$slug='',$title='',$subtitle='',$type='standard',$is_published=true,$body='';
    public $hero_image='',$hero_video_url='',$hero_video_poster='';
    public $meta_title='',$meta_description='',$og_image='';

    public $hero_file;
    public $og_file;
    public $video_file;
    public $poster_file;

    protected function rules(){
        return [
            'slug'              => 'required|min:2',
            'title'             => 'required|min:2',
            'subtitle'          => 'nullable|string',
            'type'              => 'required|in:standard,landing',
            'is_published'      => 'boolean',
            'body'              => 'nullable|string',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
            'hero_file'         => 'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
            'og_file'           => 'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
            'video_file'        => 'nullable|file|mimetypes:video/mp4|max:51200',
            'poster_file'       => 'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }

    public function edit($id){
        $this->authorize('update', Page::class);

        $p=Page::findOrFail($id);
        $this->editingId          = $p->id;
        $this->slug               = $p->slug;
        $this->title              = $p->title;
        $this->subtitle           = $p->subtitle;
        $this->type               = $p->type;
        $this->hero_image         = $p->hero_image;
        $this->hero_video_url     = $p->hero_video_url;
        $this->hero_video_poster  = $p->hero_video_poster;
        $this->is_published       = $p->is_published;
        $this->body               = $p->body;
        $this->meta_title         = $p->meta_title;
        $this->meta_description   = $p->meta_description;
        $this->og_image           = $p->og_image;
    }

    public function clearHero(){ $this->hero_image=''; }
    public function clearOg(){ $this->og_image=''; }
    public function clearVideo(){ $this->hero_video_url=''; $this->hero_video_poster=''; }

    protected function tryGeneratePosterFromVideo(string $storedRelativePath): ?string
    {
        try {
            $absoluteSource = Storage::disk('public')->path($storedRelativePath);

            $posterName = pathinfo($storedRelativePath, PATHINFO_FILENAME).'_poster.jpg';
            $posterRel  = 'pages/video-posters/'.$posterName;
            $posterAbs  = Storage::disk('public')->path($posterRel);

            $cmd = [
                'ffmpeg',
                '-i', $absoluteSource,
                '-ss', '00:00:00.500',
                '-vframes', '1',
                $posterAbs,
            ];

            @exec(implode(' ', array_map('escapeshellarg',$cmd)), $out, $code);

            if($code === 0 and file_exists($posterAbs)){
                return $posterRel;
            }
        } catch (\Throwable $e) {}
        return null;
    }

    public function save(){
        $this->authorize($this->editingId ? 'update' : 'create', Page::class);

        $this->validate();

        $p = Page::updateOrCreate(['id'=>$this->editingId],[
            'slug'              => $this->slug,
            'title'             => $this->title,
            'subtitle'          => $this->subtitle,
            'type'              => $this->type,
            'is_published'      => $this->is_published,
            'body'              => $this->body,
            'meta_title'        => $this->meta_title,
            'meta_description'  => $this->meta_description,
            'hero_image'        => $this->hero_image,
            'hero_video_url'    => $this->hero_video_url,
            'hero_video_poster' => $this->hero_video_poster,
            'og_image'          => $this->og_image,
        ]);

        if($this->hero_file){
            $path = $this->putUpload($this->hero_file, 'pages/heroes', ['image/jpeg','image/png','image/webp']);
            $p->hero_image = '/storage/'.$path;
        }

        if($this->og_file){
            $path = $this->putUpload($this->og_file, 'pages/og', ['image/jpeg','image/png','image/webp']);
            $p->og_image = '/storage/'.$path;
        }

        if($this->video_file){
            $path = $this->putUpload($this->video_file, 'pages/videos', ['video/mp4']);
            $p->hero_video_url = '/storage/'.$path;
            $autoPoster = $this->tryGeneratePosterFromVideo($path);
            if($autoPoster){
                $p->hero_video_poster = '/storage/'.$autoPoster;
            }
        }

        if($this->poster_file){
            $posterPath = $this->putUpload($this->poster_file, 'pages/video-posters', ['image/jpeg','image/png','image/webp']);
            $p->hero_video_poster = '/storage/'.$posterPath;
        }

        $p->save();

        $this->reset([
            'editingId','slug','title','subtitle','type','is_published','body',
            'hero_image','hero_video_url','hero_video_poster',
            'meta_title','meta_description','og_image',
            'hero_file','og_file','video_file','poster_file',
        ]);

        $this->type='standard';
        $this->is_published=true;
        session()->flash('ok','Saved');
    }

    public function delete($id){
        $this->authorize('delete', Page::class);
        Page::findOrFail($id)->delete();
    }

    public function render(){
        $this->authorize('viewAny', Page::class);
        $items=Page::latest()->get();
        return view('livewire.admin.pages.index',compact('items'))->title('Admin • Pages');
    }
	public function mount()
{
    if (! auth()->check() || ! auth()->user()->can('admin-only')) {
        abort(403);
    }
}
}
