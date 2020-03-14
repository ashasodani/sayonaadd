<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblAdminGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_admin_groups', function (Blueprint $table) {
            $table->bigIncrements('pk_admin_grp_id');
            $table->string('group_name');
            $table->integer('fk_admin_user');
            $table->integer('fk_module_id');
            $table->integer('read_permission')->default(0);
            $table->integer('edit_permission')->default(0);
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
        Schema::dropIfExists('tbl_admin_groups');
    }
}
