import jQuery from 'jquery';
jQuery(function ($) {
	const wpcf7Elm = document.querySelector('.wpcf7');
	const $header = $('.js-header');
	const $headerPanel = $('.js-info-panel');
	const headerPanelCurrentText = $headerPanel.find('.info-panel__text').text().toLowerCase();
	const headerPanelPrevText = localStorage.getItem('infoPanelPrevText') || '';
	const $menuButton = $('.js-menu-btn');
	const $img = $menuButton.find('img');
	const $headerItemWithChildren = $('.js-header-nav .menu-item-has-children > a');
	const $docEl = $(document.documentElement);
	const $window = $(window);
	const isDisplayInfoPanel = JSON.parse(localStorage.getItem('isDisplayInfoPanel'));
	console.log($headerPanel);

	if ($headerPanel && !isDisplayInfoPanel && headerPanelCurrentText !== headerPanelPrevText) {
		$headerPanel.toggleClass('d-none');
	}

	function closeModal() {
		$('body').removeClass('no-scroll backdrop backdrop-full');
		$('.modal').hide().find('iframe').attr('src', '');
		$img.removeClass('is-active');
		$header.removeClass('open-nav');
	}

	$docEl.on('click', (e) => {
		if ($(e.target).hasClass('backdrop')) {
			closeModal();
			toggleMenuBtn();
		}
	});

	$('.js-modal-btn-close').on('click', closeModal);

	let prevScroll = $window.scrollTop() || $docEl.scrollTop();
	let curScroll;
	let direction = 0;
	let prevDirection = 0;

	function toggleHeader(direction, curScroll) {
		if (direction === 2 && curScroll > $headerPanel.height() + $header.height()) {
			$header.removeClass('show');
			prevDirection = direction;
		} else if (direction === 1) {
			$header.addClass('show');
			prevDirection = direction;
		}
	}

	function checkScroll() {
		curScroll = $window.scrollTop() || $docEl.scrollTop();
		if ($window.scrollTop() > $window.height() / 2) {
			$header.addClass('header-fixed');
			$('main').css('margin-top', $header.outerHeight());
		} else {
			$header.removeClass('header-fixed');
			$('main').css('margin-top', 0);
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

	$window.on('scroll', checkScroll);

	function toggleHeaderActiveClass() {
		$header.toggleClass('open-nav');
		$img.toggleClass('is-active');
		$('body').toggleClass('no-scroll backdrop');
	}

	function setMobileMenuHeight() {
		if ($window.width() >= 1024) return;
		const headerHeight = $header.outerHeight();
		let panelHeight = $headerPanel.length ? $headerPanel[0].offsetHeight : 0;
		if ($window.scrollTop() > panelHeight) {
			panelHeight = 0;
		}

		const menuHeight = $(window).height() - headerHeight - panelHeight;
		$('.js-header-nav').css('height', menuHeight);
	}

	function closeInfoPanel(e) {
		if (
			$(e.target).parent().hasClass('js-info-panel-close') ||
			$(e.target).hasClass('js-info-panel-close')
		) {
			$(this).hide();
			localStorage.setItem('isDisplayInfoPanel', 'false');
			localStorage.setItem(
				'infoPanelPrevText',
				$(this).find('.info-panel__text').text().toLowerCase()
			);
			setMobileMenuHeight();
		}
	}

	if ($(window).width() < 1110) {
		$headerItemWithChildren.on('click', function () {
			$(this).parent().toggleClass('sub-menu-is-open');
			$(this).parent().siblings('.menu-item-has-children').removeClass('sub-menu-is-open');
		});
	}

	function toggleMenuBtn() {
		if ($img.hasClass('is-active')) {
			const imgSrc = $img.attr('src').replace('ic-menu', 'ic-close-primary');
			$img.attr('src', imgSrc);
		} else {
			const imgSrc = $img.attr('src').replace('ic-close-primary', 'ic-menu');
			$img.attr('src', imgSrc);
		}
	}

	$menuButton.on('click', function () {
		setMobileMenuHeight();
		toggleHeaderActiveClass();
		toggleMenuBtn();
	});

	function openModal({ event, type }) {
		const modalVideo = $(`.js-modal-${type}`);
		$('body').addClass('no-scroll backdrop');
		modalVideo.css('display', 'flex').hide().fadeIn();
		if (event && event.currentTarget && $(event.currentTarget).hasClass('js-btn-video')) {
			const videoSrc = $(event.currentTarget).data('video');
			modalVideo.find('iframe').attr('src', `${videoSrc}?rel=0&autoplay=1&mute=1`);
		}

		if (event && event.currentTarget && $(event.currentTarget).hasClass('header__nav-search')) {
			$header.removeClass('open-nav');
			$('body').addClass('backdrop-full');
			$img.removeClass('is-active');
			toggleMenuBtn();
		}
	}

	$('.js-btn-video').on('click', function (e) {
		e.preventDefault();
		openModal({ event: e, type: 'video' });
	});

	$('.js-btn-search').on('click', function (e) {
		e.preventDefault();
		openModal({ event: e, type: 'search' });
	});

	wpcf7Elm?.addEventListener(
		'wpcf7submit',
		function () {
			openModal({ type: 'submit' });
		},
		false
	);

	$($headerPanel).click(closeInfoPanel);
});
