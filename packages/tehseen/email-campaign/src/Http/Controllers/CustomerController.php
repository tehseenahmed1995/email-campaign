<?php

namespace Tehseen\EmailCampaign\Http\Controllers;

use Illuminate\Http\Request;
use Tehseen\EmailCampaign\Models\Customer;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class CustomerController extends Controller
{
    /**
     * Filter customers based on status and expiry date
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'nullable|string|in:Paid,Grace period,Expired',
            'plan_expiry_date' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 422);
        }

        try {
            $query = Customer::query();

            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            if ($request->has('plan_expiry_date')) {
                $query->where('plan_expiry_date',($request->plan_expiry_date));
            }

            $customers = $query->select(['id', 'name', 'email', 'status', 'plan_expiry_date'])->paginate(20);

            return response()->json([
                'data' => $customers,
                'count' => $customers->count()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to filter customers',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}