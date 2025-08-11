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
       Schema::table('courses', function (Blueprint $table) {
        $table->string('video_path')->nullable();
        $table->string('pdf_path')->nullable();
        $table->text('content_description')->nullable();
    });
}

public function down()
{
    Schema::table('courses', function (Blueprint $table) {
        $table->dropColumn(['video_path', 'pdf_path', 'content_description']);
    });
}
};
