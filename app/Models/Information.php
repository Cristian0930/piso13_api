<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'company_different',
        'sections',
        'products_or_services',
        'content',
        'design_elements',
        'design_elements_file',
        'what_do_people',
        'call_to_action',
        'design_site_helpers',
        'update_article',
        'upload_image',
        'site_name',
        'site_text',
        'site_image',
        'user_id'
    ];
}
