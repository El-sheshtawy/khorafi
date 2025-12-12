<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilterFieldsToConfigTable extends Migration
{
    public function up()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->string('filter_number')->nullable()->default('27');
            $table->string('filter_from_date')->nullable();
            $table->string('filter_to_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('config', function (Blueprint $table) {
            $table->dropColumn(['filter_number', 'filter_from_date', 'filter_to_date']);
        });
    }
}
