<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if(!Schema::hasTable('user_types')){
            Schema::create('user_types', function (Blueprint $table) {
                $table->increments('id');
                $table->tinyInteger('is_admin_only');
                $table->integer('role_id')->unsigned()->index();
                $table->string('slug');
                $table->string('name');
                $table->string('label')->nullable();
                $table->integer('theme_id')->nullable();
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('user_types');
    }
}
