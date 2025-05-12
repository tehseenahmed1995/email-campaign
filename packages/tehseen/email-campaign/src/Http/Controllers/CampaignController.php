<?php
namespace Tehseen\EmailCampaign\Http\Controllers;

use Illuminate\Http\Request;
use Tehseen\EmailCampaign\Jobs\SendCampaignEmails;
use Tehseen\EmailCampaign\Models\Campaign;
use App\Http\Controllers\Controller;

class CampaignController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string'
        ]);

        return Campaign::create($data);
    }

    public function send(Campaign $campaign, Request $request)
    {
        $request->validate([
            'customer_ids' => 'required|array',
            'customer_ids.*' => 'exists:customers,id'
        ]);

        dispatch(new SendCampaignEmails($campaign, $request->customer_ids));

        return response()->json(['message' => 'Campaign is being processed']);
    }
}