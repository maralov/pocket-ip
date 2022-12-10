import jQuery from "jquery";
jQuery(function ($) {
    const $header = $(".js-header");
    const $headerPanel = $(".js-info-panel");
    const $menuButton = $(".js-menu-btn");
    const $headerItemWithChildren = $(".js-header-nav .menu-item-has-children > a");
    const $docEl = $(document.documentElement);
    const $window = $(window);

    $docEl.on("click", (e) => {
        if ($(e.target).hasClass("no-scroll")){
            toggleHeaderActiveClass();
            toggleMenuBtn();
        }
    });

    let prevScroll = $window.scrollTop() || $docEl.scrollTop();
    let curScroll;
    let direction = 0;
    let prevDirection = 0;

    function toggleHeader (direction, curScroll) {
        if (direction === 2 && curScroll > $headerPanel.height() + $header.height()) {
            $header.removeClass("show");
            prevDirection = direction;
        } else if (direction === 1) {
            $header.addClass("show");
            prevDirection = direction;
        }
    }

    function checkScroll () {
        curScroll = $window.scrollTop() || $docEl.scrollTop();
        if($window.scrollTop() > $window.height() / 2 ) {
            $header.addClass("header-fixed");
            $("main").css("margin-top", $header.outerHeight());
        } else {
            $header.removeClass("header-fixed");
            $("main").css("margin-top", 0);
        }


        if (curScroll > prevScroll) {
            //scrolled up
            direction = 2;
        } else if (curScroll < prevScroll) {
            //scrolled down
            direction = 1;
        }

        if (direction !== prevDirection) {
            toggleHeader(direction, curScroll);
        }
        prevScroll = curScroll;
    }

    $window.on("scroll", checkScroll);


    function toggleHeaderActiveClass() {
        $header.toggleClass("open-nav");
        $("body").toggleClass("no-scroll backdrop");
    }

    function setMobileMenuHeight() {
        if ($window.width() >= 1024) return;
        const headerHeight = $header.outerHeight();
        let panelHeight = $headerPanel[0].offsetHeight;

        if ($window.scrollTop() > panelHeight) {
            panelHeight = 0;
        }

        const menuHeight = $(window).height() - headerHeight - panelHeight;
        $(".js-header-nav").css("height", menuHeight);
    }

    function closeInfoPanel(e) {
        if ($(e.target).parent().hasClass("js-info-panel-close") || $(e.target).hasClass("js-info-panel-close")) {
            $(this).hide();
            setMobileMenuHeight();
        }
    }

    if ($(window).width() < 1110) {
        $headerItemWithChildren.on("click", function () {

            $(this).parent().toggleClass("sub-menu-is-open");
            $(this).parent().siblings(".menu-item-has-children").removeClass("sub-menu-is-open");
        });
    }

    function toggleMenuBtn() {
        const $img = $menuButton.find("img");
        $img.toggleClass("is-active");
        if ($img.hasClass("is-active")) {
            const imgSrc = $img.attr("src").replace("ic-menu", "ic-close-primary");
            $img.attr("src", imgSrc);
        } else {
            const imgSrc = $img.attr("src").replace("ic-close-primary", "ic-menu");
            $img.attr("src", imgSrc);
        }
    }

    $menuButton.on("click", function () {
        setMobileMenuHeight();
        toggleHeaderActiveClass();
        toggleMenuBtn();
    });

    $($headerPanel).click(closeInfoPanel);
});
