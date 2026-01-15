<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            //
        
            $table->unsignedBigInteger('manager_id')->nullable()->after('staff_id');

        // Add foreign key constraint
        $table->foreign('manager_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('tasks', function (Blueprint $table) {
        $table->dropForeign(['manager_id']);
        $table->dropColumn('manager_id');
    });
}
};
