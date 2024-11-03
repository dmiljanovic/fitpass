<?php

namespace Modules\Payment\Http\Repositories;

use Modules\Payment\Entities\Payment;
use Modules\Payment\Helpers\TransactionIdGenerator;

class PaymentRepository
{
    private TransactionIdGenerator $idGenerator;

    public function __construct(TransactionIdGenerator $idGenerator)
    {
        $this->idGenerator = $idGenerator;
    }

    public function isTicketPurchasedForEvent(array $data): bool
    {
        return Payment::where('event_id', $data['event_id'])
            ->where('email', $data['email'])
            ->exists();
    }

    public function purchaseTicket(array $data): Payment
    {
        return Payment::create([
            'event_id' => $data['event_id'],
            'email' => $data['email'],
            'transaction_id' => $this->idGenerator->generateTransactionId(),
        ]);
    }
}
