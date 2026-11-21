const search = document.getElementById('foodSearch');

const cards = [...document.querySelectorAll('.food-card')];

let category = 'all';

function filterFoods() {

    const q = (search?.value || '').toLowerCase();

    cards.forEach(c => {

        c.hidden = !(
            c.dataset.name.includes(q) &&
            (category === 'all' || c.dataset.cat === category)
        );

    });
}

document.querySelectorAll('.filter').forEach(b => {

    b.addEventListener('click', () => {

        document.querySelector('.filter.active')?.classList.remove('active');

        b.classList.add('active');

        category = b.dataset.cat;

        filterFoods();

    });

});

search?.addEventListener('input', filterFoods);