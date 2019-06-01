const button = document.querySelector('#button');
const form = document.querySelector('.form');

button.addEventListener('click', (e) => {
    e.stopPropagation();
    e.preventDefault();
  form.classList.toggle('form--open');
});