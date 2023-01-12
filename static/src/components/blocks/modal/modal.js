import jQuery from "jquery";
jQuery(document).on("submit", ".modal-search-form", function (e) {
    e.preventDefault();
    var $form = jQuery(this);
    var url = $form.data("url");
    var $input = $form.find("input[type=\"text\"]");
    var query = $input.val();
    var $content = jQuery("#datafetch");
    console.log("submit", $form, query);
    jQuery.ajax({
        url,
        type: "post",
        data: {action: "data_fetch", keyword: query},
        beforeSend: function () {
            $input.prop("disabled", true);
            $form.addClass("submitting");
        },
        success: function (response) {
            $input.prop("disabled", false);
            $form.removeClass("submitting");
            $content.html(response);
            console.log(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
            console.log(xhr.status);
            console.log(thrownError);
        }
    });
    return false;
});
