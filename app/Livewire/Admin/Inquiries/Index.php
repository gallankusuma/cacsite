<?php
namespace App\Livewire\Admin\Inquiries;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Inquiry;

class Index extends Component
{
    use AuthorizesRequests;

    public $filter='all',$reading=null;

    public function markRead($id){
        $this->authorize('update', Inquiry::class);
        $inq=Inquiry::findOrFail($id); $inq->status='read'; $inq->save();
    }

    public function read($id){
        $this->authorize('view', Inquiry::class);
        $this->reading=Inquiry::findOrFail($id);
    }

    public function render(){
        $this->authorize('viewAny', Inquiry::class);
        $q=Inquiry::latest();
        if($this->filter==='new') $q->where('status','new');
        if($this->filter==='contact') $q->where('type','contact');
        if($this->filter==='career') $q->where('type','career');
        $items=$q->paginate(20);
        return view('livewire.admin.inquiries.index',compact('items'))->title('Admin • Inquiries');
    }
	public function mount()
{
    if (! auth()->check() || ! auth()->user()->can('admin-only')) {
        abort(403);
    }
}

}
