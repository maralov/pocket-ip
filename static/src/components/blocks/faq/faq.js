import jQuery from "jquery";

jQuery(function ($) {
    const $faqContainerRef = $("#faq-according");
    $faqContainerRef.on("click", function (e){
        const $target = $(e.target);

        if (!$target.hasClass("accordion-button")) return;

        const targetId = $target.data().bsTarget;
        const ariaExpanded = $target.attr("aria-expanded");
        ariaExpanded === "false" ? $target.attr("aria-expanded", "true") : $target.attr("aria-expanded", "false");
        $target.toggleClass("collapsed");
        $(targetId).toggleClass("show");
    });
});
