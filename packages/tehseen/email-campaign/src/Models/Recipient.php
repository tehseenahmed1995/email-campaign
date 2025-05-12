<?php

namespace Tehseen\EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $fillable = [
        'campaign_id',
        'customer_id',
        'status',      
        'error'  
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}