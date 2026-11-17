/** Checkout form validation (pure functions, no DOM). */

/** Order in which fields appear in the form (used to focus the first error). */
export const CHECKOUT_FIELDS = ['email', 'firstName', 'lastName', 'taxId', 'sdi', 'address', 'postalCode', 'city'];

const REQUIRED = ['email', 'firstName', 'lastName', 'taxId', 'address', 'postalCode', 'city'];

const EMAIL = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
const CODICE_FISCALE = /^[A-Z]{6}\d{2}[A-Z]\d{2}[A-Z]\d{3}[A-Z]$/i;
const PARTITA_IVA = /^\d{11}$/;
const CAP = /^\d{5}$/;
const MIN_NAME_LENGTH = 2;

/** Accepts an Italian codice fiscale (16 chars) or a Partita IVA (11 digits). */
export function isTaxId(value) {
    const v = String(value).trim();
    return CODICE_FISCALE.test(v) || PARTITA_IVA.test(v);
}

/**
 * Validates the checkout values; returns one error code per invalid field
 * ("required", "email", "minLength", "taxId", "postalCode").
 */
export function validateCheckout(input) {
    const values = {};
    CHECKOUT_FIELDS.forEach((field) => {
        values[field] = String(input[field] ?? '').trim();
    });

    const errors = {};
    REQUIRED.forEach((field) => {
        if (!values[field]) errors[field] = 'required';
    });

    if (!errors.email && !EMAIL.test(values.email)) errors.email = 'email';
    if (!errors.firstName && values.firstName.length < MIN_NAME_LENGTH) errors.firstName = 'minLength';
    if (!errors.lastName && values.lastName.length < MIN_NAME_LENGTH) errors.lastName = 'minLength';
    if (!errors.taxId && !isTaxId(values.taxId)) errors.taxId = 'taxId';
    if (!errors.postalCode && !CAP.test(values.postalCode)) errors.postalCode = 'postalCode';

    return errors;
}
