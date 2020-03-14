<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCtInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ct_info', function (Blueprint $table) {
            $table->bigIncrements('pk_ct_info_id');
            $table->string('ct_name',250);
            $table->string('ct_contact_info',250);
            $table->string('ct_email',250);
            $table->date('ct_dob');
            $table->integer('ct_age');
            $table->string('ct_gender',20);
            $table->string('fk_service_grp_ids');
            $table->string('ct_address',250);
            $table->string('ct_city',250);
            $table->string('ct_state',250);
            $table->string('ct_country',250);
            $table->double('ct_salary',10,2);
            $table->string('police_checkup_status',50)->default('pending');
            $table->string('police_checkup_file',250);
            $table->string('training_certi_status',50)->default('pending');
            $table->string('training_certi_file',250);
            $table->string('other_doc_sataus',50)->default('pending');
            $table->string('other_doc_file',250);
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
        Schema::dropIfExists('tbl_ct_info');
    }
}
