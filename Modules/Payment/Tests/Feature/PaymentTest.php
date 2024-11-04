<?php

namespace Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Event\Entities\Event;
use Modules\Payment\Entities\Payment;
use Modules\Venue\Entities\Venue;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    private Event $event;
    private Payment $payment;

    public function setUp(): void
    {
        parent::setUp();

        $this->event = Event::factory()
            ->for(Venue::factory()->create())
            ->create();
        $this->payment = Payment::factory()
            ->for($this->event)
            ->create(['email' => 'test@test.com']);
    }

    public function test_make_payment()
    {
        $response = $this->postJson('/api/events/' . $this->event->id . '/purchase', [
            'email' => 'test1@test.com'
        ]);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'transaction_id'
            ]);
    }

    public function test_payment_already_made(): void
    {
        $response = $this->postJson('/api/events/' . $this->event->id . '/purchase', ['email' => 'test@test.com']);
        $response->assertStatus(500)
            ->assertJson([
                'error' => 'Email already used for this event.',
            ]);
    }

    public function test_no_payment_available(): void
    {
        $this->event->available_tickets = 0;
        $this->event->save();

        $response = $this->postJson('/api/events/' . $this->event->id . '/purchase', ['email' => 'test2@test.com']);
        $response->assertStatus(500)
            ->assertJson([
                'error' => 'No available seats for this event.',
            ]);
    }

    public function test_event_is_closed(): void
    {
        $this->event->ticket_sales_end_date = Carbon::now();
        $this->event->save();

        $response = $this->postJson('/api/events/' . $this->event->id . '/purchase', ['email' => 'test2@test.com']);
        $response->assertStatus(500)
            ->assertJson([
                'error' => 'The event is closed.',
            ]);
    }
}
