<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DomainAnalysisMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
   public $analysis;

    /**
     * Create a new message instance.
     *
     * @param int $domainScore
     * @param string $analysedAddress
     */
    public function __construct(int $domainScore, string $analysedAddress)
    {
        $this->analysis = [
            'email'  => $analysedAddress,
            'domain' => explode('@', $analysedAddress)[1],
            'score'  => $domainScore,
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.analysis.report');
    }
}
