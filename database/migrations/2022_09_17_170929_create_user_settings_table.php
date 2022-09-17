<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('value',555);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('user_settings')->insert([[
            'name' => 'company_name',
            'value' => 'Discovery Design',
            'created_at' => Carbon::now(),
        ],]);

        DB::table('user_settings')->insert([[
            'name' => 'address',
            'value' => "41 St Vincent Place\nGlasgow G1 2ER\nScotland",
            'created_at' => Carbon::now(),
        ],]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_settings');
    }
};
