let submitBtn = document.getElementById('submit_btn');
let bookForm = document.getElementById('book_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let titleInput = document.getElementById('title');
let authorInput = document.getElementById('author');
let yearInput = document.getElementById('year');
let isbnInput = document.getElementById('isbn');
let publisherInput = document.getElementById('publisher_id');
let descriptionInput = document.getElementById('description');
let formatInputs = document.getElementsByName('format_ids[]');
let imageInput = document.getElementById('cover');

let titleError = document.getElementById('title_error');
let authorError = document.getElementById('author_error');
let yearError = document.getElementById('year_error');
let isbnError = document.getElementById('isbn_error');
let publisherError = document.getElementById('publishers_error');
let descriptionError = document.getElementById('description_error');
let formatError = document.getElementById('format_ids_error');
let imageError = document.getElementById('image_error');

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
    titleError.innerHTML = errors.title || '';
    authorError.innerHTML = errors.author || '';
    yearError.innerHTML = errors.year || '';
    isbnError.innerHTML = errors.isbn || '';
    publisherError.innerHTML = errors.publisher_id || '';
    descriptionError.innerHTML = errors.description || '';
    formatError.innerHTML = errors.format_ids || '';
    imageError.innerHTML = errors.image || '';
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

function isOnlyNumbers(value) {
    return /^[0-9-]+$/.test(String(value).trim());
}

function isInRange(value, min, max) {
    num = Number(value);
    return num >= min && num <= max;
}

function onSubmitForm(evt) {
    evt.preventDefault();

    errors = {};

    let titleMin = titleInput.dataset.minlength || 3;
    let titleMax = titleInput.dataset.maxlength || 255;
    let authorMin = authorInput.dataset.minlength || 3;
    let authorMax = authorInput.dataset.maxlength || 255;
    let descMin = descriptionInput.dataset.minlength || 10;
    let descMax = descriptionInput.dataset.maxlength || 5000;
    let isbnMin = isbnInput.dataset.minlength || 13;
    let isbnMax = isbnInput.dataset.maxlength || 13;
    let yearMin = yearInput.dataset.min || 1900;
    let yearMax = yearInput.dataset.max || 2099;   

    if(!isRequired(titleInput.value)){
        addError('title', 'Title is required');
    } else if(!isMinLength(titleInput.value, titleMin)) {
        addError('title', `Title must be at least ${titleMin} characters.`);
    } else if(!isMaxLength(titleInput.value, titleMax)) {
        addError('title', `Title must be less than ${titleMax} characters.`);
    }

    if (!isRequired(authorInput.value)) {
        addError('author', 'Author is required');
    } else if(!isMinLength(authorInput.value, authorMin)){
        addError('author', `Author input must be at least ${descMin} characters.`);
    } else if(!isMaxLength(authorInput.value, authorMax)) {
        addError('author', `Author input must be less than ${descMin} characters.`);
    }

    if (!isRequired(yearInput.value)) {
        addError('year', 'Year is required');
    } else if (!isInRange(yearInput.value, yearMin, yearMax)) {
    addError('year', `Year must be between ${yearMin} and ${yearMax}`);
}

    if (!isRequired(isbnInput.value)) {
        addError('isbn', 'ISBN is required');
    } else if (!isMinLength(isbnInput.value, isbnMin) || !isMaxLength(isbnInput.value, isbnMax)) {
        addError('isbn', `ISBN must be ${isbnMax} numbers`);
    } else if (!isOnlyNumbers(isbnInput.value)) {
        addError('isbn', 'ISBN must contain only numbers');
    } 

    if (!isRequired(publisherInput.value)) {
        addError('publisher_id', 'Publisher is required');
    }

    if(!isRequired(descriptionInput.value)){
        addError('description', 'Description is required');
    } else if(!isMinLength(descriptionInput.value, descMin)){
        addError('description', `Description must be at least ${descMin} characters.`);
    } else if(!isMaxLength(descriptionInput.value, descMax)) {
        addError('description', `Description must be less than ${descMin} characters.`);
    }

    let formatSelected = false;

    for (let i = 0; i < formatInputs.length; i++) {
        if (formatInputs[i].checked) {
            formatSelected = true;
            break;
        }
    }

    if (!formatSelected) {
        addError('format_ids', 'Select at least one format');
    }


    let isEditForm = bookForm.action.includes('book_update.php');

    if (!isEditForm && imageInput.files.length === 0) {
        addError('image', 'Image is required');
    }

    showFieldErrors();
    showErrorSummaryTop();

    if (Object.keys(errors).length === 0) {
        bookForm.submit();
        alert('form submitted');
    }
}
