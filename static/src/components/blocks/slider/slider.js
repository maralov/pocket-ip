import jQuery from "jquery";
import "slick-carousel";

jQuery(function ($) {
    $(".slider-rows").each(	function (s,i) {

        $(i).attr("id", `slider-rows-${s}`);

        const $sliderRows = $(`#slider-rows-${s}  .slider__wrapper`);

        $sliderRows.slick({
            rows: 2,
            dots: true,
            arrows: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 1,
            appendArrows: $(`#slider-rows-${s} .slider__controls`),
            appendDots: $(`#slider-rows-${s} .slider__dots`),
            dotsClass: "slider__dots-list",
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                    }
                },
            ],
        });
    });
    $(".slider-card").each(	function (s,i) {

        $(i).attr("id", `slider-card-${s}`);

        const $sliderRows = $(`#slider-card-${s}  .slider__wrapper`);

        $sliderRows.slick({
            dots: true,
            arrows: true,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 1,
            appendArrows: $(`#slider-card-${s} .slider__controls`),
            appendDots: $(`#slider-card-${s} .slider__dots`),
            dotsClass: "slider__dots-list",
            responsive: [
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ],
        });
    });
});
