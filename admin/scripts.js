// shortcuts
const $=document.querySelector.bind(document);
const $$=document.querySelectorAll.bind(document);
const $$$=window.getComputedStyle.bind(window);

// open/close mob nav
function OPEN_MN() {$(".mob_nav").classList.remove("mn_closed")}
function CLOSE_MN() {$(".mob_nav").classList.add("mn_closed")}
