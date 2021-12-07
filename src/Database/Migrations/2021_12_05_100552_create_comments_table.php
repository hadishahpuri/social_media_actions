<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sma_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on(config('social_media_actions.users_table_name', 'users'))->cascadeOnDelete();
            $table->text("content");
            $table->unsignedBigInteger("commentable_id");
            $table->string("commentable_type");
            $table->boolean("approval")->default(config('social_media_actions.comment_approval'));
            $table->unsignedBigInteger("approved_by")->nullable();
            $table->foreign("approved_by")->references("id")->on(config('social_media_actions.users_table_name', 'users'))->cascadeOnDelete();
            $table->unsignedBigInteger('reply_id')->nullable();
            $table->foreign('reply_id')->references('id')->on('comments')->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sma_comments');
    }
}
