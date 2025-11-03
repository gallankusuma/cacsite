<?php
namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\{ProductCategory, Product};

class ListItems extends Component {
    public string $slug;
    public function mount(string $slug){ $this->slug=$slug; }
    public function render(){
        $cat=ProductCategory::where('slug',$this->slug)->firstOrFail();
        $items=Product::where('category_id',$cat->id)->where('is_published',true)->latest()->paginate(12);
        return view('livewire.products.list', compact('cat','items'))
            ->with([
                'meta_description'=>$cat->short_desc,
            ])
            ->title($cat->name);
    }
}
