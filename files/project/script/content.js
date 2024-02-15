/**
 * Content Elements
 */
document.addEventListener("DOMContentLoaded", function(event) {
    

    var menu = document.querySelector('.mobile-nav-toggle');
    menu.addEventListener('click',(e)=>{
        menu.classList.toggle('active');
        document.querySelector('.navigation_main').classList.toggle('active');
    });



});