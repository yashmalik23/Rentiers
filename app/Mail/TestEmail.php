<?php

namespace App\Mail;

use App\properties;
use DB;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = 'alerts@rentiers.in';
        $subject = 'Someone visited this property today!';
        $name = 'Property alert';
        
        return $this->view('emails.test')
                    ->from($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with('a',$this->data['message']);
    }
}
