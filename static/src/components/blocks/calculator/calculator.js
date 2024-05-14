document.addEventListener("DOMContentLoaded", function () {

    document.addEventListener("click", function (e) {
        const dropdowns = document.querySelectorAll(".select-dropdown");
        dropdowns.forEach(dropdown => {
            if (!dropdown.contains(e.target) && !dropdown.previousElementSibling.contains(e.target)) {
                dropdown.style.display = "none";
                dropdown.previousElementSibling.setAttribute("aria-expanded", "false");
            }
        });
    });

    const calcForms = document.querySelectorAll(".js-calc-form");

    calcForms.forEach(calcForm => {

        calcForm.addEventListener("click", function (e) {
            const selectedValue = e.target.matches(".selected-values") || e.target.closest(".selected-values");
            if (selectedValue) {
                toggleDropdown(e.target.closest(".custom-select"));
            }

            handleCounter(e, calcForm);
        });

        calcForm.addEventListener("change", function (e) {
            handleCheckboxChange(e, calcForm);
        });

        calcForm.addEventListener("input", function (e) {
            if (e.target.classList.contains("js-counter-value")) {
                updatePrices(calcForm);
            }
        });

        calcForm.addEventListener("blur", function (e) {
            if (e.target.classList.contains("js-counter-value")) {
                validateAndCorrectInput(e.target, calcForm);
            }
        }, true);
    });

    function toggleDropdown(customSelect) {
        const dropdown = customSelect.querySelector(".select-dropdown");
        const isOpen = dropdown.style.display === "block";
        dropdown.style.display = isOpen ? "none" : "block";
        customSelect.querySelector(".selected-values").setAttribute("aria-expanded", String(!isOpen));
    }

    function handleCounter(e, calcForm) {
        const incrementButton = e.target.closest(".js-counter-increment");
        const decrementButton = e.target.closest(".js-counter-decrement");

        if (incrementButton || decrementButton) {
            const inputField = calcForm.querySelector(".js-counter-value");
            const currentValue = parseInt(inputField.value);

            if (incrementButton) {
                inputField.value = currentValue + 1;
            } else if (decrementButton && currentValue > 1) {
                inputField.value = currentValue - 1;
            }

            calcForm.querySelector(".js-counter-decrement").disabled = parseInt(inputField.value) <= 1;

            updatePrices(calcForm);
        }
    }

    function validateAndCorrectInput(inputField, calcForm) {
        let value = parseInt(inputField.value);
        if (value < 1 || isNaN(value)) {
            inputField.value = 1;
        }
        calcForm.querySelector(".js-counter-decrement").disabled = inputField.value <= 1;
        updatePrices(calcForm);
    }

    function handleCheckboxChange(e, calcForm) {
        if (e.target.type === "checkbox") {
            const countryCode = e.target.value.toLowerCase();
            const priceCards = calcForm.querySelectorAll(`.js-price-card[data-country-code="${countryCode}"]`);
            priceCards.forEach(card => {
                card.style.display = e.target.checked ? "block" : "none";
                if (e.target.checked) unfade(card);
            });
            updateSelectedValues(calcForm);
        }
    }

    function updateSelectedValues(calcForm) {
        const checkboxes = calcForm.querySelectorAll(".select-dropdown input[type=\"checkbox\"]");
        const selectedValues = Array.from(checkboxes).filter(cb => cb.checked).map(cb => cb.parentNode.textContent.trim());
        calcForm.querySelector(".selected-values__text").textContent = selectedValues.length > 0 ? selectedValues.join(", ") : "Choose country...";
    }

    function updatePrices(calcForm) {
        const priceCards = calcForm.querySelectorAll(".js-price-card");
        priceCards.forEach(card => {
            let cardTotal = 0;
            const rows = card.querySelectorAll(".price-card__row");
            rows.forEach(row => {
                let rowTotal = 0;
                const priceElements = row.querySelectorAll("[data-price]");
                priceElements.forEach(el => {
                    const basePrice = parseInt(el.getAttribute("data-price"));
                    const additionalPrice = parseInt(el.getAttribute("data-add-price"));
                    const classesCount = Math.max(0, parseInt(calcForm.querySelector(".js-counter-value").value) - 1);
                    const newPrice = basePrice + (additionalPrice * classesCount);
                    el.querySelector("[data-price-value] span").textContent = `${newPrice}`;
                    rowTotal += newPrice;
                });
                row.querySelector("[data-price-summ] span").textContent = `${rowTotal}`;
                cardTotal += rowTotal;
            });
            card.querySelector("[data-price-total] span").textContent = `${cardTotal}`;
        });
    }



    function unfade(element) {
        let op = 0;
        const interval = 0.05;
        element.style.opacity = op;
        element.style.display = "block";
        let timer = setInterval(function () {
            if (op >= 1) {
                clearInterval(timer);
            }
            element.style.opacity = op;
            op += interval;
        }, 10);
    }
});
