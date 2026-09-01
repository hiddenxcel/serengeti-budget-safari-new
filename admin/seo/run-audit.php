<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$pageTitle = 'Run SEO Audit';

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">SEO Audit</h2>
    <div id="auditProgress">
        <p id="auditPhaseText">Ready to start.</p>
        <p id="auditCounter" style="font-weight:600;"></p>
        <p id="auditCurrentUrl" style="color:var(--admin-muted,#666);font-size:0.85rem;word-break:break-all;"></p>
    </div>
    <div class="admin-form-actions">
        <button type="button" class="admin-btn primary" id="startAuditBtn">Run Full Audit</button>
        <button type="button" class="admin-btn danger" id="cancelAuditBtn" style="display:none;">Cancel</button>
        <a href="<?= admin_base_url() ?>/seo/index.php" class="admin-btn">Back to Dashboard</a>
    </div>
    <div id="auditError"></div>
</div>

<script>
var csrfToken = <?= json_encode(csrf_token()) ?>;
var adminBase = <?= json_encode(admin_base_url()) ?>;
var currentAuditId = null;
var cancelled = false;

var startBtn = document.getElementById('startAuditBtn');
var cancelBtn = document.getElementById('cancelAuditBtn');
var phaseText = document.getElementById('auditPhaseText');
var counter = document.getElementById('auditCounter');
var currentUrlEl = document.getElementById('auditCurrentUrl');
var errorEl = document.getElementById('auditError');

function postChunk(body) {
    return fetch('run-audit-chunk.php', { method: 'POST', body: body }).then(function (r) { return r.json(); });
}

function pollChunk() {
    if (cancelled) {
        return;
    }
    var body = new URLSearchParams();
    body.set('csrf_token', csrfToken);
    body.set('audit_id', currentAuditId);

    postChunk(body).then(function (json) {
        if (json.error) {
            errorEl.innerHTML = '<div class="admin-error">' + json.error + '</div>';
            resetButtons();
            return;
        }

        if (json.phase === 'crawling' || json.phase === 'discovering') {
            phaseText.textContent = 'Crawling pages...';
            counter.textContent = json.pages_crawled + ' / ' + json.pages_discovered;
            currentUrlEl.textContent = json.current_url || '';
        }

        if (json.done) {
            if (json.phase === 'failed') {
                errorEl.innerHTML = '<div class="admin-error">Audit failed: ' + (json.error || 'unknown error') + '</div>';
            } else if (json.phase === 'complete') {
                phaseText.textContent = 'Finalizing SEO analysis... Done!';
                counter.textContent = 'Overall score: ' + json.overall_score + ' / 100';
                currentUrlEl.textContent = '';
                setTimeout(function () {
                    window.location.href = adminBase + '/seo/index.php';
                }, 1200);
            }
            resetButtons();
            return;
        }

        pollChunk();
    }).catch(function () {
        errorEl.innerHTML = '<div class="admin-error">Could not reach the server.</div>';
        resetButtons();
    });
}

function resetButtons() {
    startBtn.style.display = '';
    startBtn.disabled = false;
    cancelBtn.style.display = 'none';
}

startBtn.addEventListener('click', function () {
    errorEl.innerHTML = '';
    startBtn.disabled = true;
    cancelBtn.style.display = '';
    cancelled = false;
    phaseText.textContent = 'Discovering pages...';
    counter.textContent = '';

    var body = new URLSearchParams();
    body.set('csrf_token', csrfToken);
    body.set('action', 'start');

    postChunk(body).then(function (json) {
        if (json.error) {
            errorEl.innerHTML = '<div class="admin-error">' + json.error + '</div>';
            resetButtons();
            return;
        }
        currentAuditId = json.audit_id;
        pollChunk();
    }).catch(function () {
        errorEl.innerHTML = '<div class="admin-error">Could not reach the server.</div>';
        resetButtons();
    });
});

cancelBtn.addEventListener('click', function () {
    cancelled = true;
    var body = new URLSearchParams();
    body.set('csrf_token', csrfToken);
    body.set('audit_id', currentAuditId);
    fetch('cancel-audit.php', { method: 'POST', body: body }).then(function () {
        phaseText.textContent = 'Cancelled.';
        resetButtons();
    });
});
</script>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
