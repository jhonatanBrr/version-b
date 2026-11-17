<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    #[Test]
    public function the_italian_home_renders_hero_catalog_and_contact_sections(): void
    {
        $response = $this->get('/it')->assertOk();

        $response
            ->assertSee('data-page="home"', false)
            ->assertSee('Strumenti validati per la valutazione psicologica')
            ->assertSee('Esplora il catalogo')
            ->assertSee('id="catalogo"', false)
            ->assertSee('id="contatti"', false)
            ->assertSeeInOrder(['Tutti', 'Clinica e Neuropsicologia', 'Scuola ed Età evolutiva', 'Lavoro e Organizzazioni', 'Formazione'])
            ->assertSee('10 prodotti')
            ->assertSee('id="contact-name"', false)
            ->assertSee('id="contact-email"', false)
            ->assertSee('id="contact-message"', false)
            ->assertSee('Invia messaggio');

        $html = $response->getContent();
        $this->assertSame(10, substr_count($html, 'data-catalog-item'));
        $this->assertSame(10, substr_count($html, 'class="product-card"'));
        $this->assertSame(5, substr_count($html, 'data-category-chip'));
        $this->assertSame(4, substr_count($html, 'data-format-chip'));
        $this->assertSame(0, $this->countHiddenItems($html));
    }

    #[Test]
    public function the_spanish_home_renders_spanish_texts(): void
    {
        $this->get('/es')
            ->assertOk()
            ->assertSee('Explorar el catálogo')
            ->assertSee('Tests y cursos para cada ámbito')
            ->assertSee('Todos')
            ->assertSee('10 productos')
            ->assertSee('Enviar mensaje')
            ->assertDontSee('Esplora il catalogo');
    }

    #[Test]
    public function the_header_query_filters_the_catalog_server_side(): void
    {
        $html = $this->get('/it?q=sca')
            ->assertOk()
            ->assertSee('2 prodotti per «sca»')
            ->getContent();

        // Every product stays in the markup so the jQuery filters can bring it back,
        // but only the matching ones are visible without JavaScript.
        $this->assertSame(10, substr_count($html, 'data-catalog-item'));
        $this->assertSame(8, $this->countHiddenItems($html));
        $this->assertSame(1, preg_match('/<li data-catalog-item data-name="SCA-2[^>]*>/', $html, $scaItem));
        $this->assertStringNotContainsString('hidden', $scaItem[0]);
    }

    #[Test]
    public function a_query_without_matches_shows_the_empty_state(): void
    {
        $this->get('/it?q=zzzz')
            ->assertOk()
            ->assertSee('Nessun prodotto per «zzzz»')
            ->assertSee('Nessun prodotto trovato')
            ->assertSee('Azzera i filtri');
    }

    private function countHiddenItems(string $html): int
    {
        return preg_match_all('/<li[^>]*data-catalog-item[^>]*\shidden\s*>/', $html);
    }
}
