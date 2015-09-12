<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covers', function (Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->text('description')->nullable();
            $table->string('img_path');

            $table->integer('work_id')->unsigned();
            $table->foreign('work_id')
                ->references('id')
                ->on('works');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

        });

        Schema::create('works', function (Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->string('title');

            $table->integer('subcategory_id')->unsigned();
            $table->foreign('subcategory_id')
                ->references('id')
                ->on('subcategories');

            $table->unique(['subcategory_id', 'title']);

        });

        Schema::create('subcategories', function (Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->unique(['category_id', 'name']);


        });

        Schema::create('categories', function (Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();

            $table->string('name')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('covers');
        Schema::drop('works');
        Schema::drop('subcategories');
        Schema::drop('categories');
    }
}
