<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('image');
            $table->string('title');
            $table->string('location')->nullable();
            $table->string('subscription')->nullable();
            $table->timestamps();
        });

        if (!Schema::hasTable('picture_user'))
        {
            Schema::create('picture_user', function (Blueprint $table)
            {
                $table->primary(['picture_id', 'user_id']);

                // when dealing with a auto increment field of the primary key
                // always use unsigned()
                $table->integer('picture_id')->unsigned()->index();
                $table->foreign('picture_id')->references('id')->on('pictures')->onDelete('cascade');

                $table->integer('user_id')->unsigned()->index();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('picture_user');
        Schema::dropIfExists('pictures');
    }
}
