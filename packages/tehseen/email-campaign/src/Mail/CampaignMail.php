<?php

namespace Tehseen\EmailCampaign\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public $campaign;

    public function __construct($campaign)
    {
        $this->campaign = $campaign;
    }

    public function build()
    {
        return $this->subject($this->campaign->subject)
            ->view('email-campaign::template')
            ->with(
                ['content' => $this->campaign->body,
                'title' => $this->campaign->title
            ]);
    }
}