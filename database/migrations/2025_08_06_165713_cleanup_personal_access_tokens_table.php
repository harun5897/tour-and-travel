<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('personal_access_tokens');
        DB::table('migrations')->where('migration', '2019_12_14_000001_create_personal_access_tokens_table')->delete();
    }

    public function down(): void
    {
        // nothing do
    }
};
