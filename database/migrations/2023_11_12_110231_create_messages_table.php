<?php

use App\Models\Conversation;
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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Conversation::class, 'conversation_id');
            $table->foreignIdFor(App\Models\User::class, 'sender_id');
            $table->foreignIdFor(App\Models\User::class, 'receiver_id');
            $table->text('message')->nullable();
            $table->boolean('read')->default(false);
            $table->string('type')->nullable();
            $table->boolean('deleted_by_sender')->default(false);
            $table->boolean('deleted_by_receiver')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
