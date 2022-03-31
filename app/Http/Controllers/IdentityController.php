<?php

namespace App\Http\Controllers;

use App\Models\Identity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IdentityController extends Controller
{
    public function store(Request $request)
    {

        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'site_title' => 'required|string|max:255',
            'site_description' => 'required|string|max:255',
            'logo' => 'required|file|mimes:pdf,jpg',
            'icon' => 'required|file|mimes:pdf,jpg',
            'identity_manual' => 'required|file|mimes:pdf,jpg'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {

            $logo = $request->file('logo');
            $logo_name = time() . $logo->getClientOriginalName();
            Storage::disk('local')->put($logo_name, File::get($logo));

            $icon = $request->file('icon');
            $icon_name = time() . $icon->getClientOriginalName();
            Storage::disk('local')->put($icon_name, File::get($icon));

            $identity_manual = $request->file('identity_manual');
            $identity_manual_name = time() . $identity_manual->getClientOriginalName();
            Storage::disk('local')->put($identity_manual_name, File::get($identity_manual));

            $identity = Identity::create([
                'site_title' => $request->get('site_title'),
                'site_description' => $request->get('site_description'),
                'logo' => $logo_name,
                'icon' => $icon_name,
                'identity_manual' => $identity_manual_name,
                'user_id' => $user->id
            ]);

            return response()->json($identity);

        } catch (\Exception $exception) {
            return response()->json('algo salio mal', 500);
        }
    }
}
