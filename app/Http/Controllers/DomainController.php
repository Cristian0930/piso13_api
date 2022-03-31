<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DomainController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'domain_name' => 'required|string|max:255|unique:domains'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $domain = Domain::create([
            'domain_name' => $request->get('domain_name'),
            'user_id' => $user->id
        ]);

        return response()->json($domain);
    }
}
