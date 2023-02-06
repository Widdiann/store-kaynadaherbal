<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransactionsToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('code')->after('id')->nullable();
            $table->string('midtrans')->after('status')->nullable();
            $table->string('phone')->after('midtrans')->nullable();
            $table->string('kode_pos')->after('phone')->nullable();
            $table->string('address')->after('kode_pos')->nullable();
            $table->integer('province_id')->after('address')->nullable();
            $table->string('regencies_id')->after('province_id')->nullable();
            $table->string('district_id')->after('regencies_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('midtrans');
            $table->dropColumn('address');
            $table->dropColumn('province_id');
            $table->dropColumn('regencies_id');
            $table->dropColumn('district_id');
        });
    }
}
