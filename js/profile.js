let btnOpenForm = document.querySelector('.btn-open-form');
let overlayEditName = document.querySelector('.overlay-edit-name');
let btnCloseForm = document.querySelector('.btn-close-form');
let editNameForm = document.querySelector('.edit-name-form');

btnOpenForm.addEventListener('click', () => {
    overlayEditName.style.opacity = '1';
    overlayEditName.style.pointerEvents = 'all';
    editNameForm.style.visibility = 'visible';
    editNameForm.style.transform = 'translate(-50%, -50%) scale(1)';
})

overlayEditName.addEventListener('click', () => {
    overlayEditName.style.opacity = '0';
    overlayEditName.style.pointerEvents = 'none';
    editNameForm.style.visibility = 'hidden';
    editNameForm.style.transform = 'translate(-50%, -50%) scale(0)';
})

btnCloseForm.addEventListener('click', () => {
    overlayEditName.style.opacity = '0';
    overlayEditName.style.pointerEvents = 'none';
    editNameForm.style.visibility = 'hidden';
    editNameForm.style.transform = 'translate(-50%, -50%) scale(0)';
})