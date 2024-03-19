<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->timestamps();
        });
        
        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->foreignIdFor(Role::class);
            $table->string('perm_module');
            $table->string('perm_type');
        });
        
        Schema::create('users_roles', function (Blueprint $table) {
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Role::class);
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('roles_permissions');
        Schema::dropIfExists('users_roles');
    }
};
