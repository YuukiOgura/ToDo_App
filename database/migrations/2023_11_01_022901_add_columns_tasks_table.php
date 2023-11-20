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
        //タイトル説明文登録のためのカラム追加
        Schema::table('tasks',function(Blueprint $table){
            $table->string('textarea',255)->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('tasks',function(Blueprint $table){
            $table->dropColumn('textarea');
        });
    }
};
