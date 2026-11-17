import { initCatalog } from './home/catalog';
import { initContactForm } from './home/contact';

/** Home page behaviour (jQuery). Receives the page root element. */
export function initHome($root) {
    const $catalog = $root.find('[data-catalog]');
    if ($catalog.length) initCatalog($catalog);

    const $contact = $root.find('[data-contact]');
    if ($contact.length) initContactForm($contact);
}
