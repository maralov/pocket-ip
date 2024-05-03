document.addEventListener('DOMContentLoaded', function () {
    var tabs = document.querySelectorAll('.tab-list a');

    function changeTab(event) {
        event.preventDefault();
        var selectedTab = event.target;
        var tabListItems = document.querySelectorAll('.tab-list li');
        var tabPanels = document.querySelectorAll('.tab-content');

        tabListItems.forEach(function (li) {
            li.classList.remove('active');
            var tab = li.querySelector('[role="tab"]');
            tab.setAttribute('tabindex', '-1');
            tab.setAttribute('aria-selected', 'false');
        });

        var selectedListItem = selectedTab.parentElement;
        selectedListItem.classList.add('active');
        selectedTab.setAttribute('tabindex', '0');
        selectedTab.setAttribute('aria-selected', 'true');

        tabPanels.forEach(function (panel) {
            if (panel.getAttribute('aria-labelledby') === selectedTab.getAttribute('aria-controls')) {
                panel.setAttribute('aria-hidden', 'false');
                panel.style.display = 'block';
            } else {
                panel.setAttribute('aria-hidden', 'true');
                panel.style.display = 'none';
            }
        });
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', changeTab);
        tab.addEventListener('keydown', function (e) {
            var key = e.which;
            if (key === 37 || key === 38
        )
            { // ліво або верх
                if (tab.parentElement.previousElementSibling) {
                    tab.parentElement.previousElementSibling.querySelector('[role="tab"]').focus().click();
                }
            }
        else
            if (key === 39|| key === 40
        )
            { // вправо або вниз
                if (tab.parentElement.nextElementSibling) {
                    tab.parentElement.nextElementSibling.querySelector('[role="tab"]').focus().click();
                }
            }
        });
    });
});
