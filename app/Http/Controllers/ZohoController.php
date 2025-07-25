<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountDealRequest;
use App\Services\ZohoService;

class ZohoController extends Controller
{
    private ZohoService $zohoService;

    public function __construct(ZohoService $zohoService) {
        $this->zohoService = $zohoService;
    }

    public function store(AccountDealRequest $request)
    {
        try {
            $accountId = $this->zohoService->createAccount([
                'Account_Name' => $request->input('account.account_name'),
                'Phone' => $request->input('account.phone'),
                'Website' => $request->input('account.website'),
            ]);

            $dealResponse = $this->zohoService->createDeal([
                'Deal_Name' => $request->input('deal.deal_name'),
                'Stage' => $request->input('deal.stage'),
                'Account_Name' => ['id' => $accountId],
            ]);

            return response()->json([
                'success' => true,
                'account_id' => $accountId,
                'deal_response' => $dealResponse,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
