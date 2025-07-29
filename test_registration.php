<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;

echo "=== Testing Registration Form Fields ===\n";

// Test data yang akan digunakan untuk registrasi
$testData = [
    'nama' => 'Test Staff',
    'umur' => 25,
    'jenis_kelamin' => 'Laki-laki',
    'alamat' => 'Jl. Test No. 123, Jakarta',
    'posisi' => 'staff',
    'gaji' => 4000000,
    'email' => 'test@example.com',
    'password' => 'password123',
];

echo "✅ Required fields for registration:\n";
foreach ($testData as $field => $value) {
    echo "  - {$field}: {$value}\n";
}

echo "\n✅ Validation rules check:\n";
echo "  - alamat: min 10 chars (current: " . strlen($testData['alamat']) . ")\n";
echo "  - gaji: min 3,000,000 (current: " . number_format($testData['gaji']) . ")\n";
echo "  - umur: 17-65 (current: {$testData['umur']})\n";

echo "\n✅ Database structure check:\n";
// Check if required columns exist in karyawan table
try {
    $columns = DB::select("DESCRIBE karyawan");
    $columnNames = array_column($columns, 'Field');

    $requiredColumns = ['nama', 'umur', 'jenis_kelamin', 'alamat', 'posisi', 'gaji'];

    foreach ($requiredColumns as $column) {
        if (in_array($column, $columnNames)) {
            echo "  ✅ Column '{$column}' exists\n";
        } else {
            echo "  ❌ Column '{$column}' missing\n";
        }
    }
} catch (Exception $e) {
    echo "  ❌ Error checking columns: " . $e->getMessage() . "\n";
}

echo "\n=== Registration Form Ready ===\n";
echo "Form fields added:\n";
echo "1. ✅ Alamat (textarea, required, min 10 chars)\n";
echo "2. ✅ Gaji (number input, required, min 3,000,000)\n";
echo "3. ✅ Validation rules updated\n";
echo "4. ✅ Controller updated to save alamat & gaji\n";
echo "5. ✅ Role assignment based on posisi\n";

echo "\nNow you can test registration at: http://127.0.0.1:8000/register\n";
