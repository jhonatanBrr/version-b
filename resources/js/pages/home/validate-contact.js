/**
 * Pure contact-form validation (no DOM). Values are trimmed first; the result
 * holds only the failing fields, mapped to message keys of home.contact.errors.
 */

export const NAME_MIN_LENGTH = 2;
export const MESSAGE_MIN_LENGTH = 10;
export const CONTACT_FIELDS = ['name', 'email', 'message'];

/** Pragmatic format check: something@domain.tld with no spaces. */
const EMAIL_PATTERN = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

/**
 * @param {{ name: string, email: string, message: string }} values
 * @returns {Partial<Record<'name'|'email'|'message', string>>}
 */
export function validateContact(values) {
    const name = values.name.trim();
    const email = values.email.trim();
    const message = values.message.trim();
    const errors = {};

    if (!name) errors.name = 'nameRequired';
    else if (name.length < NAME_MIN_LENGTH) errors.name = 'nameTooShort';

    if (!email) errors.email = 'emailRequired';
    else if (!EMAIL_PATTERN.test(email)) errors.email = 'emailInvalid';

    if (!message) errors.message = 'messageRequired';
    else if (message.length < MESSAGE_MIN_LENGTH) errors.message = 'messageTooShort';

    return errors;
}

export function hasErrors(errors) {
    return Object.keys(errors).length > 0;
}
