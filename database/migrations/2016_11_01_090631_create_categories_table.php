<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->timestamps();
        });

        if (!Schema::hasTable('category_picture'))
        {
            Schema::create('category_picture', function (Blueprint $table)
            {
                $table->primary(['category_id', 'picture_id']);

                // when dealing with a auto increment field of the primary key
                // always use unsigned()
                $table->integer('category_id')->unsigned()->index();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

                $table->integer('picture_id')->unsigned()->index();
                $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('cascade');

                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_picture');
        Schema::dropIfExists('categories');
    }
}
