<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->text('company_different');
            $table->text('sections');
            $table->text('products_or_services');
            $table->string('content');
            $table->text('design_elements');
            $table->string('design_elements_file');
            $table->text('what_do_people');
            $table->text('call_to_action');
            $table->text('design_site_helpers');
            $table->string('update_article');
            $table->string('upload_image');
            $table->string('site_name');
            $table->string('site_text');
            $table->string('site_image');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information');
    }
};
