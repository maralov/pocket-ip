document.addEventListener('DOMContentLoaded', function () {
  const dropdowns = document.querySelectorAll('.select-dropdown');
  const calcForms = document.querySelectorAll('.js-calc-form');
  const priceCache = {};
  const defaultCurrency = 'USD';

  // Закриття всіх випадаючих списків при кліку поза ними
  document.addEventListener('click', function (e) {
    dropdowns.forEach((dropdown) => {
      if (
        !dropdown.contains(e.target) &&
        !dropdown.previousElementSibling.contains(e.target)
      ) {
        dropdown.style.display = 'none';
        dropdown.previousElementSibling.setAttribute('aria-expanded', 'false');
      }
    });
  });

  // Вибір валюти з дропдауну
  document.querySelectorAll('.currency-option').forEach((option) => {
    option.addEventListener('click', function () {
      const selectedCurrency = this.getAttribute('data-currency-code');
      const currencyDropdown = this.closest('.custom-select');
      const calcForm = currencyDropdown.closest('.js-calc-form');
      const classesCount = calcForm.querySelector('.js-counter-value').value;

      // Оновлюємо атрибут поточної валюти в формі
      calcForm.setAttribute('data-selected-currency', selectedCurrency);

      // Оновлення відображення вибраної валюти
      currencyDropdown.querySelector('.selected-values__text').textContent =
        selectedCurrency;
      currencyDropdown
        .querySelectorAll('.currency-option')
        .forEach((opt) => opt.classList.remove('selected'));
      this.classList.add('selected');

      // Закриваємо дропдаун після вибору
      currencyDropdown.querySelector('.select-dropdown').style.display = 'none';

      // Оновлюємо ціни при зміні валюти
      updatePrices(calcForm, classesCount, selectedCurrency);
    });
  });

  document.querySelectorAll('.js-calc-form').forEach((calcForm) => {
    calcForm.setAttribute('data-selected-currency', defaultCurrency);
  });

  // Встановлюємо 'USD' як обрану валюту за замовчуванням
  const defaultCurrencyElement = document.querySelector(
    `.currency-option[data-currency-code="${defaultCurrency}"]`
  );
  if (defaultCurrencyElement) {
    document.querySelector(
      '.currency-select .selected-values__text'
    ).textContent = defaultCurrency;
    defaultCurrencyElement.classList.add('selected');
  }

  // Фільтрація списку валют у пошуку
  document
    .querySelectorAll('.js-select-search input[type="text"]')
    .forEach((input) => {
      input.addEventListener('input', function () {
        const filter = this.value.toLowerCase();
        const options =
          this.closest('.select-dropdown').querySelectorAll('.currency-option');
        options.forEach((option) => {
          const text = option.textContent.toLowerCase();
          option.style.display = text.includes(filter) ? 'block' : 'none';
        });
      });
    });

  // Ініціалізація форм та обробників
  calcForms.forEach((calcForm) => {
    const countryCurrencyMap = {};

    calcForm.querySelectorAll('.js-price-card').forEach((card) => {
      const countryCode = card.getAttribute('data-country-code');
      if (countryCode) {
        countryCurrencyMap[countryCode] = { description: defaultCurrency };
      }
    });

    calcForm.addEventListener('click', function (e) {
      const selectedValue =
        e.target.matches('.selected-values') ||
        e.target.closest('.selected-values');
      if (selectedValue) {
        toggleDropdown(e.target.closest('.custom-select'));
      }

      handleCounter(e, calcForm, countryCurrencyMap);
    });

    calcForm.addEventListener('change', function (e) {
      handleCheckboxChange(e, calcForm);
    });

    calcForm.addEventListener('input', function (e) {
      if (e.target.classList.contains('js-counter-value')) {
        const currency =
          calcForm.getAttribute('data-selected-currency') || defaultCurrency;

        updatePrices(calcForm, e.target.value, currency);
      }
    });

    calcForm.addEventListener(
      'blur',
      function (e) {
        if (e.target.classList.contains('js-counter-value')) {
          validateAndCorrectInput(e.target, calcForm);
        }
      },
      true
    );
  });

  // Відкриття/закриття дропдауну
  function toggleDropdown(customSelect) {
    const dropdown = customSelect.querySelector('.select-dropdown');
    const isOpen = dropdown.style.display === 'block';
    dropdown.style.display = isOpen ? 'none' : 'block';
    customSelect
      .querySelector('.selected-values')
      .setAttribute('aria-expanded', String(!isOpen));
  }

  // Обробка лічильника класів
  function handleCounter(e, calcForm, countryCurrencyMap) {
    const incrementButton = e.target.closest('.js-counter-increment');
    const decrementButton = e.target.closest('.js-counter-decrement');

    if (incrementButton || decrementButton) {
      const inputField = calcForm.querySelector('.js-counter-value');
      const currentValue = parseInt(inputField.value);

      if (incrementButton) {
        inputField.value = currentValue + 1;
      } else if (decrementButton && currentValue > 1) {
        inputField.value = currentValue - 1;
      }

      calcForm.querySelector('.js-counter-decrement').disabled =
        parseInt(inputField.value) <= 1;

      // Оновлюємо ціни з урахуванням обраної валюти для поточного табу
      const currency =
        calcForm.getAttribute('data-selected-currency') || defaultCurrency;
      updatePrices(calcForm, inputField.value, currency);
    }
  }

  // Валідація та корекція значень введення
  function validateAndCorrectInput(inputField, calcForm) {
    let value = parseInt(inputField.value);
    if (value < 1 || isNaN(value)) {
      inputField.value = 1;
    }
    calcForm.querySelector('.js-counter-decrement').disabled =
      inputField.value <= 1;

    const currency =
      calcForm.getAttribute('data-selected-currency') || defaultCurrency;

    updatePrices(calcForm, value, currency);
  }

  // Обробка чекбоксів для вибору країн
  function handleCheckboxChange(e, calcForm) {
    if (e.target.type === 'checkbox') {
      const countryCode = e.target.value.toLowerCase();
      const priceCards = calcForm.querySelectorAll(
        `.js-price-card[data-country-code="${countryCode}"]`
      );
      priceCards.forEach((card) => {
        card.style.display = e.target.checked ? 'block' : 'none';
        if (e.target.checked) unfade(card);
      });
      updateSelectedValues(calcForm);
    }
  }

  // Оновлення вибраних значень у списку країн
  function updateSelectedValues(calcForm) {
    const checkboxes = calcForm.querySelectorAll(
      '.select-dropdown input[type="checkbox"]'
    );
    const selectedValues = Array.from(checkboxes)
      .filter((cb) => cb.checked)
      .map((cb) => cb.parentNode.textContent.trim());
    calcForm.querySelector('.selected-values__text').textContent =
      selectedValues.length > 0
        ? selectedValues.join(', ')
        : 'Choose country...';
  }

  // Оновлення цін при зміні кількості класів або валюти
  function updatePrices(calcForm, classesCount, currency) {
    const cacheKey = generateCacheKey(classesCount, currency);

    // Перевірка кешу
    if (priceCache[cacheKey]) {
      updatePriceCards(calcForm, priceCache[cacheKey]);
    } else {
      const requestData = {
        countryCurrencyMap: createCountryCurrencyMap(calcForm, currency),
        classesQuantity: Number(classesCount) || 1,
      };

      toggleLoadingState(calcForm);

      fetch('https://dev.pocketip.com/api/task/task/cost-by-country', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(requestData),
      })
        .then((response) => response.json())
        .then((data) => {
          if (isDataDifferent(data, cacheKey)) {
            priceCache[cacheKey] = data;
            updatePriceCards(calcForm, data);
          }
        })
        .catch((error) => {
          displayErrorText(calcForm);
          console.error('Error:', error);
        })
        .finally(() => toggleLoadingState(calcForm));
    }
  }

  // Генерує карту країн з вибраною валютою
  function createCountryCurrencyMap(calcForm, currency) {
    const countryCurrencyMap = {};
    calcForm.querySelectorAll('.js-price-card').forEach((card) => {
      const countryCode = card.getAttribute('data-country-code');
      if (countryCode) {
        countryCurrencyMap[countryCode] = { description: currency };
      }
    });
    return countryCurrencyMap;
  }

  // Генерація ключа для кешу
  function generateCacheKey(classesCount, currency) {
    return `${classesCount}-${currency}`;
  }

  // Перевірка чи нові дані відрізняються від кешованих
  function isDataDifferent(newData, cacheKey) {
    const cachedData = priceCache[cacheKey];
    return (
      !cachedData || JSON.stringify(newData) !== JSON.stringify(cachedData)
    );
  }

  // Оновлення карток з новими даними
  function updatePriceCards(calcForm, data) {
    hideErrorText(calcForm);

    calcForm.querySelectorAll('.js-price-card').forEach((card) => {
      const countryCode = card.getAttribute('data-country-code');
      const countryType = card.getAttribute('data-country-type');
      const countryData = data[countryCode.toUpperCase()];

      if (!countryData) return;
      let totalFee = 0;

      if (countryType === 'registration') {
        const applicationCost = countryData.application_cost || {};
        const registrationCost = countryData.registration_cost || {};

        totalFee =
          (applicationCost.total_fee || 0) + (registrationCost.total_fee || 0);

        updateCardCost(
          card,
          'application-cost',
          applicationCost,
          countryData.currency.description
        );

        if (Object.keys(registrationCost).length > 0) {
          updateCardCost(
            card,
            'registration-cost',
            registrationCost,
            countryData.currency.description
          );
        }
      }

      if (countryType === 'renewal') {
        const renewalCost = countryData.renewal_cost || {};
        totalFee = renewalCost.total_fee || 0;
        updateCardCost(
          card,
          'renewal-cost',
          renewalCost,
          countryData.currency.description
        );
      }

      card.querySelectorAll('[data-price-total]').forEach((el) => {
        el.textContent = `${totalFee} ${countryData.currency.description}`;
      });
    });
  }

  // Оновлення даних у картках
  function updateCardCost(card, costType, costData, currency) {
    card.querySelector(
      `[data-${costType}] [data-fee] [data-price-value] span`
    ).textContent = `${costData.fee || 0} ${currency}`;
    card.querySelector(
      `[data-${costType}] [data-service-fee] [data-price-value] span`
    ).textContent = `${costData.service_fee || 0} ${currency}`;
    card.querySelector(
      `[data-${costType}] [data-price-summ] span`
    ).textContent = `${costData.total_fee || 0} ${currency}`;
  }

  function unfade(element) {
    let op = 0;
    const interval = 0.05;
    element.style.opacity = op;
    element.style.display = 'block';
    let timer = setInterval(function () {
      if (op >= 1) {
        clearInterval(timer);
      }
      element.style.opacity = op;
      op += interval;
    }, 10);
  }

  function toggleLoadingState(form) {
    const priceCards = form.querySelector('.js-price-cards');
    priceCards.classList.toggle('is-loading');
  }

  function displayErrorText(form) {
    const errorText = form.querySelector('.js-calc-form-error');
    errorText.classList.remove('d-none');
  }

  function hideErrorText(form) {
    const errorText = form.querySelector('.js-calc-form-error');
    errorText.classList.add('d-none');
  }
});
