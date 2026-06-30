<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddSlugToItinerariesTable extends Migration
{
    public function up()
    {
        Schema::table('itineraries', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        $items = DB::table('itineraries')->select('id', 'name')->get();
        foreach ($items as $item) {
            $slug = to_slug($item->name);
            if ($slug === '') {
                $slug = 'hai-trinh-' . $item->id;
            }
            DB::table('itineraries')->where('id', $item->id)->update(['slug' => $slug]);
        }
    }

    public function down()
    {
        Schema::table('itineraries', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
