<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_admin_users', function (Blueprint $table) {
            $table->bigIncrements('pk_admin_users_id');
            $table->string('admin_name');
//            $table->string('fk_admin_grp_ids',50);
            $table->string('address',250);
            $table->string('city',250);
            $table->string('state',250);
            $table->string('country',250);
            $table->date('dob');
            $table->integer('age');
            $table->string('gender',20);
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
        Schema::dropIfExists('tbl_admin_users');
    }
}
