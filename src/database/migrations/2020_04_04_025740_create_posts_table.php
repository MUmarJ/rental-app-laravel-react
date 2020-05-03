<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->default('1');
            $table->integer('category_id')->default('1');
            $table->string('title', 1024);
            $table->string('description', 10240);
            $table->string('images')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('offer_start')->useCurrent();
            $table->dateTime('offer_end')->useCurrent();
            $table->string('post_status')->default('ACTIVE');
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
        Schema::dropIfExists('posts');
    }
}
