<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->unique()->index();
            $table->text('description');
            $table->string('icon')->nullable();
            $table->string('page')->nullable();
            $table->bigInteger('parent_id')->default(0);
            $table->smallInteger('position')->default(0);
            $table->tinyInteger('status')->default(1)->comment('1:active, 2:inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
}
