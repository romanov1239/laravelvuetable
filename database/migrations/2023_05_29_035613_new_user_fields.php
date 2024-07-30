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
        Schema::table('users', function(Blueprint $table){
            $table->string('position')->after('email_verified_at');
            $table->string('company')->after('email_verified_at');
            $table->string('lastname')->after('email_verified_at');
            $table->string('firstname')->after('email_verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn([
                'firstname','lastname',
                'company','position'
            ]);
        });
    }
};
