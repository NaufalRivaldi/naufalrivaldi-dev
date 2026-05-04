<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('desc', 'subtitle');
            $table->dropColumn('thumbnail_url');
            $table->string('client')->nullable()->after('subtitle');
            $table->string('role')->nullable()->after('client');
            $table->string('duration')->nullable()->after('role');
            $table->text('challenge')->nullable()->after('duration');
            $table->text('solution')->nullable()->after('challenge');
            $table->json('outcome')->nullable()->after('solution');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('subtitle', 'desc');
            $table->string('thumbnail_url')->nullable();
            $table->dropColumn(['client', 'role', 'duration', 'challenge', 'solution', 'outcome']);
        });
    }
};
