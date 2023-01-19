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
