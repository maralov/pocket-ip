import jQuery from "jquery";
jQuery(function ($) {
    function closeModal() {
        $("body").removeClass("no-scroll backdrop");
        $(".modal").hide().find("iframe").attr("src", "");
    }
    function openModal(e) {
        const modalVideo = $(".js-modal-video");
        $("body").addClass("no-scroll backdrop");
        modalVideo.css("display", "flex").hide().fadeIn();

        if(e.currentTarget && $(e.currentTarget).hasClass("js-btn-video")) {
            const videoSrc = $(e.currentTarget).data("video");
            modalVideo.find("iframe").attr("src", `${videoSrc}?rel=0&autoplay=1&mute=1`);
        }
    }

    $(".js-btn-video").on("click", function (e) {
        e.preventDefault();
        openModal(e);
    });

    $(".modal").on("click", closeModal);

});

