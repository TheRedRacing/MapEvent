<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string("firstname");
            $table->string("lastname");
            $table->string("username")->unique();
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");            
            $table->string("country")->nullable();
            $table->string("language")->default("en");
            $table->string("picture")->default("default");
            $table->string("mapview")->default(json_encode(['lat'=>"0.000",'lng'=>"0.000",'zoom'=>"1.0"]));
            
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'uuid' => Str::uuid(),
                "firstname" => "Maxime",
                "lastname" => "Sickenberg",
                "username" => "TheRedRacing",
                "email" => "maxime.sickenberg@gmail.com",
                "password" => Hash::make('1997Miata$'),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
