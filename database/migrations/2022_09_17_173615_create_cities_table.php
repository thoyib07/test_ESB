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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->integer('country_id')->unsigned();
            $table->string('name',255);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('cities')->insert([[
            'country_id' => 1,
            'name' => 'Glasgow',
            'created_at' => Carbon::now(),
        ],]);

        DB::table('cities')->insert([[
            'country_id' => 2,
            'name' => 'London',
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
        Schema::dropIfExists('cities');
    }
};
