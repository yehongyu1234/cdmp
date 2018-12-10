<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('project_id')->unique();
            $table->string('name')->default('')->comment('//项目编号');
            $table->string('body')->default('')->comment('//项目介绍');
            $table->string('manager')->default('')->comment('//管理员');
            $table->string('managerid')->default('')->comment('//管理ID');
            $table->string('images')->default('')->comment('//图片');
            $table->string('complet_time')->default('')->comment('//完成时间');
            $table->string('pro_drawings')->default('')->comment('//预计图纸数量');
            $table->string('harder')->default('')->comment('//难度');
            $table->string('type')->default('')->comment('//类型');
            $table->string('pro_creator')->default('')->comment('//创建人');
            $table->string('user_id')->default('')->comment('//创建人ID');
            $table->string('qrcode')->default('')->comment('//二维码图片路径');
            $table->string('connector')->default('')->comment('//市场对接人');
            $table->string('connector_id')->default('')->comment('//市场对接人id');
            $table->string('hetong_statue')->default('')->comment('//合同签订状态');
            $table->string('location')->default('')->comment('//位置');
            $table->string('designer')->default('')->comment('//设计师');
            $table->text('statue');
            $table->string('area')->default('')->comment('//面积');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
