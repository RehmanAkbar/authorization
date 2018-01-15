<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('role_user_type')){
            Schema::create('role_user_type', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('role_id')->unsigned()->on('roles')->onDelete('cascade');
               
                $table->integer('user_type_id')->unsigned()->on('user_types')->onDelete('cascade');
               
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
        Schema::dropIfExists('role_user_type');
    }
}