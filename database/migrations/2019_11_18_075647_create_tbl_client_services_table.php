<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblClientServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_client_services', function (Blueprint $table) {
            $table->bigIncrements('pk_client_services_id');
            $table->integer('fk_client_id');
            $table->integer('fk_service_grp_id');
            $table->integer('fk_service_id');
            $table->integer('fk_task_id');
            $table->string('allocated_time',100);
            $table->date('service_date');
            $table->string('client_description',500);
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
        Schema::dropIfExists('tbl_client_services');
    }
}
