<?php

namespace Tehseen\EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'status', 'plan_expiry_date'];

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeExpiringWithinDays($query, $days)
    {
        return $query->where('plan_expiry_date', '<=', now()->addDays($days));
    }
}