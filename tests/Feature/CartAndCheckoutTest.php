<?php

namespace Tests\Feature;

use App\Models\Medicine;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartAndCheckoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_add_medicine_to_cart(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $medicine = Medicine::factory()->create(['stock_quantity' => 20]);

        $this->actingAs($customer)->post("/cart/add/{$medicine->id}");

        $response = $this->actingAs($customer)->get('/cart');

        $response->assertSee($medicine->name);
    }

    public function test_checkout_reduces_stock(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $medicine = Medicine::factory()->create([
            'stock_quantity' => 20,
            'requires_prescription' => false,
        ]);

        $this->actingAs($customer)->post("/cart/add/{$medicine->id}");

        $this->actingAs($customer)->post('/checkout', [
            'delivery_address' => '123 Main Street, Jaffna',
            'phone' => '0771234567',
        ]);

        $this->assertDatabaseHas('medicines', [
            'id' => $medicine->id,
            'stock_quantity' => 19,
        ]);

        $this->assertDatabaseHas('orders', [
            'user_id' => $customer->id,
            'delivery_address' => '123 Main Street, Jaffna',
        ]);
    }

    public function test_checkout_requires_prescription_for_restricted_medicine(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $medicine = Medicine::factory()->create([
            'stock_quantity' => 20,
            'requires_prescription' => true,
        ]);

        $this->actingAs($customer)->post("/cart/add/{$medicine->id}");

        $response = $this->actingAs($customer)->post('/checkout', [
            'delivery_address' => '123 Main Street, Jaffna',
            'phone' => '0771234567',
        ]);

        $response->assertSessionHasErrors('prescription');

        // Stock should NOT be reduced since order failed validation
        $this->assertDatabaseHas('medicines', [
            'id' => $medicine->id,
            'stock_quantity' => 20,
        ]);
    }

    public function test_cannot_checkout_with_empty_cart(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($customer)->get('/checkout');

        $response->assertRedirect(route('cart.index'));
    }
}