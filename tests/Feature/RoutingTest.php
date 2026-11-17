<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RoutingTest extends TestCase
{
    #[Test]
    public function the_root_redirects_to_the_default_locale(): void
    {
        $this->get('/')->assertRedirect('/it');
    }

    #[Test]
    public function each_supported_locale_renders_the_home_in_its_language(): void
    {
        $this->get('/it')->assertOk()->assertSee('<html lang="it">', false);
        $this->get('/es')->assertOk()->assertSee('<html lang="es">', false);
    }

    #[Test]
    public function a_known_product_slug_renders_and_an_unknown_one_is_404(): void
    {
        $this->get('/it/prodotti/sca-2-screening-cognitivo-adulti')->assertOk();
        $this->get('/it/prodotti/does-not-exist')->assertNotFound();
    }

    #[Test]
    public function unknown_paths_render_the_localized_404(): void
    {
        $this->get('/es/no-existe')->assertNotFound()->assertSee('<html lang="es">', false);
        $this->get('/fr')->assertNotFound()->assertSee('<html lang="it">', false);
    }

    #[Test]
    public function checkout_and_coming_soon_pages_render(): void
    {
        $this->get('/it/checkout')->assertOk();
        $this->get('/es/in-arrivo?sezione=login')->assertOk();
    }
}
