<?php
namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\{Page, ProductCategory, SiteStat, Certificate};

class Index extends Component {
    public function render() {
        $home = Page::where('slug','home')->first();
        $cats = ProductCategory::where('is_published',true)->orderBy('sort_order')->take(6)->get();
        $stats= SiteStat::all()->keyBy('key');
        $certs= Certificate::where('is_published',true)->latest()->take(6)->get();

        return view('livewire.home.index')
        ->layout('components.layouts.app')
        ->title('Cahaya Agro Chemical');

    }
}
