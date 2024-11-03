<?php

namespace Modules\Payment\Services;

use Carbon\Carbon;
use Modules\Event\Http\Repositories\EventRepository;
use Modules\Payment\Entities\Payment;
use Modules\Payment\Http\Repositories\PaymentRepository;

class PaymentService
{
    private PaymentRepository $paymentRepository;
    private EventRepository $eventRepository;

    public function __construct(PaymentRepository $paymentRepository, EventRepository $eventRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->eventRepository = $eventRepository;
    }

    public function purchaseTicket(array $data): Payment
    {
        $event = $this->eventRepository->getEventById($data['event_id']);
        $payment = $this->paymentRepository->isTicketPurchasedForEvent($data);

        if ($payment) {
            throw new \Exception('Email already used for this event.');
        }

        if ($event->available_tickets === 0) {
            throw new \Exception('No available seats for this event.');
        }

        if (Carbon::parse($event->ticket_sales_end_date)->lessThan(Carbon::now())) {
            throw new \Exception('The event is closed.');
        }

        return $this->paymentRepository->purchaseTicket($data);
    }
}
