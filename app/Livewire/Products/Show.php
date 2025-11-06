	<?php
namespace App\Livewire\Products;

use Livewire\Component;
use App\Models\Product;

class Show extends Component {
    public string $slug;
    public function mount(string $slug){ $this->slug=$slug; }
    public function render(){
        $p=Product::where('slug',$this->slug)->firstOrFail();
        return view('livewire.products.show', compact('p'))
            ->with([
                'meta_description'=>$p->meta_description,
                'og_image'=>$p->og_image,
            ])
            ->title($p->meta_title ?: $p->name);
    }
}
