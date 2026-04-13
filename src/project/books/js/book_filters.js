let applyBtn = document.getElementById('apply_filters');
let clearBtn = document.getElementById('clear_filters');
let form = document.getElementById('filters');
let cardsContainer = document.getElementById('book_cards');
let cards = document.querySelectorAll('.card');

applyBtn.addEventListener('click', (event) => {
    event.preventDefault();
    applyFilters();
});

clearBtn.addEventListener('click', (event) => {
    event.preventDefault();
    clearFilters();
});

function getFilters() {
    return {
        titleFilter: (form.elements['title_filter'].value || '').toLowerCase().trim(),
        publisherFilter: form.elements['publisher_filter'].value || '',
        formatFilter: form.elements['format_filter'].value || ''
    };
}

function cardMatches(card, filters) {
    let title = card.dataset.title.toLowerCase()
    let publisher = card.dataset.publisher
    let format = card.dataset.format

    let matchTitle = filters.titleFilter === "" || title.includes(filters.titleFilter);
    let matchPublisher = filters.publisherFilter === "" || publisher === filters.publisherFilter;
    let matchFormat = filters.formatFilter === "" || format.includes(filters.formatFilter);

    return matchTitle && matchPublisher && matchFormat;
}

function applyFilters() {
    let filters = getFilters();
    cards.forEach(card => {
        card.classList.toggle('hidden', !cardMatches(card, filters));
    });
}

function clearFilters() {
    form.reset();
    cards.forEach(card => card.classList.remove('hidden'));
}