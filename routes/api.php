<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZohoController;

Route::post('/zoho/deal-account', [ZohoController::class, 'store']);
