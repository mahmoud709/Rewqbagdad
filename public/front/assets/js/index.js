// initialize swiper [Testimonials with ONE Column]
if ($(".center-blogs  .swiper-container").length) {
    var testimonialsSlider_1 = new Swiper(".center-blogs  .swiper-container", {
        // Optional parameters

        grabCursor: true,
        centeredSlides: true,
        spaceBetween: 20,
        slidesPerView: 3,
        loop: true,
        rtl: true,
        slideShadows: false,
        navigation: {
            nextEl: ".nexts",
            prevEl: ".prevs",
        },
        coverflowEffect: {
            rotate: 5,
            stretch: 0,
            depth: 10,
            modifier: 2,
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
        },
        on: {
            resize: function () {
                this.update();
            },
        },
    });
}
var swiper = new Swiper(".researchers-sec .swiper-container", {
    spaceBetween: 30,
    centeredSlides: true,
    slidesPerView: 3,
    draggable: true,
    loop: true,
    rtl: true,
    keyboard: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
    },
});
var swipers = new Swiper(".our-books-sec .swiper-container", {
    spaceBetween: 50,
    centeredSlides: false,
    slidesPerView: 4,
    loop: true,
    rtl: true,
    keyboard: true,
    draggable: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".nexts",
        prevEl: ".prevs",
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
    },
});
//===== slick Slider testimonial Active
var swipers = new Swiper(".iraq-meters .swiper-container", {
    spaceBetween: 50,
    centeredSlides: true,
    slidesPerView: 1,
    loop: true,
    rtl: true,
    keyboard: true,
    draggable: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-nexts",
        prevEl: ".swiper-prevs",
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        1024: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
    },
});
var swiper = new Swiper(".mySwiper", {
    spaceBetween: 50,
    autoplay: true,
    draggable: true,
    loop: true,
    rtl: true,
    keyboard: true,
});

$(document).ready(function () {
    $("select").niceSelect();
});
var app = {
    settings: {
        container: $(".calendar"),
        calendar: $(".front"),
        days: $(".weeks span"),
        form: $(".back"),
        input: $(".back input"),
        buttons: $(".back button"),
    },

    init: function () {
        instance = this;
        settings = this.settings;
        this.bindUIActions();
    },

    swap: function (currentSide, desiredSide) {
        settings.container.toggleClass("flip");

        currentSide.fadeOut(900);
        currentSide.hide();
        desiredSide.show();
    },

    bindUIActions: function () {
        settings.days.on("click", function () {
            instance.swap(settings.calendar, settings.form);
            settings.input.focus();
        });

        settings.buttons.on("click", function () {
            instance.swap(settings.form, settings.calendar);
        });
    },
};

app.init();
AOS.init();
