let submitBtn = document.getElementById('submit_btn');
let publisherForm = document.getElementById('publisher_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let nameInput = document.getElementById('name');
let nameError = document.getElementById('name_error');

let errors = {};

submitBtn.addEventListener('click', onSubmitForm);

function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showErrorSummaryTop() {
    const messages = Object.values(errors);
    if (messages.length === 0) {
        errorSummaryTop.style.display = 'none';
        errorSummaryTop.innerHTML = '';
        return;
    }
    errorSummaryTop.innerHTML =
        '<strong>Please fix the following:</strong><ul>' +
        messages
            .map(function (m) {
                return '<li>' + m + '</li>';
            })
            .join('') +
        '</ul>';
    errorSummaryTop.style.display = 'block';
}

function showFieldErrors() {
    nameError.innerHTML = errors.name || '';
}

function isRequired(value) {
    return String(value).trim() !== '';
}

function isMinLength(value, min) {
    return String(value).trim().length >= min;
}

function isMaxLength(value, max) {
    return String(value).trim().length <= max;
}

function onSubmitForm(evt) {
    evt.preventDefault();

    errors = {};

    let nameMin = nameInput.dataset.minlength || 3;
    let nameMax = nameInput.dataset.maxlength || 255;

    if (!isRequired(nameInput.value)) {
        addError('name', 'Name is required');
    } else if (!isMinLength(nameInput.value, nameMin)) {
        addError('name', `Name must be at least ${nameMin} characters.`);
    } else if (!isMaxLength(nameInput.value, nameMax)) {
        addError('name', `Name must be less than ${nameMax} characters.`);
    }

    showFieldErrors();
    showErrorSummaryTop();

    if (Object.keys(errors).length === 0) {
        publisherForm.submit();
    }
}