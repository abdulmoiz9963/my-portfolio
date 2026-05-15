<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->to(config('mail.from.address'))
                    ->replyTo($this->data['email'], $this->data['name'])
                    ->subject('Portfolio Contact: ' . $this->data['subject'])
                    ->html("
                        <div style='font-family: Arial, sans-serif; max-width: 600px;'>
                            <h2 style='color: #6c63ff;'>New Contact Message</h2>
                            <p><strong>Name:</strong> {$this->data['name']}</p>
                            <p><strong>Email:</strong> {$this->data['email']}</p>
                            <p><strong>Subject:</strong> {$this->data['subject']}</p>
                            <p><strong>Message:</strong></p>
                            <div style='background: #f4f4f4; padding: 15px; border-radius: 5px;'>
                                {$this->data['message']}
                            </div>
                        </div>
                    ");
    }
}
