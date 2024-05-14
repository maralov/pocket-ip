import jQuery from "jquery";
jQuery(document).on("submit", ".modal-search-form", function (e) {
    e.preventDefault();
    var $form = jQuery(this);
    var url = $form.data("url");
    var $input = $form.find("input[type=\"text\"]");
    var query = $input.val();
    var $content = jQuery("#datafetch");
    var $notfound = $content.find(".js-modal-search-result-not-found");
    var $errorRes = $content.find(".js-modal-search-result-error");
    if (!query || query.length < 3) {
        $errorRes.removeClass("d-none");
        return;
    } else {
        $errorRes.addClass("d-none");
    }
    jQuery.ajax({
        url,
        type: "post",
        data: {action: "data_fetch", keyword: query},
        beforeSend: function () {
            $notfound.addClass("d-none");
            $input.prop("disabled", true);
            $form.addClass("submitting");
        },
        success: function (response) {
            $input.prop("disabled", false);
            $form.removeClass("submitting");
            if (!response.length) {
                $notfound.removeClass("d-none");
            } else {
                $content.html(response);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
    return false;
});

jQuery(function ($) {
    function openModal({event, type}) {
        const wpcf7Elm = document.querySelector(".wpcf7");
        const modalVideo = $(`.js-modal-${type}`);
        $("body").addClass("no-scroll backdrop");
        modalVideo.css("display", "flex").hide().fadeIn();
        if (event && event.currentTarget && $(event.currentTarget).hasClass("js-btn-video")) {
            const videoSrc = $(event.currentTarget).data("video");
            modalVideo.find("iframe").attr("src", `${videoSrc}?rel=0&autoplay=1&mute=1`);
        }

        if (event && event.currentTarget && $(event.currentTarget).hasClass("header__nav-search")) {
            $header.removeClass("open-nav");
            $("body").addClass("backdrop-full");
            $img.removeClass("is-active");
            toggleMenuBtn();
        }
    }

    $(".js-btn-video").on("click", function (e) {
        e.preventDefault();
        openModal({event: e, type: "video"});
    });

    $(".js-btn-search").on("click", function (e) {
        e.preventDefault();
        openModal({event: e, type: "search"});
    });

    $(".js-price-modal").on("click", function (e) {
        e.preventDefault();
        openModal({event: e, type: $(this)[0].hash.slice(1)});
    });

    wpcf7Elm?.addEventListener(
        "wpcf7submit",
        function () {
            openModal({type: "submit"});
        },
        false
    );

});
