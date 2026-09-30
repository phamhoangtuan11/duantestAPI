<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_only_sees_their_own_orders(): void
    {
        $buyer = User::factory()->create();
        $otherBuyer = User::factory()->create();
        $category = Category::create([
            'name' => 'Facebook',
            'slug' => 'facebook',
        ]);

        $buyerAccount = Account::create([
            'title' => 'Buyer account',
            'username' => 'buyer-visible-account',
            'price' => 100000,
            'category_id' => $category->id,
        ]);
        $otherAccount = Account::create([
            'title' => 'Other account',
            'username' => 'other-hidden-account',
            'price' => 200000,
            'category_id' => $category->id,
        ]);

        Order::create([
            'user_id' => $buyer->id,
            'account_id' => $buyerAccount->id,
            'username' => $buyerAccount->username,
            'password' => 'buyer-password',
            'price' => $buyerAccount->price,
            'status' => 'done',
        ]);
        Order::create([
            'user_id' => $otherBuyer->id,
            'account_id' => $otherAccount->id,
            'username' => $otherAccount->username,
            'password' => 'other-password',
            'price' => $otherAccount->price,
            'status' => 'done',
        ]);

        $response = $this
            ->actingAs($buyer)
            ->get('/my-orders');

        $response
            ->assertOk()
            ->assertSee('buyer-visible-account')
            ->assertDontSee('other-hidden-account');
    }

    public function test_guest_cannot_view_order_history(): void
    {
        $this->get('/my-orders')
            ->assertRedirect('/login');
    }
}
