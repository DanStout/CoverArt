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
            $table->string('box_trim_path');
            $table->string('box_overlay_path');
            $table->string('template_preview_path');
            $table->string('template_psd_path');
        });

        $now = Carbon::now();

        $plats =
            [
                $this->getPlatArray('Wii U', 'wiiu.png', 'dvd-overlay.png', 'wiiu.png', 'wiiu.psd', $now),
                $this->getPlatArray('Wii', 'wii.png', 'dvd-overlay.png', 'wii.png', 'wii.psd', $now),
                $this->getPlatArray('Gamecube', 'pc-gc-dvd-ps2.png', 'dvd-overlay.png', 'gc.png', 'gc.psd', $now),
                $this->getPlatArray('Xbox 360', 'x360.png', 'dvd-overlay.png', 'x360.png', 'x360.psd', $now),
                $this->getPlatArray('Playstation 2', 'pc-gc-dvd-ps2.png', 'dvd-overlay.png', 'ps2.png', 'ps2.psd', $now),
                $this->getPlatArray('PC', 'pc-gc-dvd-ps2.png', 'dvd-overlay.png', 'pc.png', 'pc.psd', $now),
                $this->getPlatArray('DVD', 'pc-gc-dvd-ps2.png', 'dvd-overlay.png', 'dvd.png', 'dvd.psd', $now),
        ];

        DB::table('platforms')->insert($plats);

        Schema::table('covers', function (Blueprint $table)
        {
            $dvdId = DB::table('platforms')->select('id')->where('name', 'DVD')->first()->id;

            $table->integer('platform_id')->unsigned()->default($dvdId);
            $table->foreign('platform_id')
                ->references('id')
                ->on('users');

        });
    }

    /**
     * Get a row to be inserted into the platforms table
     *
     * @param $name string The name of the platform
     * @param $boxTrimFile string The name of the file containing the box trim for this platform. Will be relative to app/templates
     * @param $boxOverlayFile string The name of the overlay for the box style for this platform. Will be relative to app/templates
     * @param $templatePreviewFile string The name of the template preview file for this platform relative to public/coverTemplates
     * @param $templatePsdFile string The name of the psd file for this platform relative to public/coverTemplates
     * @param $now Carbon The time to set for created/updated at
     * @return array
     */
    private function getPlatArray($name, $boxTrimFile, $boxOverlayFile, $templatePreviewFile, $templatePsdFile, $now)
    {
        return [
            'name' => $name,
            'box_trim_path' => "app/templates/$boxTrimFile",
            'box_overlay_path' => "app/templates/$boxOverlayFile",
            'template_preview_path' => "coverTemplates/$templatePreviewFile",
            'template_psd_path' => "coverTemplates/$templatePsdFile",
            'created_at' => $now,
            'updated_at' => $now
        ];
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('covers', function(Blueprint $table)
        {
            $table->dropForeign('covers_platform_id_foreign');
            $table->dropColumn('platform_id');
        });

        Schema::drop('platforms');
    }
}
