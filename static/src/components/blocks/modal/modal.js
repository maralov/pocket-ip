import jQuery from "jquery";
jQuery(function ($) {
    function closeModal() {
        $("body").removeClass("no-scroll backdrop");
        $(".modal").hide().find("iframe").attr("src", "");
    }
    function openModal({event, type}) {
        const modalVideo = $(`.js-modal-${type}`);


        if(event && event.currentTarget && $(event.currentTarget).hasClass("js-btn-video")) {
            const videoSrc = $(event.currentTarget).data("video");
            modalVideo.find("iframe").attr("src", `${videoSrc}?rel=0&autoplay=1&mute=1`);
        }

        $("body").addClass("no-scroll backdrop");
        modalVideo.css("display", "flex").hide().fadeIn();
    }

    $(".js-btn-video").on("click", function (e) {
        e.preventDefault();
        openModal({event:e, type:"video"});
    });

    $(".modal").on("click", closeModal);

    const wpcf7Elm = document.querySelector(".wpcf7");

    wpcf7Elm?.addEventListener("wpcf7submit", function () {
        openModal({type: "submit"});
    }, false);

});

