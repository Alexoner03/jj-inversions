<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title,$first_paragraph,$second_paragraph;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $title,string $first_paragraph,string $second_paragraph)
    {
        $this->title = $title;
        $this->first_paragraph = $first_paragraph;
        $this->second_paragraph = $second_paragraph;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.promo',[
            'title' => $this->title,
            'first_paragraph' => $this->first_paragraph,
            'second_paragraph' => $this->second_paragraph,
        ]);
    }
}
