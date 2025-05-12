<?php

namespace Tehseen\EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['title', 'subject', 'body'];

    public function recipients()
    {
        return $this->hasMany(Recipient::class);
    }
}