<?php
namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\ProductCategory;

class CategoryIndex extends Component {
    public function render(){
        $cats=ProductCategory::where('is_published',true)->orderBy('sort_order')->get();
        return view('livewire.products.categories', compact('cats'))->title('Products');
    }
}
