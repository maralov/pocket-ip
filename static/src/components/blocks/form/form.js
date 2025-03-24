document.addEventListener('DOMContentLoaded', function () {
  const searchParameterButton = document.querySelector('.search-parameter');
  const searchOptions = document.querySelectorAll('.search-option');
  const searchValue = document.getElementById('search-value');
  const searchLink = document.getElementById('search-link');
  const searchDropdown = document.querySelector(
    '.select-dropdown.js-select-search'
  );

  // Отримуємо код країни для поточної сторінки з PHP
  const countryCode = siteData.countryCode.toUpperCase();

  // Функція для відкриття/закриття дропдауну
  searchParameterButton.addEventListener('click', function () {
    const isOpen = searchDropdown.style.display === 'block';
    searchDropdown.style.display = isOpen ? 'none' : 'block';
    searchParameterButton.setAttribute('aria-expanded', String(!isOpen));
  });

  // Функція для оновлення посилання
  function updateSearchLink() {
    const selectedOption = document.querySelector('.search-option.selected');
    const type = selectedOption
      ? selectedOption.getAttribute('data-search-param')
      : 'name';
    const value = encodeURIComponent(searchValue.value.trim());

    // Формуємо URL для пошуку
    const url = `https://my.pocketip.com/search?country=${countryCode}&type=${type}&value=${value}`;

    // Оновлюємо посилання
    searchLink.href = url;
  }

  // Вибір опції в дропдауні
  searchOptions.forEach((option) => {
    option.addEventListener('click', function () {
      // Змінюємо текст кнопки на вибране значення
      searchParameterButton.querySelector(
        '.selected-values__text'
      ).textContent = this.textContent;

      // Знімаємо вибір з інших елементів та позначаємо вибране
      searchOptions.forEach((opt) => opt.classList.remove('selected'));
      this.classList.add('selected');

      // Закриваємо дропдаун після вибору
      searchDropdown.style.display = 'none';
      searchParameterButton.setAttribute('aria-expanded', 'false');

      // Оновлюємо посилання
      updateSearchLink();
    });
  });

  // Оновлюємо посилання при зміні значення поля введення
  searchValue.addEventListener('input', updateSearchLink);
  updateSearchLink();
});
