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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('countries')->insert([[
            'name' => 'Scotland',
            'created_at' => Carbon::now(),
        ],]);

        DB::table('countries')->insert([[
            'name' => 'United Kingdom',
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
        Schema::dropIfExists('countries');
    }
};
