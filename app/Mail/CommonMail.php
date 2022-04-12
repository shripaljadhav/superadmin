<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

use Illuminate\Contracts\Queue\ShouldQueue;

class CommonMail extends Mailable
{
	use Queueable, SerializesModels;
	
	public $content;
	public $subject;
	public $sender;
	/**
	* Create a new message instance.
	*
	* @return void
	*/
	public function __construct($content, $subject, $sender) {
		$this->content = $content;
		$this->subject = $subject;
		$this->sender = $sender;
	}
	/**
	* Build the message.
	*
	* @return $this
	*/
	public function build() {	
		return $this->from($this->sender, 'Aus Taxi Club')->subject($this->subject)->view('emails.common');
	}
}
