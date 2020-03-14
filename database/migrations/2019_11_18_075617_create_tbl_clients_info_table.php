<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblClientsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_clients_info', function (Blueprint $table) {
            $table->bigIncrements('pk_client_id');
            $table->string('client_name',250);
            $table->string('client_contact_no',15);
            $table->string('client_email',250);
            $table->date('client_dob');
            $table->integer('client_age');
            $table->string('client_gender',10);
            $table->string('client_address',250);
            $table->string('client_city',250);
            $table->string('client_state',250);
            $table->string('health_conditions',250)->nullable(true);
            $table->string('kin_name',250);
            $table->string('kin_phone_no',15);
            $table->string('kin_email',50);
            $table->integer('fk_ct_id')->nullable(true);
            $table->double('received_amount')->nullable(0.00);
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
        Schema::dropIfExists('tbl_clients_info');
    }
}
