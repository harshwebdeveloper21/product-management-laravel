<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('products can be created', function () {
    $product = Product::factory()->create([
        'name' => 'Test Product',
        'size' => 'Large',
        'date' => '2025-12-25',
    ]);

    expect($product->name)->toBe('Test Product');
    expect($product->size)->toBe('Large');
    expect($product->date->format('Y-m-d'))->toBe('2025-12-25');
});

test('products can be retrieved', function () {
    $product = Product::factory()->create();

    $retrievedProduct = Product::find($product->id);

    expect($retrievedProduct)->not->toBeNull();
    expect($retrievedProduct->name)->toBe($product->name);
});