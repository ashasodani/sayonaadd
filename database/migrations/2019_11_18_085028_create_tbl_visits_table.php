<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_visits', function (Blueprint $table) {
            $table->bigIncrements('pk_visits_id');
            $table->integer('fk_ct_id');
            $table->integer('fk_client_id_id');
            $table->integer('fk_service_id');
            $table->date('visit_date');
            $table->string('visit_status')->default('pending');
            $table->integer('is_delete')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_visits');
    }
}
