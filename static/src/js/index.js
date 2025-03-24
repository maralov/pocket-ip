import '%components%/header/header';
import '%components%/header/lang-switcher';
import '%components%/slider/slider';
import '%components%/faq/faq';
import '%components%/country-tag/country-tags';
import '%components%/modal/modal';
import '%components%/calculator/calculator';
import '%components%/tabs/tabs';
import '%components%/form/form';
import '%modules%/home-page/prices/pricesTabs';

import jQuery from 'jquery';

jQuery(function ($) {
  $('.js-content-search input').on('input', function () {
    const searchText = $(this).val().toLowerCase().trim();

    $('.js-countries-list .col').each(function () {
      const countryName = $(this).find('.js-country-name').text().toLowerCase();
      if (countryName.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  $('.js-select-search input[type=text]').on('input', function () {
    const searchText = $(this).val().toLowerCase().trim();

    $('.checkbox-container').each(function () {
      const countryName = $(this).text().toLowerCase();
      if (countryName.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});
