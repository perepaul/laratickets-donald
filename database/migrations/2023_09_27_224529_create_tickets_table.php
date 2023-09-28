<?php

use App\Models\Category;
use App\Models\Priority;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_id')->unique()->index();
            $table->string('title');
            $table->text('description');
            $table->foreignIdFor(User::class);
            $table->enum('status', ['open', 'closed'])->default('open');
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Priority::class);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
