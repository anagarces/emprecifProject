<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierWebhookController;

class WebhookController extends CashierWebhookController
{
    /**
     * Handle invoice payment succeeded.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentSucceeded($payload)
    {
        // Lógica para manejar un pago de factura exitoso
        Log::info('Pago de factura exitoso', $payload);
        
        return $this->successMethod();
    }

    /**
     * Handle subscription created.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerSubscriptionCreated($payload)
    {
        // Lógica para manejar la creación de una suscripción
        Log::info('Nueva suscripción creada', $payload);
        
        return $this->successMethod();
    }

    /**
     * Handle subscription updated.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerSubscriptionUpdated($payload)
    {
        // Lógica para manejar la actualización de una suscripción
        Log::info('Suscripción actualizada', $payload);
        
        return $this->successMethod();
    }

    /**
     * Handle subscription deleted.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleCustomerSubscriptionDeleted($payload)
    {
        // Lógica para manejar la eliminación de una suscripción
        Log::info('Suscripción eliminada', $payload);
        
        return $this->successMethod();
    }
}
