<?php
namespace App\Livewire\Contact;

use Livewire\Component;
use App\Models\Inquiry;

class ContactForm extends Component {
    public string $name=''; public string $email=''; public ?string $phone=null;
    public ?string $subject=null; public string $message='';

    public function submit(){
        $this->validate([
            'name'=>'required|min:2',
            'email'=>'required|email',
            'message'=>'required|min:10',
        ]);
        Inquiry::create([
            'type'=>'contact','name'=>$this->name,'email'=>$this->email,'phone'=>$this->phone,
            'subject'=>$this->subject,'message'=>$this->message,'status'=>'new'
        ]);
        session()->flash('ok','Thanks—your message has been received.');
        $this->reset(['name','email','phone','subject','message']);
    }
    public function render(){ return view('livewire.contact.contact-form')->title('Contact Us'); }
}
