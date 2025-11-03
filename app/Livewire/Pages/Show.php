<?php
namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Page;

class Show extends Component {
    public string $slug;
    public function mount(string $slug){ $this->slug=$slug; }
    public function render(){
        $page = Page::where('slug',$this->slug)->with('sections')->firstOrFail();
        return view('livewire.pages.show', compact('page'))
            ->with([
                'meta_description'=>$page->meta_description,
                'og_image'=>$page->og_image,
            ])
            ->title($page->meta_title ?: $page->title);
    }
}
