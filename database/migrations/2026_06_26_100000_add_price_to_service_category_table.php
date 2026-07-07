<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToServiceCategoryTable extends Migration
{
    public function up()
    {
        Schema::table('service_category', function (Blueprint $table) {
            $table->string('price', 255)->nullable()->after('description');
            if (!Schema::hasColumn('service_category', 'sort')) {
                $table->unsignedInteger('sort')->default(0)->after('price');
            }
        });
    }

    public function down()
    {
        Schema::table('service_category', function (Blueprint $table) {
            $table->dropColumn('price');
            if (Schema::hasColumn('service_category', 'sort')) {
                $table->dropColumn('sort');
            }
        });
    }
}
