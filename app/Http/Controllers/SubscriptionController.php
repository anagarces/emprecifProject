<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription;
use Stripe\Exception\ApiErrorException;
use Stripe\StripeClient;
use Stripe\PaymentMethod;
use Stripe\Exception\CardException;

class SubscriptionController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('cashier.secret'));
    }

    /**
     * Mostrar los planes disponibles
     */
     * Mostrar la página de planes de suscripción
     */
    public function plans()
    {
        $plans = $this->getPlans();
        $user = auth()->user();
        
        // Inicializar variables
        $onTrial = false;
        $trialEndsAt = null;
        $paymentMethods = [];
        
        if ($user) {
            // Verificar si el usuario está en período de prueba
            $onTrial = $user->onTrial('default') || 
                      ($user->trial_ends_at && $user->trial_ends_at->isFuture());
            
            $trialEndsAt = $user->trial_ends_at;
            
            // Si el usuario no tiene un período de prueba y no está suscrito, asignar uno
            if (!$user->subscribed('default') && !$trialEndsAt) {
                $trialEndsAt = now()->addDays(15);
                $user->update(['trial_ends_at' => $trialEndsAt]);
                $onTrial = true;
                
                return redirect()->route('subscription.plans')
                    ->with('status', '¡Bienvenido! Has recibido 15 días de prueba gratuita.');
            }
            
            // Obtener métodos de pago si el usuario está registrado en Stripe
            try {
                if ($user->hasStripeId()) {
                    $paymentMethods = $user->paymentMethods();
                }
            } catch (\Exception $e) {
                \Log::error('Error al cargar métodos de pago: ' . $e->getMessage());
            }
        }

        return view('subscription.plans', [
            'plans' => $plans,
            'onTrial' => $onTrial,
            'trialEndsAt' => $trialEndsAt,
            'user' => $user,
            'paymentMethods' => $paymentMethods,
            'intent' => $user ? $user->createSetupIntent() : null,
        ]);
    }

    /**
     * Procesar la suscripción
     */
    /**
     * Procesar la suscripción
     */
    public function subscribe(Request $request)
    {
        $user = Auth::user();
        $paymentMethod = $request->payment_method;
        $planId = $request->plan;
        $isTrial = $request->input('trial', false);

        try {
            // Validar que el plan existe
            $plans = $this->getPlans();
            if (!isset($plans[$planId])) {
                throw new \Exception('El plan seleccionado no es válido.');
            }

            // Si es un período de prueba sin tarjeta
            if ($isTrial && !$user->hasPaymentMethod()) {
                // Si ya tiene un período de prueba, no permitir otro
                if ($user->onTrialPeriod()) {
                    return response()->json([
                        'error' => 'Ya tienes un período de prueba activo.'
                    ], 422);
                }
                
                // Establecer la fecha de fin de prueba (15 días desde ahora)
                $trialEndsAt = now()->addDays(15);
                
                // Actualizar el usuario con la fecha de fin de prueba
                $user->forceFill([
                    'trial_ends_at' => $trialEndsAt,
                ])->save();

                return response()->json([
                    'success' => true,
                    'message' => '¡Período de prueba activado por 15 días!',
                    'redirect' => route('dashboard')
                ]);
            }

            // Si no es un período de prueba, proceder con el pago normal
            $user->createOrGetStripeClient();
            
            if ($paymentMethod) {
                $user->updateDefaultPaymentMethod($paymentMethod);
            }

            // Si ya tiene una suscripción, la actualizamos
            if ($user->subscribed('default')) {
                $user->subscription('default')->swap($planId);
            } else {
                // Crear nueva suscripción con período de prueba de 15 días
                $subscription = $user->newSubscription('default', $planId)
                    ->trialDays(15) // Período de prueba de 15 días
                    ->create($paymentMethod, [
                        'email' => $user->email,
                        'metadata' => [
                            'user_id' => $user->id,
                            'plan_name' => $plans[$planId]['name']
                        ]
                    ]);
                
                // Si se creó correctamente, actualizar el trial_ends_at
                if ($subscription && $subscription->trial_ends_at) {
                    $user->forceFill([
                        'trial_ends_at' => $subscription->trial_ends_at,
                    ])->save();
                }
            }

            return response()->json([
                'success' => true,
                'redirect' => route('subscription.success')
            ]);

        } catch (CardException $e) {
            return response()->json([
                'error' => 'Error en la tarjeta: ' . $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al procesar la suscripción: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener los planes disponibles
     */
    protected function getPlans()
    {
        return [
            'price_1P3aYdGv9X3X3X3X3X3X3X3X' => [
                'name' => 'Básico',
                'price' => 9.99,
                'features' => [
                    'Acceso a informes básicos',
                    'Búsqueda limitada',
                    'Soporte por correo electrónico'
                ]
            ],
            'price_1P3aZ0Gv9X3X3X3X3X3X3X3X' => [
                'name' => 'Profesional',
                'price' => 29.99,
                'features' => [
                    'Acceso a informes completos',
                    'Búsqueda ilimitada',
                    'Soporte prioritario',
                    'Exportación a PDF/Excel'
                ]
            ],
            'price_1P3aZgGv9X3X3X3X3X3X3X3X' => [
                'name' => 'Empresarial',
                'price' => 99.99,
                'features' => [
                    'Acceso completo a todas las funciones',
                    'Usuarios ilimitados',
                    'Soporte 24/7',
                    'API de integración',
                    'Informes personalizados'
                ]
            ],
        ];
    }

    /**
     * Página de éxito después de la suscripción
     */
    public function success()
    {
        if (!session()->has('subscription_success')) {
            return redirect()->route('subscription.plans');
        }

        return view('subscription.success');
    }

    /**
     * Página de cancelación
     */
    public function cancel()
    {
        return view('subscription.cancel');
    }

    /**
     * Portal de gestión de suscripción
     */
    public function portal()
    {
        try {
            $user = Auth::user();
            
            return $user->redirectToBillingPortal(route('dashboard'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Cancelar suscripción
     */
    public function cancelSubscription(Request $request)
    {
        try {
            $user = Auth::user();
            $user->subscription('default')->cancel();
            
            return redirect()->back()->with('success', 'Tu suscripción ha sido cancelada.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Reanudar suscripción
     */
    public function resumeSubscription()
    {
        try {
            $user = Auth::user();
            $user->subscription('default')->resume();
            
            return redirect()->back()->with('success', 'Tu suscripción ha sido reanudada.');
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
