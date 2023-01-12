import jQuery from "jquery";
jQuery(document).on("submit", ".modal-search-form", function (e) {
	e.preventDefault();
    var $form = jQuery(this);
    var $input = $form.find("input[type=\"text\"]");
    var query = $input.val();
    var $content = jQuery(".modal-search__result");
	console.log('submit', $form, query);
    jQuery.ajax({
        type: "post",
        url: myAjax.ajaxurl,
        data: {
            action: "load_search_results",
            query: query
        },
        beforeSend: function () {
            $input.prop("disabled", true);
            $form.addClass("submitting");
        },
        success: function (response) {
            $input.prop("disabled", false);
            $form.removeClass("submitting");
            // $content.html(response);
            console.log(response);
        }
    });
    return false;
});
