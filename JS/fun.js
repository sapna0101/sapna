$(document).ready(function(){
 
    let hamburger = document.querySelector('.hamburger');
    let ham2 = document.querySelector('.ham2');
    let mob_nav = document.querySelector('.mob_nav');
    let nav_link = document.querySelectorAll('.nav_link');
    // let nev_menu = document.querySelector('.nav_menu');

    hamburger.addEventListener('click',function(){
        mob_nav.classList.add('open');

    });

    ham2.addEventListener('click',function(){
        mob_nav.classList.remove('open');

    });
    nav_link.forEach( n => n.addEventListener('click',function(){
        mob_nav.classList.remove('open');

    }));

    
});