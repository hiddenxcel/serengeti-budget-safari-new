(function () {
    'use strict';

    var form = document.getElementById('contactForm');
    if (!form) return;

    var errorBox = document.getElementById('contactFormError');
    var success = document.getElementById('contactSuccess');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var name = form.name.value.trim();
        var email = form.email.value.trim();
        var message = form.message.value.trim();

        if (!name || !email || !message) {
            errorBox.classList.add('visible');
            return;
        }
        errorBox.classList.remove('visible');

        var phone = form.phone.value.trim();
        var country = form.country.value.trim();
        var interest = form.interest.value;
        var travelers = form.travelers.value;
        var dates = form.dates.value.trim();

        var lines = [
            'Hello! New enquiry from the website:',
            '',
            'Name: ' + name,
            'Email: ' + email
        ];
        if (phone) lines.push('Phone: ' + phone);
        if (country) lines.push('Country: ' + country);
        lines.push('Interested in: ' + interest);
        lines.push('Travellers: ' + travelers);
        if (dates) lines.push('Travel dates: ' + dates);
        lines.push('');
        lines.push('Message: ' + message);

        var text = lines.join('\n');
        var waUrl = 'https://wa.me/255697612865?text=' + encodeURIComponent(text);

        form.style.display = 'none';
        success.classList.add('visible');
        var waLink = success.querySelector('a.btn-success');
        if (waLink) waLink.href = waUrl;

        window.open(waUrl, '_blank', 'noopener');
    });
})();
