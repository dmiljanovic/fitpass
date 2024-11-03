<?php

namespace Modules\Payment\Helpers;

use Illuminate\Support\Str;
use Modules\Payment\Entities\Payment;

class TransactionIdGenerator {

    /**
     * Generates transaction id string
     */
    public function generateTransactionId(): string
    {
        $transactionId = Str::uuid();

        if(Payment::where('transaction_id', $transactionId )->exists()) {
            $this->generateTransactionId();
        }

        return $transactionId;
    }

}
