<?php
namespace App\Livewire\Admin\Branches;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Branch;

class Index extends Component
{
    use AuthorizesRequests;

    public $editingId=null,$country='',$city='',$address='',$phone='',$email='',$type='branch',$is_published=true;

    protected function rules(){
        return [
            'country'=>'required|min:2',
            'city'=>'nullable|string',
            'address'=>'nullable|string',
            'phone'=>'nullable|string',
            'email'=>'nullable|email',
            'type'=>'required|in:branch,factory,lab',
            'is_published'=>'boolean',
        ];
    }

    public function edit($id){
        $this->authorize('update', Branch::class);
        $b=Branch::findOrFail($id);
        $this->editingId=$b->id;
        $this->country=$b->country;
        $this->city=$b->city;
        $this->address=$b->address;
        $this->phone=$b->phone;
        $this->email=$b->email;
        $this->type=$b->type;
        $this->is_published=$b->is_published;
    }

    public function save(){
        $this->authorize($this->editingId ? 'update' : 'create', Branch::class);
        $this->validate();

        Branch::updateOrCreate(['id'=>$this->editingId],[
            'country'=>$this->country,
            'city'=>$this->city,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'type'=>$this->type,
            'is_published'=>$this->is_published,
        ]);

        $this->reset();
        $this->type='branch';
        $this->is_published=true;
        session()->flash('ok','Saved');
    }

    public function delete($id){
        $this->authorize('delete', Branch::class);
        Branch::findOrFail($id)->delete();
    }

    public function render(){
        $this->authorize('viewAny', Branch::class);
        $items=Branch::latest()->paginate(20);
        return view('livewire.admin.branches.index',compact('items'))->title('Admin • Branches');
    }
	public function mount()
{
    if (! auth()->check() || ! auth()->user()->can('admin-only')) {
        abort(403);
    }
}

}
