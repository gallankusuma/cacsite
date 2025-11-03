<?php
namespace App\Livewire\Admin\ProductCategories;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\ProductCategory;

class Index extends Component
{
    use AuthorizesRequests;

    public $name,$slug,$short_desc,$editingId=null;

    protected function rules(){
        return [
            'name'=>'required|min:2',
            'slug'=>'required|min:2',
            'short_desc'=>'nullable|string'
        ];
    }

    public function save(){
        $this->authorize($this->editingId ? 'update' : 'create', ProductCategory::class);
        $data=$this->validate();
        ProductCategory::updateOrCreate(['id'=>$this->editingId],$data);
        $this->reset(['name','slug','short_desc','editingId']);
        session()->flash('ok','Saved');
    }

    public function edit($id){
        $this->authorize('update', ProductCategory::class);
        $c=ProductCategory::findOrFail($id);
        $this->editingId=$c->id; $this->name=$c->name; $this->slug=$c->slug; $this->short_desc=$c->short_desc;
    }

    public function delete($id){
        $this->authorize('delete', ProductCategory::class);
        ProductCategory::findOrFail($id)->delete();
    }

    public function render(){
        $this->authorize('viewAny', ProductCategory::class);
        $items=ProductCategory::orderBy('sort_order')->get();
        return view('livewire.admin.product-categories.index', compact('items'))->title('Admin • Product Categories');
    }
	public function mount()
{
    if (! auth()->check() || ! auth()->user()->can('admin-only')) {
        abort(403);
    }
}

}
