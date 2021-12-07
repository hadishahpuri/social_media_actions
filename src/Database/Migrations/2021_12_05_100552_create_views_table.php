<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sma_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on(config('social_media_actions.users_table_name', 'users'))->cascadeOnDelete();
            $table->string('session_id', 255)->nullable();
            $table->unsignedBigInteger("viewable_id");
            $table->string("viewable_type");
            $table->unique(["user_id","viewable_id","viewable_type"]);
            $table->unique(["session_id","viewable_id","viewable_type"]);
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
        Schema::dropIfExists('sma_views');
    }
}
