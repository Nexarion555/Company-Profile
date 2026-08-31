<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void {
Schema::create('clients',function(Blueprint $t){$t->id();$t->string('name');$t->string('pic')->nullable();$t->string('phone',50)->nullable();$t->string('email')->nullable();$t->unsignedInteger('projects')->default(0);$t->string('total',80)->default('Rp 0');$t->timestamps();});
Schema::create('messages',function(Blueprint $t){$t->id();$t->string('name',120);$t->string('email',160);$t->string('subject',200);$t->text('msg');$t->boolean('is_read')->default(false)->index();$t->timestamps();});
Schema::create('team_members',function(Blueprint $t){$t->id();$t->string('name');$t->string('role');$t->string('email')->nullable();$t->string('phone',50)->nullable();$t->string('img',1000)->nullable();$t->timestamps();});
Schema::create('company_settings',function(Blueprint $t){$t->id();$t->string('company');$t->text('address');$t->string('phone',50);$t->string('email');$t->string('whatsapp',50);$t->timestamps();});
} public function down(): void {Schema::dropIfExists('company_settings');Schema::dropIfExists('team_members');Schema::dropIfExists('messages');Schema::dropIfExists('clients');} };
