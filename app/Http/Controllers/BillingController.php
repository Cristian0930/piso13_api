<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillingController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'rfc' => 'required|string|max:255|unique:billings',
            'name_company_name' => 'required|string|max:255|unique:billings',
            'email' => 'required|string|max:255|email|unique:billings',
            'payment_method_id' => 'required|numeric',
            'cfdi' => 'required|string|max:255|unique:billings',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $billing = Billing::create([
            'rfc' => $request->get('rfc'),
            'name_company_name' => $request->get('name_company_name'),
            'email' => $request->get('email'),
            'payment_method_id' => $request->get('payment_method_id'),
            'cfdi' => $request->get('cfdi'),
            'user_id' => $user->id
        ]);

        return response()->json($billing);
    }
}
