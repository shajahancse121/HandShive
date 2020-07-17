<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('blog_category_id');
            $table->string('title');
            $table->string('slug');
            $table->text('details');
            $table->string('photo')->nullable();
            $table->string('tag')->nullable();
            $table->date('publish_date')->nullable();
            $table->tinyInteger('popular_blog')->nullable()->comment('1=yes,0=no');
            $table->tinyInteger('status')->comment('1=active,0=inactive');
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
        Schema::dropIfExists('blogs');
    }
}
