<?php
namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use App\Support\Uploads;
use App\Models\{Product, ProductCategory};

class Index extends Component
{
    use WithFileUploads, Uploads, AuthorizesRequests;

    public $editingId=null,$category_id='',$name='',$slug='',$summary='',$description='';
    public $hero_file,$datasheet_file;
    public $specs_json='{}',$is_published=true;
    public $meta_title='',$meta_description='',$og_file,$og_image='';

    protected function rules(){
        return [
            'category_id'=>'required|exists:product_categories,id',
            'name'=>'required|min:2',
            'slug'=>'required|min:2',
            'summary'=>'nullable|string',
            'description'=>'nullable|string',
            'hero_file'=>'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
            'datasheet_file'=>'nullable|file|mimes:pdf|max:10240',
            'specs_json'=>'nullable|string',
            'is_published'=>'boolean',
            'meta_title'=>'nullable|string|max:255',
            'meta_description'=>'nullable|string|max:500',
            'og_file'=>'nullable|file|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }

    public function makeSlug(){
        if($this->name && !$this->slug){
            $this->slug=Str::slug($this->name);
        }
    }

    public function edit($id){
        $this->authorize('update', Product::class);
        $p=Product::findOrFail($id);
        $this->editingId=$p->id;
        $this->category_id=$p->category_id;
        $this->name=$p->name;
        $this->slug=$p->slug;
        $this->summary=$p->summary;
        $this->description=$p->description;
        $this->specs_json=json_encode($p->specs ?? [], JSON_PRETTY_PRINT);
        $this->is_published=$p->is_published;
        $this->meta_title=$p->meta_title;
        $this->meta_description=$p->meta_description;
        $this->og_image=$p->og_image;
    }

    public function save(){
        $this->authorize($this->editingId ? 'update' : 'create', Product::class);
        $this->validate();

        $specs = $this->specs_json ? json_decode($this->specs_json,true) : null;

        $p = Product::updateOrCreate(['id'=>$this->editingId],[
            'category_id'=>$this->category_id,
            'name'=>$this->name,'slug'=>$this->slug,
            'summary'=>$this->summary,'description'=>$this->description,
            'specs'=>$specs,'is_published'=>$this->is_published,
            'meta_title'=>$this->meta_title,
            'meta_description'=>$this->meta_description,
            'og_image'=>$this->og_image,
        ]);

        if($this->hero_file){
            $path = $this->putUpload($this->hero_file, 'products/images', ['image/jpeg','image/png','image/webp']);
            $p->hero_image = '/storage/'+$path;
        }

        if($this->datasheet_file){
            $path = $this->putUpload($this->datasheet_file, 'products/datasheets', ['application/pdf']);
            $p->datasheet_path = '/storage/'+$path;
        }

        if($this->og_file){
            $path = $this->putUpload($this->og_file, 'products/og', ['image/jpeg','image/png','image/webp']);
            $p->og_image = '/storage/'+$path;
        }

        $p->save();

        $this->reset();
        $this->is_published=true;
        session()->flash('ok','Saved');
    }

    public function delete($id){
        $this->authorize('delete', Product::class);
        Product::findOrFail($id)->delete();
    }

    public function render(){
        $this->authorize('viewAny', Product::class);
        $cats=ProductCategory::orderBy('sort_order')->get();
        $items=Product::with('category')->latest()->paginate(12);
        return view('livewire.admin.products.index',compact('items','cats'))->title('Admin • Products');
    }
	public function mount()
{
    if (! auth()->check() || ! auth()->user()->can('admin-only')) {
        abort(403);
    }
}

}
