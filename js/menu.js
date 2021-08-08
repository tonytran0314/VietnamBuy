let confirmLogout = document.querySelector(".confirm-logout");
let logoutHeader = document.querySelector(".logout-header");
let logoutContent = document.querySelector(".logout-content");
let btnCancel = document.querySelector(".btn-cancel");
let btnLogout = document.querySelector(".btn-logout");
let overlayBackground = document.querySelector(".overlay-background");

let logoutLink = document.querySelector('.logout-link');

let openConfirm = function() {
    confirmLogout.style.visibility = "visible";
    confirmLogout.style.transform = "translate(-50%, -50%) scale(1)";
    logoutHeader.style.visibility = "visible";
    logoutContent.style.visibility = "visible";
    btnCancel.style.visibility = "visible";
    btnLogout.style.visibility = "visible";
    overlayBackground.style.opacity = "1";
    overlayBackground.style.pointerEvents = "all";
}

let closeConfirm = function() {
    logoutHeader.style.visibility = "hidden";
    logoutContent.style.visibility = "hidden";
    btnCancel.style.visibility = "hidden";
    btnLogout.style.visibility = "hidden";
    confirmLogout.style.visibility = "hidden";
    confirmLogout.style.transform = "translate(-50%, -50%) scale(0)";
    overlayBackground.style.opacity = "0";
    overlayBackground.style.pointerEvents = "none";
}

let directToLogout = function() {
    window.location.href = "logout.php";
}