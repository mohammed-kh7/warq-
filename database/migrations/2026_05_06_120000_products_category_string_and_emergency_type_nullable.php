<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE products MODIFY COLUMN category VARCHAR(100) NOT NULL DEFAULT 'عام'");
            DB::statement('ALTER TABLE emergency_requests MODIFY COLUMN type VARCHAR(255) NULL');
        }
    }

    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            DB::statement("UPDATE products SET category = 'أغذية' WHERE category NOT IN ('ملابس','أغذية','دواء')");
            DB::statement('ALTER TABLE emergency_requests MODIFY COLUMN type VARCHAR(255) NOT NULL');
            DB::statement("ALTER TABLE products MODIFY COLUMN category ENUM('ملابس','أغذية','دواء') NOT NULL");
        }
    }
};
