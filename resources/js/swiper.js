 // import Swiper JS
 import Swiper from 'swiper';
 // import Swiper styles
 import 'swiper/css';
 // core version + navigation, pagination modules:
 import Swiper, { Navigation, Pagination } from 'swiper';
 // import Swiper and modules styles
 import 'swiper/css';
 import 'swiper/css/navigation';
 import 'swiper/css/pagination';

 // init Swiper:
 var swiper = new Swiper('.swi', {

 loop : true,

    breakpoints: {
        376: {
            slidesPerView: 1,
            spaceBetween: 40,
        },

    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    // Optional parameters   


})

