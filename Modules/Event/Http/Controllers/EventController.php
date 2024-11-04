<?php

namespace Modules\Event\Http\Controllers;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Event\Events\TicketIsPurchased;
use Modules\Event\Http\Repositories\EventRepository;
use Modules\Event\Http\Requests\PurchaseEventRequest;
use Modules\Event\Transformers\EventResource;
use Modules\Payment\Http\Repositories\PaymentRepository;
use Modules\Payment\Services\PaymentService;
use Symfony\Component\HttpFoundation\JsonResponse;

class EventController extends Controller
{
    private EventRepository $eventRepository;
    private PaymentService $paymentService;

    public function __construct(EventRepository $eventRepository, PaymentService $paymentService)
    {
        $this->eventRepository = $eventRepository;
        $this->paymentService = $paymentService;
    }

    /**
     * Display a listing of the resource.
     * @return AnonymousResourceCollection|JsonResponse
     */
    public function index(): AnonymousResourceCollection|JsonResponse
    {
        try {
            $events = $this->eventRepository->getAllEvents();
        } catch (\Exception $e) {
            Log::error('Error while getting all events: ' . $e);

            return response()->json(['message' => "Error while getting all events"], 500);
        }

        return EventResource::collection($events);
    }

    public function purchase(PurchaseEventRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $payment = $this->paymentService->purchaseTicket($request->all());

            event(new TicketIsPurchased($payment->event));
        } catch (\Exception $e) {
            Log::error('Error while making purchase: ' . $e);

            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 400);
        }

        DB::commit();

        return response()->json(['transaction_id' => $payment->transaction_id]);
    }
}
