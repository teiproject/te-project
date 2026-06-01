<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('reference')->unique();
            $table->string('client_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('service');
            $table->string('platform')->nullable();
            $table->json('features')->nullable();
            $table->unsignedInteger('timeline_weeks')->default(4);
            $table->unsignedInteger('pages')->default(5);
            $table->unsignedInteger('base_price')->default(0);
            $table->unsignedInteger('estimated_price')->default(0);
            $table->text('budget_range')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('submitted');
            $table->timestamp('demo_submitted_at')->nullable();
            $table->timestamp('demo_approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_requests');
    }
};
