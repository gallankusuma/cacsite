<?php
namespace App\Livewire\Admin\PageSections;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\{Page, PageSection};
use App\Support\Uploads;

class Editor extends Component
{
    use WithFileUploads, Uploads, AuthorizesRequests;

    public Page $page;
    public $title='',$key='',$body='',$sort_order=0,$is_published=true,$media_path='';
    public $media_file;
    public $editingId=null;

    protected function rules(){
        return [
            'title'=>'nullable|string',
            'key'=>'nullable|string',
            'body'=>'nullable|string',
            'sort_order'=>'integer|min:0',
            'is_published'=>'boolean',
            'media_file'=>'nullable|file|max:4096'
        ];
    }

    public function mount()
{
    if (! auth()->check() || ! auth()->user()->can('admin-only')) {
        abort(403);
    }
}


    public function edit($id){
        $this->authorize('update', Page::class);
        $s=PageSection::where('page_id',$this->page->id)->findOrFail($id);
        $this->editingId=$s->id;
        $this->title=$s->title;
        $this->key=$s->key;
        $this->body=$s->body;
        $this->sort_order=$s->sort_order;
        $this->is_published=$s->is_published;
        $this->media_path=$s->media_path;
    }

    public function clearMedia(){ $this->media_path=''; }

    public function save(){
        $this->authorize($this->editingId ? 'update' : 'create', Page::class);
        $this->validate();

        $s = PageSection::updateOrCreate(
            ['id'=>$this->editingId],
            [
                'page_id'=>$this->page->id,
                'title'=>$this->title,
                'key'=>$this->key,
                'body'=>$this->body,
                'sort_order'=>$this->sort_order,
                'is_published'=>$this->is_published,
                'media_path'=>$this->media_path,
            ]
        );
        if($this->media_file){
            $m = $this->media_file->getClientMimeType();
            $dir = str_contains($m,'image') ? 'pages/sections/img' : 'pages/sections/file';
            $path = $this->putUpload($this->media_file, $dir);
            $s->media_path = '/storage/'.$path;
            $s->save();
        }

        $this->reset(['editingId','title','key','body','sort_order','is_published','media_path','media_file']);
        $this->is_published=true; $this->sort_order=0;
        session()->flash('ok','Section saved');
    }

    public function delete($id){
        $this->authorize('delete', Page::class);
        PageSection::where('page_id',$this->page->id)->findOrFail($id)->delete();
    }

    public function reorderSections(array $orderedIds){
        $this->authorize('update', Page::class);
        foreach ($orderedIds as $index => $id) {
            PageSection::where('page_id', $this->page->id)
                ->where('id', $id)
                ->update(['sort_order' => $index]);
        }
        session()->flash('ok','Order updated');
    }

    public function render(){
        $items = $this->page->sections()->orderBy('sort_order')->get();
        return view('livewire.admin.page-sections.editor', compact('items'));
    }
}
