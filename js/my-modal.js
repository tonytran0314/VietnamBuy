let modal = document.querySelector(".modal");
let modalTitle = document.querySelector(".modal-title");
let modalContent = document.querySelector(".modal-content");
let overlay = document.querySelector(".overlay");

let openModal = function() {
    modal.style.visibility = "visible";
    modal.style.transform = "translate(-50%,-50%) scale(1)";
    modalTitle.style.visibility = "visible";
    modalContent.style.visibility = "visible";
    overlay.style.opacity = "1";
    overlay.style.pointerEvents = "all";
}

let closeModal = function() {
    modal.style.visibility = "hidden";
    modal.style.transform = "translate(-50%,-50%) scale(0)";
    modalTitle.style.visibility = "hidden";
    modalContent.style.visibility = "hidden";
    overlay.style.opacity = "0";
    overlay.style.pointerEvents = "none";
}