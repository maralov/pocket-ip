import jQuery from "jquery";

jQuery(function ($) {
    const $countryTagsWrapper = $(".js-country-tags");
    const $countryTagsList = $(".js-country-tags .country-tag");

    function addCollapsedBtnToCroppedList() {
        if ($countryTagsList.length < 5) return;
        $countryTagsWrapper.append(
            "<button type='button' class='btn country-tag-button'><span>+</span> See more</button>"
        );
        $(".country-tag-button").on("click", displayAllList);
    }
    function displayAllList() {
        if ($countryTagsList.length < 5) return;
        const isBtnCollapsed = !$(this).attr("collapsed");
        if(isBtnCollapsed) {
            $(this).attr("collapsed", 1);
            $(this).html("<span>-</span> Hide info");
        } else {
            $(this).attr("collapsed", 0);
            $(this).html("<span>+</span> See more");
        }

        $countryTagsList.each(function (index) {
            if (index > 4) {
                $(this).toggleClass("country-tag--visible");
            }
        });
    }

    if ($countryTagsWrapper && $countryTagsWrapper.length) {
        addCollapsedBtnToCroppedList();
    }

});
