<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // User aliyefanya action
            $table->string('event'); 
            $table->string('table_name'); 
            $table->text('old_data')->nullable(); 
            $table->text('new_data')->nullable(); 
            $table->string('ip_address')->nullable(); 
          //  $table->foreignId('pharmacy_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
};
