<?php

use App\Models\Order;
use App\Models\TicketType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('landing page shows active ticket types and hides inactive', function () {
    TicketType::factory()->create(['name' => 'Regular Day Pass', 'price' => 75000]);
    TicketType::factory()->inactive()->create(['name' => 'VIP Pass']);

    $this->get(route('ticket.landing'))
        ->assertOk()
        ->assertSee('Regular Day Pass')
        ->assertSee('75.000')
        ->assertDontSee('VIP Pass');
});

test('checkout creates pending order with items and total', function () {
    $type = TicketType::factory()->create(['name' => 'Regular', 'price' => 75000]);

    $response = $this->post(route('ticket.checkout.store'), [
        'customer_name' => 'Rico Muhammad',
        'customer_email' => 'rico@example.com',
        'customer_phone' => '081234567890',
        'items' => [['ticket_type_id' => $type->id, 'qty' => 2]],
    ]);

    $order = Order::first();
    expect($order)->not->toBeNull()
        ->and($order->status)->toBe(Order::STATUS_PENDING)
        ->and($order->total_amount)->toBe('150000.00')
        ->and($order->items)->toHaveCount(1)
        ->and($order->items->first()->qty)->toBe(2)
        ->and($order->order_number)->not->toBeNull();

    $response->assertRedirect(route('ticket.payment', $order->order_number));
});

test('checkout requires customer data', function () {
    $type = TicketType::factory()->create();

    $this->post(route('ticket.checkout.store'), [
        'items' => [['ticket_type_id' => $type->id, 'qty' => 1]],
    ])->assertSessionHasErrors(['customer_name', 'customer_email']);
});

test('checkout rejects inactive ticket type', function () {
    $type = TicketType::factory()->inactive()->create();

    $this->post(route('ticket.checkout.store'), [
        'customer_name' => 'Rico',
        'customer_email' => 'rico@example.com',
        'items' => [['ticket_type_id' => $type->id, 'qty' => 1]],
    ])->assertSessionHasErrors(['items.0.ticket_type_id']);
});

test('checkout rejects when ticket sold out', function () {
    $type = TicketType::factory()->limited(1)->create();
    $order = Order::factory()->create();
    $order->items()->create([
        'ticket_type_id' => $type->id,
        'ticket_name' => $type->name,
        'unit_price' => $type->price,
        'qty' => 1,
        'subtotal' => $type->price,
    ]);

    $this->post(route('ticket.checkout.store'), [
        'customer_name' => 'Rico',
        'customer_email' => 'rico@example.com',
        'items' => [['ticket_type_id' => $type->id, 'qty' => 1]],
    ])->assertSessionHasErrors(['items.0.ticket_type_id']);
});

test('payment page shows order details', function () {
    $order = Order::factory()->create([
        'order_number' => 'IGX-20260804-ABC123',
        'total_amount' => 150000,
    ]);

    $this->get(route('ticket.payment', $order->order_number))
        ->assertOk()
        ->assertSee('IGX-20260804-ABC123')
        ->assertSee('150.000');
});

test('proof upload marks order waiting confirmation', function () {
    Storage::fake('proofs');
    $order = Order::factory()->create();

    $this->post(route('ticket.payment.upload', $order->order_number), [
        'reference_number' => 'TRX12345',
        'proof' => UploadedFile::fake()->image('proof.jpg'),
    ])->assertRedirect(route('ticket.payment', $order->order_number));

    expect($order->fresh()->status)->toBe(Order::STATUS_WAITING_CONFIRMATION);
    expect($order->fresh()->payments)->toHaveCount(1);
});

test('status lookup finds order by number and email', function () {
    $order = Order::factory()->create(['customer_email' => 'rico@example.com']);

    $this->post(route('ticket.status.lookup'), [
        'order_number' => $order->order_number,
        'customer_email' => 'rico@example.com',
    ])->assertRedirect(route('ticket.payment', $order->order_number));
});

test('status lookup rejects mismatched email', function () {
    $order = Order::factory()->create(['customer_email' => 'rico@example.com']);

    $this->post(route('ticket.status.lookup'), [
        'order_number' => $order->order_number,
        'customer_email' => 'wrong@example.com',
    ])->assertSessionHasErrors('order_number');
});

test('confirm marks order paid', function () {
    $order = Order::factory()->create(['status' => Order::STATUS_WAITING_CONFIRMATION]);

    $order->confirm();

    expect($order->fresh()->status)->toBe(Order::STATUS_CONFIRMED);
    expect($order->fresh()->paid_at)->not->toBeNull();
});

test('ticket subdomain serves only ticket pages, main site untouched', function () {
    $host = config('app.ticket_domain');
    $mainHost = parse_url(config('app.url'), PHP_URL_HOST);
    TicketType::factory()->create(['name' => 'Isolated Pass']);

    // Ticket pages reachable on the ticket subdomain
    $this->get("http://{$host}/")->assertOk()->assertSee('Isolated Pass');
    $this->get("http://{$host}/status")->assertOk();

    // Main-site pages are NOT served on the ticket subdomain
    $this->get("http://{$host}/pals")->assertNotFound();
    $this->get("http://{$host}/news")->assertNotFound();
    $this->get("http://{$host}/admin")->assertNotFound();

    // Font route still served (custom typeface)
    $this->get("http://{$host}/font-css")->assertOk();

    // Main site still serves its own pages
    $this->get("http://{$mainHost}/pals")->assertOk();
});
