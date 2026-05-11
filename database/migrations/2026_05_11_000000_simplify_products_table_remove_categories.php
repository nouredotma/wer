<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->renameColumn('image', 'main_image');
            $table->json('thumbnail_images')->nullable();
            $table->json('sizes_available')->nullable();
            $table->json('colors_available')->nullable();
        });

        Schema::dropIfExists('categories');
    }

    public function down()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->renameColumn('main_image', 'image');
            $table->dropColumn(['thumbnail_images', 'sizes_available', 'colors_available']);
        });
    }
};
