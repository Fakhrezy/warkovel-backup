<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Users created:" . PHP_EOL;
$users = App\Models\User::with('roles')->get();
foreach ($users as $user) {
    echo $user->name . ' (' . $user->email . ') - Roles: ' . $user->getRoleNames()->implode(', ') . PHP_EOL;
}
