<?php
namespace Tehseen\EmailCampaign\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Tehseen\EmailCampaign\Mail\CampaignMail;
use Tehseen\EmailCampaign\Models\Customer;

class SendCampaignEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign;
    protected $customerIds;

    public function __construct($campaign, $customerIds)
    {
        $this->campaign = $campaign;
        $this->customerIds = $customerIds;
    }

    public function handle()
    {
        foreach ($this->customerIds as $customerId) {
            $customer = Customer::find($customerId);

            try {
                if(!empty($customer)) {
                    Mail::to($customer->email)->send(new CampaignMail($this->campaign));

                    $this->campaign->recipients()->updateOrCreate(
                        ['customer_id' => $customer->id],
                        [
                            'status' => 'sent',
                            'sent_at' => now(),
                            'error' => null
                        ]
                    );
                }
            } catch (\Exception $e) {
                $this->campaign->recipients()->updateOrCreate(
                    ['customer_id' => $customer->id],
                    [
                        'status' => 'failed',
                        'error' => $e->getMessage()
                    ]
                );
            }
        }
    }
}