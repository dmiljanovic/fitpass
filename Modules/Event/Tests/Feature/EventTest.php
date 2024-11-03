<?php

namespace Modules\Event\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Modules\Event\Entities\Event;
use Modules\Venue\Entities\Venue;
use Tests\TestCase;

class EventTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    private Event $event;

    public function setUp(): void
    {
        parent::setUp();

        $this->event = Event::factory()
            ->for(Venue::factory()->create())
            ->create();
    }

    /** @test */
    public function test_get_all_events(): void
    {
        $response = $this->get('/api/events');

        $response->assertSee($this->event->name);
        $this->assertDatabaseCount('events', 1);
    }
}
