<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePosts extends Migration
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
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('admin_id')->index();
            $table->string('category_id')->index();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->text('thumbnail')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('number_views')->nullable()->default(0);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
        });
        DB::statement(DB::raw("ALTER TABLE posts ADD FULLTEXT INDEX fulltext_title(title)"));
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
