<?php
namespace App\Livewire\Admin\Stats;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\SiteStat;

class Index extends Component
{
    use AuthorizesRequests;

    public $stats=[];

   public function mount()
{
    if (! auth()->check() || ! auth()->user()->can('admin-only')) {
        abort(403);
    }
}

    public function save(){
        $this->authorize('update', SiteStat::class);
        foreach($this->stats as $k=>$v){
            SiteStat::updateOrCreate(['key'=>$k], ['value_int'=>(int)$v]);
        }
        session()->flash('ok','Saved');
    }

    public function render(){
        return view('livewire.admin.stats.index')->title('Admin • Site Stats');
    }
}
