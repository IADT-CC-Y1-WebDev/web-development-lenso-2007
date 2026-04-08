let submitBtn = document.getElementById('submit_btn');
let bookForm = document.getElementById('book_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let titleInput = document.getElementById('title');
let authorInput = document.getElementById('author');
let yearInput = document.getElementById('year');
let isbnInput = document.getElementById('isbn');
let publisherIdInput = document.getElementById('publisher_id');
let descriptionInput = document.getElementById('description');
let formatIdsInput = document.getElementsByName('format_ids[]');
let coverInput = document.getElementById('cover');

let titleError = document.getElementById('title_error');
let authorError = document.getElementById('author_error');
let yearError = document.getElementById('year_error');
let isbnError = document.getElementById('isbn_error');
let publisherIdError = document.getElementById('publisher_id_error');
let descriptionError = document.getElementById('description_error');
let formatIdsError = document.getElementById('format_ids_error');
let coverError = document.getElementById('cover_error');

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
    publisherIdError.innerHTML = errors.publisher_id || '';
    descriptionError.innerHTML = errors.description || '';
    formatIdsError.innerHTML = errors.format_ids || '';
    coverError.innerHTML = errors.cover || '';
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

    let titleMin = titleInput.dataset.minlength || 3;
    let titleMax = titleInput.dataset.maxlength || 255;
    let descMin = descriptionInput.dataset.minlength || 10;

    if(!isRequired(titleInput.value)){
        addError('title', 'Title is required');
    } else if(!isMinLength(titleInput.value, titleMin)) {
        addError('title', 'Title must be at least '+ titleMin + ' characters.');
    } else if(!isMaxLength(titleInput.value, titleMax)) {
        addError('title', 'Title must be less than ' + titleMax + ' characters.');
    }

    if(!isRequired(authorInput.value)){
        addError('author', 'Author is required');
    }

    if(!isRequired(yearInput.value)){
        addError('year', 'Year is required');
    }

    if(!isRequired(isbnInput.value)){
        addError('isbn', 'ISBN is required');
    } else if(!isMinLength(isbnInput.value, 13) || !isMaxLength(isbnInput.value, 13)){
        addError('isbn', 'ISBN must be exactly 13 characters');
    }

    if(!isRequired(publisherIdInput.value)){
        addError('publisher_id', 'Publisher is required');
    }

    if(!isRequired(descriptionInput.value)){
        addError('description', 'Description is required');
    } else if(!isMinLength(descriptionInput.value, descMin)){
        addError('description', `Description must be at least ${descMin} characters.`);
    }

    let formatSelected = false;
    for(let i = 0; i < formatIdsInput.length; i++){
        if(formatIdsInput[i].checked){
            formatSelected = true;
            break;
        }
    }
    if(!formatSelected){
        addError('format_ids', 'Select at least one format');
    }

    showFieldErrors();
    showErrorSummaryTop();

    if(Object.keys(errors).length === 0){
        bookForm.submit();
        alert('form submitted');
    }
}