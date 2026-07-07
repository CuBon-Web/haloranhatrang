<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSortToServiceCategoryTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('service_category', 'sort')) {
            Schema::table('service_category', function (Blueprint $table) {
                $table->unsignedInteger('sort')->default(0)->after('price');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('service_category', 'sort')) {
            Schema::table('service_category', function (Blueprint $table) {
                $table->dropColumn('sort');
            });
        }
    }
}
