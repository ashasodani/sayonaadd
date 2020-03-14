<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblVisitDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_visit_detail', function (Blueprint $table) {
            $table->bigIncrements('pk_visit_detail_id');
            $table->integer('fk_visit_id');
            $table->integer('fk_service_grp_id');
            $table->integer('fk_service_id');
            $table->string('fk_task_id')->nullable(true);
            $table->string('task_description')->nullable(true);
            $table->string('start_time');
            $table->string('end_time');
            $table->string('duration');
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
        Schema::dropIfExists('tbl_visit_detail');
    }
}
