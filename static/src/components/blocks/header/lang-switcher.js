import jQuery from "jquery";

jQuery(function ($) {

    const $plSwitcherSelect = $("#lang_choice_1");
    const $selectList = $plSwitcherSelect.find("option");

    // function displayCurrentLang() {
    //     const currentLang = getCurrentLang();
    //     $(".lang-switcher-current").text(currentLang);
    // }
    //
    // function getCurrentLang() {
    //     let lang = "";
    //     $selectList.each((i, select) => {
    //         if($(select).attr("selected")){
    //             lang =  $(select).text();
    //         }
    //     });
    //     return lang;
    // }

    function renderLangSwitcherList() {
        $selectList.each((i, select) => {
            if (!$(select).attr("selected")) {
                $(".lang-switcher-list").append(`
				<li><a class href="${$(select).attr("value")}">${$(select).text()}</a></li>
			`);
            }

        });
    }

    // displayCurrentLang();
    renderLangSwitcherList();
});
