import jQuery from "jquery";

jQuery(function ($) {
    const $countryTagsWrapper = $(".js-country-tags");
    const $countryTagsList = $(".js-country-tags .country-tag");

    function addCollapsedBtnToCroppedList() {
        if ($countryTagsList.length <= 4) return;
        $countryTagsWrapper.append(
            "<button type='button' class='btn country-tag-button' ><span>+</span> See more</button>"
        );
        $(".country-tag-button").on("click", displayAllList);
    }
    function displayAllList() {
        const isBtnCollapsed = !Number($(this).attr("data-collapsed"));

        if(isBtnCollapsed) {
            $(this).attr("data-collapsed", 1);
            $(this).html("<span>-</span> Hide info");
        } else {
            $(this).attr("data-collapsed", 0);
            $(this).html("<span>+</span> See more");
        }

        $countryTagsList.each(function (index) {
            if (index >= 4) {
                $(this).toggleClass("country-tag--visible");
            }
        });
    }

    if ($countryTagsWrapper && $countryTagsWrapper.length) {
        addCollapsedBtnToCroppedList();
    }

});
