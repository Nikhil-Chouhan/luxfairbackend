<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('subcategory_title');
            $table->string('subcategory_slug');
            $table->text('subcategory_description');
            $table->string('subcategory_img')->nullable();
            $table->integer('is_active')->default(1);
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
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
        Schema::dropIfExists('subcategories');
    }
}
