<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskWeDosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_we_dos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('department_id');
            $table->text('tag_url')->nullable();
            $table->text('icon')->nullable();
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
        Schema::dropIfExists('task_we_dos');
    }
}
