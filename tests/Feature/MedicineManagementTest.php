<?php

namespace Tests\Feature;

use App\Models\Medicine;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicineManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_add_a_medicine(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/medicines', [
            'name' => 'Panadol',
            'price' => 50,
            'stock_quantity' => 100,
            'reorder_level' => 10,
            'expiry_date' => now()->addYear()->format('Y-m-d'),
        ]);

        $this->assertDatabaseHas('medicines', ['name' => 'Panadol']);
    }

    public function test_admin_can_update_medicine_stock(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $medicine = Medicine::factory()->create(['stock_quantity' => 50]);

        $this->actingAs($admin)->put("/admin/medicines/{$medicine->id}", [
            'name' => $medicine->name,
            'price' => $medicine->price,
            'stock_quantity' => 75,
            'reorder_level' => $medicine->reorder_level,
            'expiry_date' => $medicine->expiry_date,
        ]);

        $this->assertDatabaseHas('medicines', ['id' => $medicine->id, 'stock_quantity' => 75]);
    }

    public function test_out_of_stock_medicine_does_not_appear_in_shop(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        Medicine::factory()->create(['name' => 'Available Medicine', 'stock_quantity' => 10]);
        Medicine::factory()->create(['name' => 'Out of Stock Medicine', 'stock_quantity' => 0]);

        $response = $this->actingAs($customer)->get('/shop');

        $response->assertSee('Available Medicine');
        $response->assertDontSee('Out of Stock Medicine');
    }
}