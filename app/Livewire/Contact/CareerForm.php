<?php
namespace App\Livewire\Contact;

use Livewire\Component;
use App\Models\Inquiry;

class CareerForm extends Component {
    public string $name=''; public string $email=''; public ?string $phone=null;
    public ?string $cv_url=null; public string $message='';

    public function submit(){
        $this->validate([
            'name'=>'required|min:2',
            'email'=>'required|email',
            'message'=>'required|min:10',
        ]);
        Inquiry::create([
            'type'=>'career','name'=>$this->name,'email'=>$this->email,'phone'=>$this->phone,
            'subject'=>'Career Interest','message'=>$this->message,
            'meta'=>['cv_url'=>$this->cv_url],
            'status'=>'new'
        ]);
        session()->flash('ok','Received. We will review your profile.');
        $this->reset(['name','email','phone','cv_url','message']);
    }
    public function render(){ return view('livewire.contact.career-form')->title('Work With Us'); }
}
