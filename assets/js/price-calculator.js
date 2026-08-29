(function () {
    'use strict';

    document.querySelectorAll('.price-calc').forEach(function (calc) {
        var tiers = JSON.parse(calc.getAttribute('data-tiers') || '[]');
        var currency = calc.getAttribute('data-currency') || '€';
        var input = calc.querySelector('.price-calc-people');
        var minusBtn = calc.querySelector('.price-calc-minus');
        var plusBtn = calc.querySelector('.price-calc-plus');
        var perPersonOut = calc.querySelector('.price-calc-per-person');
        var totalOut = calc.querySelector('.price-calc-total');
        var waLink = calc.querySelector('.price-calc-whatsapp');
        var waTemplate = calc.getAttribute('data-wa-template') || '';

        if (!tiers.length || !input) return;

        function priceFor(people) {
            var tier = tiers[tiers.length - 1];
            for (var i = 0; i < tiers.length; i++) {
                if (people <= tiers[i].upTo) {
                    tier = tiers[i];
                    break;
                }
            }
            return tier.pp;
        }

        function render() {
            var people = Math.max(1, Math.min(20, parseInt(input.value, 10) || 1));
            input.value = people;
            var pp = priceFor(people);
            var total = pp * people;

            if (perPersonOut) perPersonOut.textContent = currency + pp.toLocaleString();
            if (totalOut) totalOut.textContent = currency + total.toLocaleString();

            if (waLink) {
                var text = waTemplate
                    .replace('{people}', String(people))
                    .replace('{pp}', currency + pp.toLocaleString())
                    .replace('{total}', currency + total.toLocaleString());
                waLink.href = 'https://wa.me/255697612865?text=' + encodeURIComponent(text);
            }
        }

        if (minusBtn) minusBtn.addEventListener('click', function () {
            input.value = Math.max(1, (parseInt(input.value, 10) || 1) - 1);
            render();
        });
        if (plusBtn) plusBtn.addEventListener('click', function () {
            input.value = Math.min(20, (parseInt(input.value, 10) || 1) + 1);
            render();
        });
        input.addEventListener('input', render);
        input.addEventListener('change', render);

        render();
    });
})();
