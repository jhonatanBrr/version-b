import { CONTACT_FIELDS, hasErrors, validateContact } from './validate-contact';

/**
 * Contact form validated on submit with visible, accessible errors.
 * There is no backend: the success state is shown locally.
 */
export function initContactForm($panel) {
    const i18n = JSON.parse($panel.find('[data-contact-i18n]').text() || '{}');
    const $form = $panel.find('[data-contact-form]');
    const $success = $panel.find('[data-contact-success]');
    const $successText = $panel.find('[data-contact-success-text]');
    const $field = (name) => $form.find(`[name="${name}"]`);
    let errors = {};

    const values = () =>
        Object.fromEntries(CONTACT_FIELDS.map((name) => [name, String($field(name).val() ?? '')]));

    function showError(name, code) {
        const $control = $field(name);
        const $error = $(`#${$control.attr('id')}-error`);

        if (code) {
            $error.text(i18n.errors[code]).prop('hidden', false);
            $control
                .addClass('field__control--error')
                .attr({ 'aria-invalid': 'true', 'aria-describedby': $error.attr('id') });
        } else {
            $error.text('').prop('hidden', true);
            $control.removeClass('field__control--error').removeAttr('aria-invalid aria-describedby');
        }
    }

    function showErrors(nextErrors) {
        errors = nextErrors;
        CONTACT_FIELDS.forEach((name) => showError(name, errors[name]));
    }

    $form.on('submit', (event) => {
        event.preventDefault();
        const current = values();
        const nextErrors = validateContact(current);
        showErrors(nextErrors);

        if (hasErrors(nextErrors)) {
            const firstInvalid = CONTACT_FIELDS.find((name) => nextErrors[name]);
            $field(firstInvalid).trigger('focus');
            return;
        }

        $successText.text(
            i18n.successText.replace(':name', current.name.trim()).replace(':email', current.email.trim()),
        );
        $form[0].reset();
        $form.prop('hidden', true);
        $success.prop('hidden', false).trigger('focus');
    });

    // Once a field has an error, re-check it while typing so the message clears as soon as it is fixed.
    $form.on('input', '[name]', (event) => {
        const name = event.currentTarget.name;
        if (!errors[name]) return;
        const fieldError = validateContact(values())[name];
        if (fieldError) errors[name] = fieldError;
        else delete errors[name];
        showError(name, fieldError);
    });

    $panel.find('[data-contact-reset]').on('click', () => {
        showErrors({});
        $success.prop('hidden', true);
        $form.prop('hidden', false);
        $field('name').trigger('focus');
    });
}
