import jQuery from "jquery";

jQuery(function ($) {
    const $priceSwitcher = $(".js-pricing-switcher");

    function togglePriceContent(type){
        $(".pricing").attr("data-price", type);
    }

    $priceSwitcher.on("click", function (e) {
        const $target = $(e.target);
        if($target.hasClass("js-pricing-month") && !$target.hasClass("is-active")) {
            $target.addClass("is-active");
            $target.siblings(".js-pricing-year").removeClass("is-active");
            $(this).removeClass("year-active").addClass("month-active");
            togglePriceContent("month");
        }

        if ($target.hasClass("js-pricing-year") && !$target.hasClass("is-active")) {
            $target.addClass("is-active");
            $target.siblings(".js-pricing-month").removeClass("is-active");
            $(this).removeClass("month-active").addClass("year-active");
            togglePriceContent("year");
        }

        if($target.parent().hasClass("js-pricing-year") && !$target.parent().hasClass("is-active")) {
            $target.parent().addClass("is-active");
            $target.parent().siblings(".js-pricing-month").removeClass("is-active");
            $(this).removeClass("month-active").addClass("year-active");
            togglePriceContent("year");
        }
    });
});
