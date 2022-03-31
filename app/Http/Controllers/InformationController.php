<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
            'company_different' => 'required|string',
            'sections' => 'required|string',
            'products_or_services' => 'required|string',
            'content' => 'required|file|mimes:pdf,jpg',
            'design_elements' => 'required|string',
            'design_elements_file' => 'required|file|mimes:pdf,jpg',
            'what_do_people' => 'required|string',
            'call_to_action' => 'required|string',
            'design_site_helpers' => 'required|string',
            'update_article' => 'required|file|mimes:pdf,jpg',
            'upload_image' => 'required|file|mimes:pdf,jpg',
            'site_name' => 'required|file|mimes:pdf,jpg',
            'site_text' => 'required|file|mimes:pdf,jpg',
            'site_image' => 'required|file|mimes:pdf,jpg'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {

            $content = $request->file('content');
            $content_name = time() . $content->getClientOriginalName();
            Storage::disk('local')->put($content_name, File::get($content));

            $design_elements_file = $request->file('design_elements_file');
            $design_elements_file_name = time() . $design_elements_file->getClientOriginalName();
            Storage::disk('local')->put($design_elements_file_name, File::get($design_elements_file));

            $update_article = $request->file('update_article');
            $update_article_name = time() . $update_article->getClientOriginalName();
            Storage::disk('local')->put($update_article_name, File::get($update_article));

            $upload_image = $request->file('upload_image');
            $upload_image_name = time() . $upload_image->getClientOriginalName();
            Storage::disk('local')->put($upload_image_name, File::get($upload_image));

            $site_name = $request->file('site_name');
            $site_name_name = time() . $site_name->getClientOriginalName();
            Storage::disk('local')->put($site_name_name, File::get($site_name));

            $site_text = $request->file('site_text');
            $site_text_name = time() . $site_text->getClientOriginalName();
            Storage::disk('local')->put($site_text_name, File::get($site_text));

            $site_image = $request->file('site_image');
            $site_image_name = time() . $site_image->getClientOriginalName();
            Storage::disk('local')->put($site_image_name, File::get($site_image));

            $information = Information::create([
                'description' => $request->get('description'),
                'company_different' => $request->get('company_different'),
                'sections' => $request->get('sections'),
                'products_or_services' => $request->get('products_or_services'),
                'content' => $content_name,
                'design_elements' => $request->get('design_elements'),
                'design_elements_file' => $design_elements_file_name,
                'what_do_people' => $request->get('what_do_people'),
                'call_to_action' => $request->get('call_to_action'),
                'design_site_helpers' => $request->get('design_site_helpers'),
                'update_article' => $update_article_name,
                'upload_image' => $upload_image_name,
                'site_name' => $site_name_name,
                'site_text' => $site_text_name,
                'site_image' => $site_image_name,
                'user_id' => $user->id
            ]);

            return response()->json($information);

        } catch (\Exception $exception) {
            return response()->json($exception, 500);
        }
    }

    public function show(Information $information)
    {
        //
    }

    public function update(Request $request, Information $information)
    {
        //
    }

    public function destroy(Information $information)
    {
        //
    }
}
