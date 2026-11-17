<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ComingSoonAndNotFoundTest extends TestCase
{
    #[Test]
    public function a_known_section_is_named_in_the_coming_soon_title(): void
    {
        $this->get('/it/in-arrivo?sezione=login')
            ->assertOk()
            ->assertSee('<meta name="robots" content="noindex">', false)
            ->assertSee('«Accedi» è in arrivo')
            ->assertSee('role="img"', false);
    }

    #[Test]
    public function an_unknown_section_falls_back_to_the_generic_title(): void
    {
        $this->get('/it/in-arrivo?sezione=nonsense')
            ->assertOk()
            ->assertSee('Questa sezione è in arrivo')
            ->assertDontSee('»', false);
    }

    #[Test]
    public function the_coming_soon_page_is_translated(): void
    {
        $this->get('/es/in-arrivo?sezione=login')->assertOk()->assertSee('«Acceder» está en preparación');
    }

    #[Test]
    public function unknown_italian_paths_render_the_italian_404(): void
    {
        $this->get('/it/qualcosa')
            ->assertNotFound()
            ->assertSee("Questa pagina manca all'appello")
            ->assertSee('Errore 404')
            ->assertSee('Torna al catalogo');
    }

    #[Test]
    public function unknown_spanish_paths_render_the_spanish_404(): void
    {
        $this->get('/es/nada')
            ->assertNotFound()
            ->assertSee('A esta página le falta una pieza')
            ->assertDontSee("Questa pagina manca all'appello");
    }
}
