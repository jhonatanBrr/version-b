<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CheckoutPageTest extends TestCase
{
    #[Test]
    public function the_italian_checkout_renders_the_form_sections_and_payment_methods(): void
    {
        $response = $this->get('/it/checkout');

        $response->assertOk()
            ->assertSee('data-page="checkout"', false)
            ->assertSee('<meta name="robots" content="noindex">', false)
            ->assertSee('id="checkout-form"', false)
            ->assertSee('novalidate', false)
            ->assertSeeInOrder(['<legend', '1. Contatto', '<legend', '2. Dati di fatturazione', '<legend', '3. Metodo di pagamento'], false)
            ->assertSee('role="radiogroup"', false)
            ->assertSee('Questa è una demo: nessun pagamento viene elaborato e non ti chiediamo i dati della carta.');

        foreach (['card', 'paypal', 'wallet', 'transfer', 'installments', 'docente'] as $method) {
            $response->assertSee('name="payment-method" value="'.$method.'"', false);
        }

        foreach (['Visa', 'Mastercard', 'American Express', 'PayPal', 'Apple Pay', 'Google Pay'] as $brand) {
            $response->assertSee('alt="'.$brand.'"', false);
        }
    }

    #[Test]
    public function the_checkout_never_asks_for_card_data(): void
    {
        $html = strtolower($this->get('/it/checkout')->getContent());

        $this->assertDoesNotMatchRegularExpression('/<input[^>]+name="[^"]*(card|cvv|cvc|expiry)[^"]*"/', $html);
    }

    #[Test]
    public function the_checkout_ships_the_catalog_and_texts_for_the_client(): void
    {
        $this->get('/it/checkout')
            ->assertSee('id="checkout-data"', false)
            ->assertSee('"editions"', false)
            ->assertSee('Paga :amount', false);
    }

    #[Test]
    public function the_spanish_checkout_is_translated(): void
    {
        $this->get('/es/checkout')
            ->assertOk()
            ->assertSee('<html lang="es">', false)
            ->assertSee('1. Contacto')
            ->assertSee('2. Datos de facturación')
            ->assertSee('3. Método de pago')
            ->assertSee('Esto es una demo: no se procesa ningún pago y no te pedimos los datos de la tarjeta.')
            ->assertDontSee('Dati di fatturazione');
    }
}
