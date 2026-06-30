<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookingFieldsToMessContactTable extends Migration
{
    public function up()
    {
        Schema::table('mess_contact', function (Blueprint $table) {
            if (!Schema::hasColumn('mess_contact', 'itinerary')) {
                $table->string('itinerary')->nullable()->after('service_cate_slug');
            }
            if (!Schema::hasColumn('mess_contact', 'departure_date')) {
                $table->date('departure_date')->nullable()->after('itinerary');
            }
            if (!Schema::hasColumn('mess_contact', 'guest_count')) {
                $table->string('guest_count')->nullable()->after('departure_date');
            }
        });
    }

    public function down()
    {
        Schema::table('mess_contact', function (Blueprint $table) {
            $table->dropColumn(['itinerary', 'departure_date', 'guest_count']);
        });
    }
}
