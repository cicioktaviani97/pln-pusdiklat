<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_auth', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable()->default('NULL');
            $table->string('avatar_file',64)->nullable()->default('NULL');
            $table->string('email')->unique();
            $table->string('username',64)->unique();
            $table->string('password',64);
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status_id',4)->nullable()->default('NULL');
            $table->tinyInteger('user_type_id',4)->nullable()->default('NULL');
            $table->bigInteger('user_entity_id',20)->nullable()->default('NULL');
            $table->string('user_key',64)->nullable()->default('NULL');
            $table->timestamp('login_at')->nullable()->default('NULL');
            $table->string('modified_by',64)->nullable()->default('NULL');
            $table->rememberToken();
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
        Schema::dropIfExists('user_auth');
    }
}
