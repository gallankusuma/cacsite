<?php
namespace App\Livewire\Admin\Certificates;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Support\Uploads;
use App\Models\Certificate;

class Index extends Component
{
    use WithFileUploads, Uploads, AuthorizesRequests;

    public $editingId=null,$title='',$issuer='',$issue_date='',$is_published=true;
    public $file_upload;

    protected function rules(){
        return [
            'title'=>'required|min:2',
            'issuer'=>'nullable|string',
            'issue_date'=>'nullable|date',
            'file_upload'=>'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:10240',
            'is_published'=>'boolean'
        ];
    }

    public function edit($id){
        $this->authorize('update', Certificate::class);
        $c=Certificate::findOrFail($id);
        $this->editingId=$c->id;
        $this->title=$c->title;
        $this->issuer=$c->issuer;
        $this->issue_date=optional($c->issue_date)->format('Y-m-d');
        $this->is_published=$c->is_published;
    }

    public function save(){
        $this->authorize($this->editingId ? 'update' : 'create', Certificate::class);
        $this->validate();

        $c = Certificate::updateOrCreate(['id'=>$this->editingId],[
            'title'=>$this->title,
            'issuer'=>$this->issuer,
            'issue_date'=>$this->issue_date,
            'is_published'=>$this->is_published,
        ]);

        if($this->file_upload){
            $mime = $this->file_upload->getClientMimeType();
            $dir = (strpos($mime,'pdf') !== false) ? 'certificates/pdf' : 'certificates/img';
            $path = $this->putUpload($this->file_upload, $dir, ['application/pdf','image/jpeg','image/png','image/webp']);
            $c->file_path = '/storage/'.$path;
            $c->save();
        }

        $this->reset();
        $this->is_published=true;
        session()->flash('ok','Saved');
    }

    public function delete($id){
        $this->authorize('delete', Certificate::class);
        Certificate::findOrFail($id)->delete();
    }

    public function render(){
        $this->authorize('viewAny', Certificate::class);
        $items=Certificate::latest()->paginate(20);
        return view('livewire.admin.certificates.index',compact('items'))->title('Admin • Certificates');
    }
	public function mount()
{
    if (! auth()->check() || ! auth()->user()->can('admin-only')) {
        abort(403);
    }
}

}
