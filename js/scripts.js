/*!
* Start Bootstrap - Shop Homepage v5.0.6 (https://startbootstrap.com/template/shop-homepage)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-shop-homepage/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project
const carousel= new bootstrap.Carousel("#mok", {pause:false,interval:3000});
document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper('.swiper-container', {
      slidesPerView: 'auto',
      spaceBetween: 20,
      direction: 'horizontal', // Set the direction to horizontal
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  });
  