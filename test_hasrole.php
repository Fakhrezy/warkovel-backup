<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$user = new App\Models\User;
echo method_exists($user, 'hasRole') ? 'hasRole method exists' : 'hasRole method NOT found';
echo PHP_EOL;

$reflectionClass = new ReflectionClass($user);
$traits = $reflectionClass->getTraitNames();
echo "Traits used: " . implode(', ', $traits) . PHP_EOL;
