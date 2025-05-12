<?php
use Illuminate\Support\Facades\Route;
use Tehseen\EmailCampaign\Http\Controllers\CampaignController;
use Tehseen\EmailCampaign\Http\Controllers\CustomerController;

Route::prefix('api/email-campaign')->group(function() {
    Route::post('campaign/create', [CampaignController::class, 'store']);
    Route::post('campaigns/{campaign}/send', [CampaignController::class, 'send']);
    Route::get('customers/filter', [CustomerController::class, 'filter']);
});
