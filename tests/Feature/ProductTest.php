<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('user can view products', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();

    $response = $this->actingAs($user)->get(route('products.index'));

    $response->assertStatus(200);
    $response->assertSee($product->name);
});

test('user can create product', function () {
    $user = User::factory()->create();
    Storage::fake('public');
    
    $response = $this->actingAs($user)->post(route('products.store'), [
        'name' => 'Test Product',
        'size' => 'Large',
        'date' => '2025-12-25',
    ]);

    $response->assertRedirect(route('products.index'));
    $response->assertSessionHas('success');
    
    $this->assertDatabaseHas('products', [
        'name' => 'Test Product',
        'size' => 'Large',
    ]);
});

test('user can update product', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    
    $response = $this->actingAs($user)->put(route('products.update', $product), [
        'name' => 'Updated Product',
        'size' => 'Medium',
        'date' => '2025-12-26',
    ]);

    $response->assertRedirect(route('products.index'));
    $response->assertSessionHas('success');
    
    $this->assertDatabaseHas('products', [
        'name' => 'Updated Product',
        'size' => 'Medium',
    ]);
});

test('user can delete product', function () {
    $user = User::factory()->create();
    $product = Product::factory()->create();
    
    $response = $this->actingAs($user)->delete(route('products.destroy', $product));

    $response->assertRedirect(route('products.index'));
    $response->assertSessionHas('success');
    
    $this->assertDatabaseMissing('products', [
        'id' => $product->id,
    ]);
});
