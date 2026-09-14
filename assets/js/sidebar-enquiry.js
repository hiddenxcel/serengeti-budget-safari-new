(function () {
    'use strict';

    document.querySelectorAll('.sidebar-enquiry-form').forEach(function (form) {
        var errorBox = form.querySelector('.sidebar-enquiry-error');
        var success = form.nextElementSibling && form.nextElementSibling.classList.contains('sidebar-enquiry-success')
            ? form.nextElementSibling
            : null;
        var tourName = form.getAttribute('data-tour-name') || '';

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var name = form.name.value.trim();
            var email = form.email.value.trim();

            if (!name || !email) {
                if (errorBox) errorBox.classList.add('visible');
                return;
            }
            if (errorBox) errorBox.classList.remove('visible');

            var phone = form.phone.value.trim();
            var country = form.country.value.trim();
            var adults = form.adults ? form.adults.value : '';
            var children = form.children ? form.children.value : '';
            var dates = form.dates.value.trim();
            var message = form.message.value.trim();

            var lines = ['Hi! New enquiry from the website:', ''];
            if (tourName) lines.push('Tour: ' + tourName);
            lines.push('Name: ' + name);
            lines.push('Email: ' + email);
            if (phone) lines.push('Phone: ' + phone);
            if (country) lines.push('Country: ' + country);
            if (adults) lines.push('Adults: ' + adults);
            if (children) lines.push('Children: ' + children);
            if (dates) lines.push('Travel dates: ' + dates);
            if (message) {
                lines.push('');
                lines.push('Message: ' + message);
            }

            var text = lines.join('\n');
            var waUrl = 'https://wa.me/255697612865?text=' + encodeURIComponent(text);

            if (success) {
                form.style.display = 'none';
                success.classList.add('visible');
                var waLink = success.querySelector('a.btn-success');
                if (waLink) waLink.href = waUrl;
            }

            window.open(waUrl, '_blank', 'noopener');
        });
    });
})();
