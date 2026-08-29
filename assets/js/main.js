(function () {
    'use strict';

    // ===== FAQ ACCORDION (.faq-item-acc, used across safari/park/day-trip/blog pages) =====
    document.querySelectorAll('.faq-question-acc').forEach(function (question) {
        question.addEventListener('click', function () {
            var item = question.closest('.faq-item-acc');
            if (item) item.classList.toggle('active');
        });
    });

    // ===== SAVE SAFARI (localStorage, per-browser) =====
    var SAVED_KEY = 'savedSafaris';

    function getSaved() {
        try {
            var raw = localStorage.getItem(SAVED_KEY);
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            return [];
        }
    }

    function setSaved(list) {
        try {
            localStorage.setItem(SAVED_KEY, JSON.stringify(list));
        } catch (e) { /* storage unavailable — fail silently */ }
    }

    function isSaved(id) {
        return getSaved().some(function (s) { return s.id === id; });
    }

    function toggleSaved(data) {
        var list = getSaved();
        var idx = list.findIndex(function (s) { return s.id === data.id; });
        if (idx === -1) {
            list.push(data);
        } else {
            list.splice(idx, 1);
        }
        setSaved(list);
        return idx === -1;
    }

    function updateSavedPill() {
        var pill = document.getElementById('savedSafarisPill');
        if (!pill) return;
        var count = getSaved().length;
        var countEl = pill.querySelector('.saved-safaris-count');
        if (countEl) countEl.textContent = count;
        pill.classList.toggle('visible', count > 0);
    }

    document.querySelectorAll('.save-safari-btn').forEach(function (btn) {
        var id = btn.getAttribute('data-safari-id');
        if (!id) return;

        function refresh() {
            var saved = isSaved(id);
            btn.classList.toggle('saved', saved);
            var label = btn.querySelector('.save-safari-label');
            var icon = btn.querySelector('i');
            if (label) label.textContent = saved ? btn.getAttribute('data-saved-label') : btn.getAttribute('data-add-label');
            if (icon) icon.className = saved ? 'fas fa-heart' : 'far fa-heart';
        }

        btn.setAttribute('data-add-label', btn.querySelector('.save-safari-label') ? btn.querySelector('.save-safari-label').textContent : 'Save Safari');
        btn.setAttribute('data-saved-label', btn.getAttribute('data-saved-text') || 'Saved');

        refresh();

        btn.addEventListener('click', function () {
            toggleSaved({
                id: id,
                title: btn.getAttribute('data-safari-title') || '',
                price: btn.getAttribute('data-safari-price') || '',
                url: btn.getAttribute('data-safari-url') || '#',
                image: btn.getAttribute('data-safari-image') || ''
            });
            refresh();
            updateSavedPill();
        });
    });

    updateSavedPill();

    // ===== HAMBURGER =====
    const hamburger = document.getElementById('hamburger');
    const mainNav = document.getElementById('mainNav');
    if (hamburger && mainNav) {
        hamburger.addEventListener('click', function () {
            const expanded = this.getAttribute('aria-expanded') === 'true' ? false : true;
            this.setAttribute('aria-expanded', expanded);
            this.classList.toggle('open');
            mainNav.classList.toggle('open');
        });
        mainNav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('open');
                hamburger.setAttribute('aria-expanded', 'false');
                mainNav.classList.remove('open');
            });
        });
    }

    // ===== MEGA MENU (click-toggle on touch/mobile, hover handles desktop via CSS) =====
    document.querySelectorAll('.has-mega').forEach(function (item) {
        const trigger = item.querySelector('.mega-trigger');
        if (!trigger) return;

        trigger.addEventListener('click', function (e) {
            e.stopPropagation();
            const isOpen = item.classList.contains('open');

            document.querySelectorAll('.has-mega.open').forEach(function (other) {
                if (other !== item) {
                    other.classList.remove('open');
                    const otherTrigger = other.querySelector('.mega-trigger');
                    if (otherTrigger) otherTrigger.setAttribute('aria-expanded', 'false');
                }
            });

            item.classList.toggle('open', !isOpen);
            trigger.setAttribute('aria-expanded', String(!isOpen));
        });
    });

    document.addEventListener('click', function (e) {
        if (!e.target.closest('.has-mega')) {
            document.querySelectorAll('.has-mega.open').forEach(function (item) {
                item.classList.remove('open');
                const trigger = item.querySelector('.mega-trigger');
                if (trigger) trigger.setAttribute('aria-expanded', 'false');
            });
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('.has-mega.open').forEach(function (item) {
                item.classList.remove('open');
                const trigger = item.querySelector('.mega-trigger');
                if (trigger) trigger.setAttribute('aria-expanded', 'false');
            });
        }
    });

    // ===== HEADER SCROLL =====
    const header = document.querySelector('.site-header');
    window.addEventListener('scroll', function () {
        if (window.scrollY > 50) header.classList.add('scrolled');
        else header.classList.remove('scrolled');
    });



    // ============================================================
    // LEOPARD VIDEO – AUTOPLAY ON SCROLL + LOOP + PLAY/PAUSE
    // ============================================================

    document.addEventListener('DOMContentLoaded', function () {
        const video = document.getElementById('leopardVideo');
        const playBtn = document.getElementById('leopardPlayBtn');

        if (!video || !playBtn) return;

        // ============================================================
        // 1. AUTOPLAY ON SCROLL (Intersection Observer)
        // ============================================================

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Video is visible – play it
                    video.play().catch(() => {
                        // Autoplay blocked by browser – show play button
                        playBtn.classList.remove('hidden');
                    });
                } else {
                    // Video is not visible – pause it
                    video.pause();
                    // Show play button when paused
                    playBtn.classList.remove('hidden');
                    // Reset icon to play
                    const icon = playBtn.querySelector('.play-circle i');
                    if (icon) icon.className = 'fas fa-play';
                }
            });
        }, {
            threshold: 0.3 // 30% of video must be visible
        });

        observer.observe(video.closest('.leopard-video-container'));

        // ============================================================
        // 2. LOOP – video inajirudia automatically
        // ============================================================

        video.loop = true; // Already set in HTML with 'loop' attribute

        // ============================================================
        // 3. PLAY/PAUSE on button click
        // ============================================================

        playBtn.addEventListener('click', function (e) {
            e.stopPropagation();

            if (video.paused) {
                video.play();
                // Hide overlay when playing
                this.classList.add('hidden');
            } else {
                video.pause();
                this.classList.remove('hidden');
            }
        });

        // ============================================================
        // 4. UPDATE ICON on play/pause
        // ============================================================

        video.addEventListener('play', function () {
            const icon = playBtn.querySelector('.play-circle i');
            if (icon) icon.className = 'fas fa-pause';
            playBtn.classList.add('hidden');
        });

        video.addEventListener('pause', function () {
            const icon = playBtn.querySelector('.play-circle i');
            if (icon) icon.className = 'fas fa-play';
            playBtn.classList.remove('hidden');
        });

        // ============================================================
        // 5. SHOW PLAY BUTTON when video ends (though loop handles this)
        // ============================================================

        video.addEventListener('ended', function () {
            // With loop, this will only fire if loop is removed
            playBtn.classList.remove('hidden');
            const icon = playBtn.querySelector('.play-circle i');
            if (icon) icon.className = 'fas fa-play';
        });

        // ============================================================
        // 6. ERROR HANDLING – show thumbnail
        // ============================================================

        video.addEventListener('error', function () {
            playBtn.classList.remove('hidden');
            const icon = playBtn.querySelector('.play-circle i');
            if (icon) icon.className = 'fas fa-play';
            console.warn('Video failed to load. Showing thumbnail.');
        });

        // ============================================================
        // 7. START PLAYING if already visible on load
        // ============================================================

        // Check if video is already visible when page loads
        setTimeout(() => {
            const rect = video.closest('.leopard-video-container').getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
            if (isVisible) {
                video.play().catch(() => {
                    // Autoplay blocked
                    playBtn.classList.remove('hidden');
                });
            }
        }, 500);
    });
    // ===== TESTIMONIAL VIDEO =====
    document.querySelectorAll('.testimonial-video').forEach(container => {
        const video = container.querySelector('video');
        const playIcon = container.querySelector('.play-icon');
        if (video && playIcon) {
            playIcon.addEventListener('click', function (e) {
                e.stopPropagation();
                if (video.paused) {
                    video.play();
                    this.style.display = 'none';
                } else {
                    video.pause();
                    this.style.display = 'flex';
                }
            });
            video.addEventListener('ended', () => { playIcon.style.display = 'flex'; });
            video.addEventListener('pause', () => { playIcon.style.display = 'flex'; });
            video.addEventListener('play', () => { playIcon.style.display = 'none'; });
        }
    });

    // ===== FAQ =====
    document.querySelectorAll('.faq-question').forEach(q => {
        q.addEventListener('click', function () {
            const item = this.parentElement;
            const isActive = item.classList.contains('active');
            document.querySelectorAll('.faq-item').forEach(other => {
                if (other !== item) other.classList.remove('active');
            });
            if (!isActive) item.classList.add('active');
        });
    });

    // ===== LANG SWITCHER =====
    const langToggle = document.getElementById('langToggle');
    const langDropdown = document.getElementById('langDropdown');
    if (langToggle && langDropdown) {
        langToggle.addEventListener('click', function (e) {
            e.stopPropagation();
            this.classList.toggle('open');
            langDropdown.classList.toggle('open');
        });
        document.addEventListener('click', function (e) {
            if (!langToggle.contains(e.target) && !langDropdown.contains(e.target)) {
                langToggle.classList.remove('open');
                langDropdown.classList.remove('open');
            }
        });
    }

    // ===== SAFARI PLANNER (CHAT RECOMMENDATION ENGINE) =====
    const plannerChat = document.getElementById('plannerChat');
    const plannerForm = document.getElementById('plannerForm');
    const plannerResult = document.getElementById('plannerResult');
    const plannerThread = document.getElementById('plannerThread');

    if (plannerChat && plannerForm && plannerThread) {
        const steps = Array.from(plannerForm.querySelectorAll('.planner-step'));
        const dots = Array.from(plannerChat.querySelectorAll('.planner-progress-dot'));
        const isEN = document.documentElement.getAttribute('lang') === 'en';
        let selections = {};
        let currentStep = 0;

        function updateDots() {
            dots.forEach((dot, i) => {
                dot.classList.toggle('done', i < currentStep);
                dot.classList.toggle('current', i === currentStep);
            });
        }

        function scrollThreadToBottom() {
            plannerThread.scrollTop = plannerThread.scrollHeight;
        }

        function addBotMessage(text) {
            const msg = document.createElement('div');
            msg.className = 'planner-msg planner-msg-bot';
            msg.innerHTML = `<span class="planner-msg-avatar"><img src="/images/logo.svg" alt="" width="20" height="20" /></span>
                <div class="planner-msg-bubble">${text}</div>`;
            plannerThread.appendChild(msg);
            scrollThreadToBottom();
        }

        function addTypingThenMessage(text, callback) {
            const typing = document.createElement('div');
            typing.className = 'planner-msg planner-msg-bot planner-typing';
            typing.innerHTML = `<span class="planner-msg-avatar"><img src="/images/logo.svg" alt="" width="20" height="20" /></span>
                <div class="planner-msg-bubble">
                    <span class="planner-typing-dot"></span><span class="planner-typing-dot"></span><span class="planner-typing-dot"></span>
                </div>`;
            plannerThread.appendChild(typing);
            scrollThreadToBottom();
            setTimeout(() => {
                typing.remove();
                addBotMessage(text);
                if (callback) callback();
            }, 500);
        }

        function addUserMessage(text) {
            const msg = document.createElement('div');
            msg.className = 'planner-msg planner-msg-user';
            msg.innerHTML = `<span class="planner-msg-avatar"><i class="fas fa-user"></i></span>
                <div class="planner-msg-bubble">${text}</div>`;
            plannerThread.appendChild(msg);
            scrollThreadToBottom();
        }

        function goToStep(index) {
            steps.forEach(step => step.classList.remove('active'));
            currentStep = index;
            updateDots();
            if (index >= steps.length) return;
            const nextStep = steps[index];
            nextStep.classList.add('active');
            const question = nextStep.querySelector('.planner-options').getAttribute('data-question');
            addTypingThenMessage(question);
        }

        steps.forEach(step => {
            const optionsWrap = step.querySelector('.planner-options');
            const buttons = optionsWrap.querySelectorAll('button');
            buttons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const name = optionsWrap.getAttribute('data-name');
                    buttons.forEach(b => b.classList.remove('selected'));
                    this.classList.add('selected');
                    selections[name] = this.getAttribute('data-value');

                    addUserMessage(this.textContent.trim());

                    const stepIndex = steps.indexOf(step);
                    if (stepIndex + 1 < steps.length) {
                        setTimeout(() => goToStep(stepIndex + 1), 250);
                    } else {
                        setTimeout(() => {
                            currentStep = steps.length;
                            updateDots();
                            addTypingThenMessage(
                                isEN
                                    ? "Perfect, thank you! Here's what I recommend for you ✨"
                                    : 'Perfetto, grazie! Ecco cosa ti consiglio ✨',
                                showResult
                            );
                        }, 250);
                    }
                });
            });
        });

        updateDots();

        function showResult() {
            const days = selections.days || '4';
            const budget = selections.budget || 'standard';
            const month = selections.month || 'jul-sep';
            const interest = selections.interest || 'wildlife';

            // --- Recommendation Logic ---
            let itinerary = '';
            let price = '';
            let duration = '';
            let highlights = '';

            if (interest === 'wildlife') {
                if (days === '2' || days === '4') {
                    itinerary = isEN ? 'Express Safari – Tarangire & Ngorongoro Crater' : 'Safari Espresso – Tarangire & Ngorongoro Crater';
                    duration = isEN ? '3 days / 2 nights' : '3 giorni / 2 notti';
                    highlights = isEN ? '🦁 Big Five, elephants in Tarangire, picnic in the crater' : '🦁 Big Five, elefanti a Tarangire, picnic nel cratere';
                    if (budget === 'economico') price = '€650';
                    else if (budget === 'standard') price = '€850';
                    else price = '€1,200';
                } else {
                    itinerary = isEN ? 'Classic Safari – Serengeti, Ngorongoro & Tarangire' : 'Safari Classico – Serengeti, Ngorongoro & Tarangire';
                    duration = isEN ? '5 days / 4 nights' : '5 giorni / 4 notti';
                    highlights = isEN ? '🦁 Big Five, migration (seasonal), breathtaking sunsets' : '🦁 Big Five, migrazione (stagionale), tramonti mozzafiato';
                    if (budget === 'economico') price = '€1,150';
                    else if (budget === 'standard') price = '€1,450';
                    else price = '€2,100';
                }
            } else if (interest === 'migration') {
                itinerary = isEN ? 'The Great Migration – Northern Serengeti & Mara River' : 'La Grande Migrazione – Serengeti Nord & Mara River';
                duration = isEN ? '6 days / 5 nights' : '6 giorni / 5 notti';
                highlights = isEN ? '🦒 Mara River crossing, crocodiles, migrating wildebeest' : '🦒 Attraversamento del fiume Mara, coccodrilli, gnu in migrazione';
                if (budget === 'economico') price = '€1,450';
                else if (budget === 'standard') price = '€1,850';
                else price = '€2,600';
            } else if (interest === 'trekking') {
                itinerary = isEN ? 'Kilimanjaro Trekking – Machame Route (the most scenic)' : 'Trekking Kilimanjaro – Route Machame (la via più panoramica)';
                duration = isEN ? '7 days / 6 nights' : '7 giorni / 6 notti';
                highlights = isEN ? '🏔️ 5,895m summit, breathtaking scenery, expert guide support' : '🏔️ Vetta 5.895m, paesaggi mozzafiato, supporto guide esperte';
                if (budget === 'economico') price = '€1,600';
                else if (budget === 'standard') price = '€2,100';
                else price = '€3,200';
            } else if (interest === 'beach') {
                itinerary = isEN ? 'Safari & Zanzibar – Adventure and relaxation on the Indian Ocean' : 'Safari & Zanzibar – Avventura e relax sull’oceano Indiano';
                duration = isEN ? '8 days / 7 nights (5 safari + 3 Zanzibar)' : '8 giorni / 7 notti (5 safari + 3 Zanzibar)';
                highlights = isEN ? '🏝️ White sand in Zanzibar, snorkeling, safari in the parks' : '🏝️ Sabbia bianca a Zanzibar, snorkeling, safari nei parchi';
                if (budget === 'economico') price = '€1,800';
                else if (budget === 'standard') price = '€2,200';
                else price = '€3,500';
            }

            // Month suggestion
            let monthAdvice = '';
            if (month === 'jan-mar') monthAdvice = isEN ? 'Perfect for newborn calves and the southern migration.' : 'Perfetto per i cuccioli e la migrazione nel sud.';
            else if (month === 'apr-jun') monthAdvice = isEN ? 'Rains create lush green landscapes, ideal for photography.' : 'Le piogge creano paesaggi verdi, ideale per fotografie.';
            else if (month === 'jul-sep') monthAdvice = isEN ? 'The best time! The migration is at its peak.' : 'Il periodo migliore! La migrazione è al suo apice.';
            else if (month === 'oct-dec') monthAdvice = isEN ? 'Rains begin, parks are less crowded.' : 'Le piogge iniziano, i parchi sono meno affollati.';

            const t = isEN ? {
                title: '✨ Your Recommended Safari',
                duration: 'Duration:',
                priceLabel: 'Estimated price:',
                perPerson: 'per person',
                highlights: 'Highlights:',
                includes: 'Includes: English-speaking guide, 4x4, meals, accommodation, park fees. <strong>No hidden costs.</strong>',
                whatsapp: 'Ask on WhatsApp',
                email: 'Ask via Email',
                disclaimer: '🔄 This is an estimate based on your preferences. The final price may vary depending on availability and high season.',
                waText: `Hi! I'm interested in this safari: ${itinerary}. Price: ${price}. Duration: ${duration}. Period: ${month}.`,
                mailSubject: 'Safari%20Planner%20quote%20request',
                mailBody: `Hi!%20I'm%20interested%20in%20this%20safari:%20${encodeURIComponent(itinerary)}.%20Price:%20${price}.%20Duration:%20${duration}.%20Period:%20${month}.%20Looking%20forward%20to%20hearing%20from%20you.`
            } : {
                title: '✨ Safari Consigliato per Te',
                duration: 'Durata:',
                priceLabel: 'Prezzo stimato:',
                perPerson: 'a persona',
                highlights: 'Highlights:',
                includes: 'Include: guida italiana, 4x4, pasti, alloggi, tasse del parco. <strong>Nessun costo nascosto.</strong>',
                whatsapp: 'Richiedi su WhatsApp',
                email: 'Richiedi via Email',
                disclaimer: '🔄 Questa è una stima basata sulle tue preferenze. Il prezzo finale può variare in base a disponibilità e alta stagione.',
                waText: `Ciao! Sono interessato al seguente safari: ${itinerary}. Prezzo: ${price}. Durata: ${duration}. Periodo: ${month}.`,
                mailSubject: 'Richiesta%20preventivo%20Safari%20Planner',
                mailBody: `Ciao!%20Sono%20interessato%20al%20seguente%20safari:%20${encodeURIComponent(itinerary)}.%20Prezzo:%20${price}.%20Durata:%20${duration}.%20Periodo:%20${month}.%20Attendo%20vostre%20news.`
            };

            // Display result
            plannerResult.classList.add('show');
            plannerResult.innerHTML = `
                                <div class="planner-result-content">
                                    <h3>${t.title}</h3>
                                    <h4 style="color:#fff;font-size:1.3rem;margin-bottom:0.5rem;">${itinerary}</h4>
                                    <div class="rec-details">
                                        <span><strong>📅 ${t.duration}</strong> ${duration}</span>
                                        <span><strong>💰 ${t.priceLabel}</strong> <span class="rec-price" style="font-size:1.6rem;display:inline;">${price}</span> ${t.perPerson}</span>
                                        <span style="grid-column: span 2;"><strong>🌟 ${t.highlights}</strong> ${highlights}</span>
                                        <span style="grid-column: span 2;color:var(--gold);font-size:0.9rem;">📌 ${monthAdvice}</span>
                                    </div>
                                    <p style="font-size:0.9rem;opacity:0.8;border-top:1px solid rgba(255,255,255,0.1);padding-top:1rem;margin-top:0.5rem;">
                                        <i class="fas fa-check-circle" style="color:var(--gold);"></i> ${t.includes}
                                    </p>
                                    <div class="btn-group" style="margin-top:1.5rem;">
                                        <a href="https://wa.me/255697612865?text=${encodeURIComponent(t.waText)}" class="btn btn-success" target="_blank"><i class="fab fa-whatsapp"></i> ${t.whatsapp}</a>
                                        <a href="mailto:serengetibudgetsafari@gmail.com?subject=${t.mailSubject}&body=${t.mailBody}" class="btn btn-secondary"><i class="fas fa-envelope"></i> ${t.email}</a>
                                    </div>
                                    <p style="font-size:0.7rem;opacity:0.5;margin-top:0.8rem;">${t.disclaimer}</p>
                                </div>
                            `;
            plannerResult.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // ===== 3D TILT =====
    document.querySelectorAll('.safari-3d-card').forEach(card => {
        card.addEventListener('mousemove', function (e) {
            const rect = this.getBoundingClientRect();
            const x = (e.clientX - rect.left) / rect.width - 0.5;
            const y = (e.clientY - rect.top) / rect.height - 0.5;
            this.style.transform =
                `perspective(1000px) rotateY(${x * 12}deg) rotateX(${-y * 12}deg) translateY(-6px)`;
        });
        card.addEventListener('mouseleave', function () {
            this.style.transform = 'perspective(1000px) rotateY(0) rotateX(0) translateY(0)';
        });
    });

    // ===== SCROLL ANIMATIONS =====
    // Must list every selector that home.css hides, or those elements stay
    // at opacity 0 forever.
    const REVEAL = '.story-chapter, .safari-3d-card, .signature-item, ' +
        '.guide-hub-card, .testimonial-card, .migration-month, .award-item';

    function revealAll() {
        document.querySelectorAll(REVEAL).forEach(el => el.classList.add('visible'));
    }

    if (!('IntersectionObserver' in window)) {
        revealAll();
    } else {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll(REVEAL).forEach(el => observer.observe(el));

        // Safety net: anything still hidden after load gets shown anyway, so a
        // missed element can never leave a blank section behind.
        window.addEventListener('load', () => setTimeout(revealAll, 1200));
    }

})();







// ============================================================
// YOUTUBE SHORTS – AUTO-STOP PLAYER
// ============================================================

document.addEventListener('DOMContentLoaded', function () {

    const shortItems = document.querySelectorAll('.short-item');
    let currentlyPlaying = null;

    shortItems.forEach(item => {
        item.addEventListener('click', function (e) {
            const videoId = this.dataset.video;

            // If this video is already playing, stop it (toggle off)
            if (this.classList.contains('playing')) {
                stopVideo(this);
                currentlyPlaying = null;
                return;
            }

            // Stop any other video that is currently playing
            if (currentlyPlaying) {
                stopVideo(currentlyPlaying);
            }

            // Play this video
            playVideo(this, videoId);
            currentlyPlaying = this;
        });
    });

    function playVideo(item, videoId) {
        const iframe = item.querySelector('iframe');
        if (!iframe) return;

        // Set the video URL with autoplay and sound (muted=0 for sound on)
        iframe.src = 'https://www.youtube.com/embed/' + videoId +
            '?autoplay=1&rel=0&modestbranding=1&mute=0';

        // Add playing class to show video and hide thumbnail
        item.classList.add('playing');
    }

    function stopVideo(item) {
        const iframe = item.querySelector('iframe');
        if (!iframe) return;

        // Clear the src to stop video
        iframe.src = '';

        // Remove playing class to show thumbnail again
        item.classList.remove('playing');
    }

    // Optional: Handle Escape key to stop all videos
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && currentlyPlaying) {
            stopVideo(currentlyPlaying);
            currentlyPlaying = null;
        }
    });

    // Optional: Stop video when clicking outside any card
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.short-item') && currentlyPlaying) {
            stopVideo(currentlyPlaying);
            currentlyPlaying = null;
        }
    });

});




// ============================================================
// AUTO PLAY/STOP VIDEO ON SCROLL – Intersection Observer
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    const video = document.getElementById('leopardVideo');
    const playBtn = document.getElementById('leopardPlayBtn');

    if (video) {
        // Create Intersection Observer
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                // When video becomes visible
                if (entry.isIntersecting) {
                    // Only play if video is paused and not ended
                    if (video.paused && !video.ended) {
                        video.play().catch(function (error) {
                            // Autoplay might be blocked by browser
                            console.log('Autoplay blocked:', error);
                        });
                    }
                }
                // When video leaves viewport
                else {
                    // Pause if playing
                    if (!video.paused) {
                        video.pause();
                    }
                }
            });
        }, {
            // Trigger when 50% of video is visible
            threshold: 0.5,
            // Add some margin for smoother transition
            rootMargin: '0px 0px -50px 0px'
        });

        // Start observing the video container
        observer.observe(video);

        // Also observe play button container (for better accuracy)
        const container = video.closest('.leopard-video-container');
        if (container) {
            observer.observe(container);
        }

        // ============================================================
        // HANDLE PLAY BUTTON (manual override)
        // ============================================================
        if (playBtn) {
            playBtn.addEventListener('click', function (e) {
                e.stopPropagation();

                if (video.paused) {
                    video.play();
                    // Hide overlay
                    playBtn.style.opacity = '0';
                    playBtn.style.pointerEvents = 'none';
                } else {
                    video.pause();
                    playBtn.style.opacity = '1';
                    playBtn.style.pointerEvents = 'auto';
                }
            });

            // Show overlay when video ends
            video.addEventListener('ended', function () {
                playBtn.style.opacity = '1';
                playBtn.style.pointerEvents = 'auto';
                const icon = playBtn.querySelector('.play-circle i');
                if (icon) icon.className = 'fas fa-play';
            });

            // Update icon on play/pause
            video.addEventListener('play', function () {
                const icon = playBtn.querySelector('.play-circle i');
                if (icon) icon.className = 'fas fa-pause';
                // Don't hide overlay if user clicked play
                // It will be hidden by the scroll observer if video goes out of view
            });

            video.addEventListener('pause', function () {
                const icon = playBtn.querySelector('.play-circle i');
                if (icon) icon.className = 'fas fa-play';
                // Only show overlay if video is not ended and not hidden by observer
                if (!video.ended && video.paused) {
                    playBtn.style.opacity = '1';
                    playBtn.style.pointerEvents = 'auto';
                }
            });
        }

        // ============================================================
        // HANDLE VISIBILITY CHANGE (tab switching)
        // ============================================================
        document.addEventListener('visibilitychange', function () {
            if (document.hidden && !video.paused) {
                video.pause();
            } else if (!document.hidden && video.paused && !video.ended) {
                // Only resume if video is still in viewport
                // We'll let the observer handle this
            }
        });
    }
});





// ============================================================
// BACK TO TOP – Smooth Scroll
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    const jumpBtn = document.getElementById('jumpToTop');

    if (!jumpBtn) {
        console.error('Back to Top button not found!');
        return;
    }

    // Click to scroll to top
    jumpBtn.addEventListener('click', function (e) {
        e.preventDefault();

        // Native smooth scroll
        if ('scrollBehavior' in document.documentElement.style) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else {
            // Fallback for older browsers
            const startY = window.scrollY || window.pageYOffset;
            const duration = 600;
            const startTime = performance.now();

            function easeInOutCubic(t) {
                return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
            }

            function scrollAnimation(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easeProgress = easeInOutCubic(progress);
                const currentY = startY - (startY * easeProgress);
                window.scrollTo(0, currentY);
                if (progress < 1) {
                    requestAnimationFrame(scrollAnimation);
                }
            }
            requestAnimationFrame(scrollAnimation);
        }
    });
});


// ============================================================
// STORIES SLIDER – leopard / kilimanjaro / maasai carousel
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('storiesSlider');
    if (!slider) return;

    const track = document.getElementById('storiesTrack');
    const slides = Array.from(track.children);
    const prevBtn = document.getElementById('storiesPrev');
    const nextBtn = document.getElementById('storiesNext');
    const dots = Array.from(document.querySelectorAll('#storiesDots button'));
    const AUTO_DELAY = 6000;

    let index = 0;
    let autoTimer = null;

    function slideGap() {
        const style = window.getComputedStyle(slides[0]);
        return parseFloat(style.marginRight) || 0;
    }

    function goTo(i) {
        index = (i + slides.length) % slides.length;
        const offset = slides.slice(0, index).reduce(function (sum, slide) {
            return sum + slide.getBoundingClientRect().width + slideGap();
        }, 0);
        track.style.transform = 'translateX(-' + offset + 'px)';

        dots.forEach(function (dot, d) {
            const active = d === index;
            dot.classList.toggle('active', active);
            dot.setAttribute('aria-selected', active ? 'true' : 'false');
        });
    }

    function next() { goTo(index + 1); }
    function prev() { goTo(index - 1); }

    function startAuto() {
        stopAuto();
        autoTimer = setInterval(next, AUTO_DELAY);
    }

    function stopAuto() {
        if (autoTimer) clearInterval(autoTimer);
    }

    if (prevBtn) prevBtn.addEventListener('click', function () { prev(); startAuto(); });
    if (nextBtn) nextBtn.addEventListener('click', function () { next(); startAuto(); });
    dots.forEach(function (dot, d) {
        dot.addEventListener('click', function () { goTo(d); startAuto(); });
    });

    slider.addEventListener('mouseenter', stopAuto);
    slider.addEventListener('mouseleave', startAuto);
    slider.addEventListener('touchstart', stopAuto, { passive: true });
    slider.addEventListener('touchend', startAuto, { passive: true });

    window.addEventListener('resize', function () { goTo(index); });

    goTo(0);
    startAuto();
});


// ============================================================
// SAFARI TYPES SLIDER – budget / luxury / private / group cards
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('safariTypesSlider');
    if (!slider) return;

    const track = document.getElementById('safariTypesTrack');
    const cards = Array.from(track.children);
    const prevBtn = document.getElementById('safariTypesPrev');
    const nextBtn = document.getElementById('safariTypesNext');

    let index = 0;

    function visibleCount() {
        if (window.innerWidth <= 576) return 1;
        if (window.innerWidth <= 992) return 2;
        return 4;
    }

    function maxIndex() {
        return Math.max(0, cards.length - visibleCount());
    }

    function cardStep() {
        const style = window.getComputedStyle(track);
        const gap = parseFloat(style.columnGap || style.gap) || 0;
        return cards[0].getBoundingClientRect().width + gap;
    }

    function goTo(i) {
        index = Math.min(Math.max(i, 0), maxIndex());
        track.style.transform = 'translateX(-' + (index * cardStep()) + 'px)';
        if (prevBtn) prevBtn.style.visibility = index === 0 ? 'hidden' : 'visible';
        if (nextBtn) nextBtn.style.visibility = index >= maxIndex() ? 'hidden' : 'visible';
    }

    if (prevBtn) prevBtn.addEventListener('click', function () { goTo(index - 1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { goTo(index + 1); });

    window.addEventListener('resize', function () { goTo(Math.min(index, maxIndex())); });

    goTo(0);
});


// ============================================================
// SIGNATURE EXPERIENCES SLIDER – balloon / bush dinner / trekking cards
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    const slider = document.getElementById('experiencesSlider');
    if (!slider) return;

    const track = document.getElementById('experiencesTrack');
    const cards = Array.from(track.children);
    const prevBtn = document.getElementById('experiencesPrev');
    const nextBtn = document.getElementById('experiencesNext');
    const dotsWrap = document.getElementById('experiencesDots');

    let index = 0;

    function visibleCount() {
        if (window.innerWidth <= 480) return 1;
        if (window.innerWidth <= 768) return 2;
        if (window.innerWidth <= 992) return 3;
        return 5;
    }

    function maxIndex() {
        return Math.max(0, cards.length - visibleCount());
    }

    function cardStep() {
        const style = window.getComputedStyle(track);
        const gap = parseFloat(style.columnGap || style.gap) || 0;
        return cards[0].getBoundingClientRect().width + gap;
    }

    function buildDots() {
        if (!dotsWrap) return;
        dotsWrap.innerHTML = '';
        const count = maxIndex() + 1;
        for (let i = 0; i < count; i++) {
            const dot = document.createElement('button');
            dot.type = 'button';
            dot.setAttribute('aria-label', 'Vai al gruppo ' + (i + 1));
            dot.addEventListener('click', function () { goTo(i); });
            dotsWrap.appendChild(dot);
        }
    }

    function updateDots() {
        if (!dotsWrap) return;
        Array.from(dotsWrap.children).forEach(function (dot, i) {
            dot.classList.toggle('active', i === index);
        });
    }

    function goTo(i) {
        index = Math.min(Math.max(i, 0), maxIndex());
        track.style.transform = 'translateX(-' + (index * cardStep()) + 'px)';
        if (prevBtn) prevBtn.disabled = index === 0;
        if (nextBtn) nextBtn.disabled = index >= maxIndex();
        updateDots();
    }

    if (prevBtn) prevBtn.addEventListener('click', function () { goTo(index - 1); });
    if (nextBtn) nextBtn.addEventListener('click', function () { goTo(index + 1); });

    window.addEventListener('resize', function () {
        buildDots();
        goTo(Math.min(index, maxIndex()));
    });

    buildDots();
    goTo(0);
});


// ============================================================
// STORY MODAL – opens the full story for a preview card
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.getElementById('storyModalOverlay');
    if (!overlay) return;

    const closeBtn = document.getElementById('storyModalClose');
    const cards = document.querySelectorAll('.story-preview-card');
    const contents = document.querySelectorAll('[data-story-content]');

    function open(key) {
        contents.forEach(function (el) {
            el.hidden = el.getAttribute('data-story-content') !== key;
        });
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function close() {
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    cards.forEach(function (card) {
        card.addEventListener('click', function () {
            open(card.getAttribute('data-story'));
        });
    });

    if (closeBtn) closeBtn.addEventListener('click', close);
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) close();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.classList.contains('open')) close();
    });
});


// ============================================================
// BEST PACKAGES SLIDER
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('packagesTrack');
    if (!track) return;

    const slider = track.closest('.best-packages-slider');
    const cards = Array.from(track.children);
    const prevBtn = document.getElementById('packagesPrev');
    const nextBtn = document.getElementById('packagesNext');
    const AUTO_DELAY = 5000;

    let index = 0;
    let autoTimer = null;

    function cardStep() {
        const style = window.getComputedStyle(track);
        const gap = parseFloat(style.columnGap || style.gap) || 0;
        return cards[0].getBoundingClientRect().width + gap;
    }

    function maxIndex() {
        const step = cardStep();
        const sliderWidth = slider.getBoundingClientRect().width;
        const visible = Math.max(1, Math.floor(sliderWidth / step));
        return Math.max(0, cards.length - visible);
    }

    function goTo(i) {
        const max = maxIndex();
        index = ((i % (max + 1)) + (max + 1)) % (max + 1);
        track.style.transform = 'translateX(-' + (index * cardStep()) + 'px)';
    }

    function next() { goTo(index + 1); }
    function prev() { goTo(index - 1); }

    function startAuto() {
        stopAuto();
        autoTimer = setInterval(next, AUTO_DELAY);
    }

    function stopAuto() {
        if (autoTimer) clearInterval(autoTimer);
    }

    if (prevBtn) prevBtn.addEventListener('click', function () { prev(); startAuto(); });
    if (nextBtn) nextBtn.addEventListener('click', function () { next(); startAuto(); });

    slider.addEventListener('mouseenter', stopAuto);
    slider.addEventListener('mouseleave', startAuto);
    slider.addEventListener('touchstart', stopAuto, { passive: true });
    slider.addEventListener('touchend', startAuto, { passive: true });

    window.addEventListener('resize', function () { goTo(index); });

    goTo(0);
    startAuto();
});
