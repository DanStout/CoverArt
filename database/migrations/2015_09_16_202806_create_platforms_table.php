<?php

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('platforms', function (Blueprint $table)
        {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('template_path');
            $table->string('overlay_path');
        });

        $now = Carbon::now();

        $plats =
            [
                ['name' => 'Wii U', 'template_path' => 'app/templates/wiiu.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Wii', 'template_path' => 'app/templates/wii.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
                ['name' => 'Gamecube', 'template_path' => 'app/templates/pc-gc-dvd-ps2.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
//            ['name' => 'Nintendo 3DS', 'template_path' => 'app/templates/wiiu.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
//            ['name' => 'Nintendo DS', 'template_path' => 'app/templates/wiiu.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Xbox 360', 'template_path' => 'app/templates/x360.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
//            ['name' => 'Playstation 3', 'template_path' => 'app/templates/wiiu.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Playstation 2', 'template_path' => 'app/templates/pc-gc-dvd-ps2.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'DVD', 'template_path' => 'app/templates/pc-gc-dvd-ps2.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
//            ['name' => 'Blu-Ray', 'template_path' => 'app/templates/wiiu.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Other', 'template_path' => 'app/templates/pc-gc-dvd-ps2.png', 'overlay_path' => 'app/templates/dvd-overlay.png', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('platforms')->insert($plats);

        Schema::table('covers', function (Blueprint $table)
        {
            $otherId = Db::table('platforms')->select('id')->where('name', 'Other')->first()->id;
            $table->integer('platform_id')->default($otherId)->unsigned();
            $table->foreign('platform_id')
                ->references('id')
                ->on('platforms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('covers', function (Blueprint $table)
        {
            $table->dropForeign('covers_platform_id_foreign');
            $table->dropColumn('platform_id');
        });

        Schema::drop('platforms');
    }
}
