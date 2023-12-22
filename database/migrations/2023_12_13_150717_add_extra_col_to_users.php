<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('employee_id')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('nrc_number')->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('gender')->default(false);
            $table->text('address')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->date('date_of_join')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'employee_id',
                'phone',
                'nrc_number',
                'birthday',
                'gender',
                'address',
                'department_id',
                'date_of_join',
                'status',
                'created_by',
                'updated_by',
                'deleted_by'
            ]);
        });
    }
};
