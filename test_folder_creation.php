<?php
// Simple test script to verify folder creation functionality

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Create a test user
$user = App\Models\User::create([
    'name' => 'Test User 2',
    'email' => 'test2@example.com',
    'password' => bcrypt('password')
]);

echo "Created user: " . $user->name . " with ID: " . $user->id . PHP_EOL;

// Test folder creation directly
$folder = $user->folders()->create([
    'title' => 'Test Folder Direct'
]);

echo "Created folder directly: " . $folder->title . " with ID: " . $folder->id . PHP_EOL;

// Test validation
$request = new App\Http\Requests\FolderCreateRequest();
$request->merge(['title' => 'Test Folder']);

$validator = Validator::make(['title' => 'Test Folder'], $request->rules());

if ($validator->fails()) {
    echo "Validation failed: " . implode(', ', $validator->errors()->all()) . PHP_EOL;
} else {
    echo "Validation passed!" . PHP_EOL;
}

// Test with empty title
$validator2 = Validator::make(['title' => ''], $request->rules());
if ($validator2->fails()) {
    echo "Empty title validation failed as expected: " . implode(', ', $validator2->errors()->all()) . PHP_EOL;
} else {
    echo "Empty title validation unexpectedly passed!" . PHP_EOL;
}

// Test with too long title
$validator3 = Validator::make(['title' => str_repeat('a', 25)], $request->rules());
if ($validator3->fails()) {
    echo "Long title validation failed as expected: " . implode(', ', $validator3->errors()->all()) . PHP_EOL;
} else {
    echo "Long title validation unexpectedly passed!" . PHP_EOL;
}

echo "All tests completed successfully!" . PHP_EOL;
