<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductPageTest extends TestCase
{
    private const TEST_URL = '/it/prodotti/sca-2-screening-cognitivo-adulti';

    private const COURSE_URL = '/it/prodotti/corso-valutazione-neuropsicologica-eta-evolutiva';

    #[Test]
    public function a_test_page_renders_name_price_editions_and_buy_actions(): void
    {
        $this->get(self::TEST_URL)
            ->assertOk()
            ->assertSee('data-page="product"', false)
            ->assertSee('<h1', false)
            ->assertSee('SCA-2 · Scala di Screening Cognitivo per Adulti')
            ->assertSee('1.062,50 €')
            ->assertSee('1.250,00 €')
            ->assertSee('Scegli l&#039;edizione', false)
            ->assertSeeInOrder(['Kit completo', '25 somministrazioni online', 'Manuale'])
            ->assertSee('type="radio"', false)
            ->assertSee('Aggiungi al carrello')
            ->assertSee('Procedi al pagamento')
            ->assertSee('Risparmi 187,50 € (-15%)')
            ->assertSee('IVA inclusa')
            ->assertSee('Scheda tecnica')
            ->assertSee('Potrebbe interessarti anche');
    }

    #[Test]
    public function a_test_page_shows_its_spec_line_and_qualification_note(): void
    {
        $this->get(self::TEST_URL)
            ->assertSee('18–90 anni · 15–20 min · Individuale · Livello B')
            ->assertSee('Attivazione immediata sulla piattaforma online')
            ->assertSee('Per l&#039;acquisto è richiesto il livello di qualifica B', false);
    }

    #[Test]
    public function the_page_publishes_product_json_ld_and_open_graph_tags(): void
    {
        $response = $this->get(self::TEST_URL);

        $response->assertSee('<script type="application/ld+json">', false)
            ->assertSee('"@type":"Product"', false)
            ->assertSee('"price":"1062.50"', false)
            ->assertSee('"priceCurrency":"EUR"', false)
            ->assertSee('<meta property="og:title"', false);
    }

    #[Test]
    public function the_editions_are_passed_to_jquery_as_json_data(): void
    {
        $this->get(self::TEST_URL)
            ->assertSee('<script type="application/json" data-product-data>', false)
            ->assertSee('"id":"refill"', false)
            ->assertSee('"salePrice":136', false);
    }

    #[Test]
    public function a_course_shows_its_start_date_and_no_edition_selector(): void
    {
        $this->get(self::COURSE_URL)
            ->assertOk()
            ->assertSee('Inizio 15 gennaio 2027')
            ->assertSee('Programma')
            ->assertSee('Riceverai un&#039;email di conferma con i dettagli di accesso', false)
            ->assertDontSee('type="radio"', false)
            ->assertDontSee('Scegli l&#039;edizione', false)
            ->assertDontSee('livello di qualifica');
    }

    #[Test]
    public function the_spanish_page_uses_spanish_labels(): void
    {
        $this->get('/es/prodotti/sca-2-screening-cognitivo-adulti')
            ->assertOk()
            ->assertSee('<html lang="es">', false)
            ->assertSee('Elige la edición')
            ->assertSee('Añadir al carrito')
            ->assertSee('Ir al pago')
            ->assertSee('Ficha técnica')
            ->assertSee('18–90 años')
            ->assertSee('Cribado breve de memoria');
    }

    #[Test]
    public function an_unknown_slug_is_404(): void
    {
        $this->get('/it/prodotti/does-not-exist')->assertNotFound();
    }
}
