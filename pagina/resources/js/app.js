import './bootstrap';

/* ---------- NAV scroll + mobile menu ---------- */
const nav = document.getElementById('nav');
if (nav) {
    const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 40);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');
    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', () => navLinks.classList.toggle('open'));
        navLinks.querySelectorAll('a').forEach(a =>
            a.addEventListener('click', () => navLinks.classList.remove('open'))
        );
    }
}

/* ---------- PROGRAMA tabs ---------- */
const tabs = document.querySelectorAll('.tab');
const panels = document.querySelectorAll('.panel');
if (tabs.length) {
    tabs.forEach(tab => tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        panels.forEach(p => p.classList.remove('active'));
        tab.classList.add('active');
        const target = document.getElementById(tab.dataset.tab);
        if (target) target.classList.add('active');
    }));
}

/* ---------- COUNTDOWN ---------- */
function nextEventDate() {
    const now = new Date();
    let y = now.getFullYear();
    let d = new Date(y, 8, 13, 8, 0, 0);
    if (d.getTime() < now.getTime()) d = new Date(y + 1, 8, 13, 8, 0, 0);
    return d;
}
const cdEls = {
    d: document.getElementById('cd-d'),
    h: document.getElementById('cd-h'),
    m: document.getElementById('cd-m'),
    s: document.getElementById('cd-s'),
};
if (cdEls.d) {
    const target = nextEventDate();
    const pad = n => String(n).padStart(2, '0');
    function tick() {
        let diff = Math.max(0, target.getTime() - Date.now());
        const day = Math.floor(diff / 86400000); diff -= day * 86400000;
        const hr  = Math.floor(diff / 3600000);  diff -= hr * 3600000;
        const mn  = Math.floor(diff / 60000);     diff -= mn * 60000;
        const sc  = Math.floor(diff / 1000);
        cdEls.d.textContent = pad(day);
        cdEls.h.textContent = pad(hr);
        cdEls.m.textContent = pad(mn);
        cdEls.s.textContent = pad(sc);
    }
    tick();
    setInterval(tick, 1000);
}

/* ---------- REGISTRO FORM (fetch → JSON) ---------- */
const regForm = document.getElementById('regForm');
const formSuccess = document.getElementById('formSuccess');
const successMsg = document.getElementById('successMsg');
const successWa = document.getElementById('successWa');
const formError = document.getElementById('form-error');
const submitBtn = document.getElementById('submitBtn');

if (regForm) {
    regForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (!regForm.checkValidity()) { regForm.reportValidity(); return; }

        submitBtn.disabled = true;
        submitBtn.textContent = 'Enviando…';
        if (formError) formError.style.display = 'none';

        try {
            const res = await fetch('/inscripcion', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(Object.fromEntries(new FormData(regForm).entries())),
            });

            const data = await res.json();

            if (!res.ok) {
                const msgs = data.errors
                    ? Object.values(data.errors).flat().join(' · ')
                    : (data.message || 'Error al enviar el formulario.');
                if (formError) {
                    formError.textContent = msgs;
                    formError.style.display = 'block';
                }
                submitBtn.disabled = false;
                submitBtn.textContent = 'Reservar mi cupo →';
                return;
            }

            if (successMsg) {
                successMsg.textContent = `¡Gracias, ${data.nombre}! Tu pre-inscripción (${data.category}) quedó registrada. Realiza el pago y envía tu comprobante por WhatsApp para confirmar tu cupo.`;
            }
            if (successWa) successWa.href = data.wa_url;
            regForm.style.display = 'none';
            if (formSuccess) formSuccess.classList.add('show');

        } catch {
            if (formError) {
                formError.textContent = 'Error de conexión. Intenta nuevamente.';
                formError.style.display = 'block';
            }
            submitBtn.disabled = false;
            submitBtn.textContent = 'Reservar mi cupo →';
        }
    });
}

/* ---------- NEURAL NETWORK CANVAS ---------- */
(function () {
    const canvas = document.getElementById('neural');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let w, h, nodes = [], raf;
    const DPR = Math.min(window.devicePixelRatio || 1, 2);

    function resize() {
        w = canvas.clientWidth; h = canvas.clientHeight;
        canvas.width = w * DPR; canvas.height = h * DPR;
        ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
        const count = Math.min(80, Math.floor(w * h / 15000));
        nodes = Array.from({ length: count }, () => ({
            x: Math.random() * w, y: Math.random() * h,
            vx: (Math.random() - .5) * .32, vy: (Math.random() - .5) * .32,
            r: Math.random() * 1.8 + 1,
        }));
    }

    function draw() {
        ctx.clearRect(0, 0, w, h);
        for (let i = 0; i < nodes.length; i++) {
            const a = nodes[i];
            a.x += a.vx; a.y += a.vy;
            if (a.x < 0 || a.x > w) a.vx *= -1;
            if (a.y < 0 || a.y > h) a.vy *= -1;
            for (let j = i + 1; j < nodes.length; j++) {
                const b = nodes[j];
                const dx = a.x - b.x, dy = a.y - b.y;
                const dist = Math.hypot(dx, dy);
                if (dist < 140) {
                    const op = (1 - dist / 140) * .5;
                    ctx.strokeStyle = `rgba(92,198,245,${op})`;
                    ctx.lineWidth = .7;
                    ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y); ctx.stroke();
                }
            }
        }
        for (const n of nodes) {
            ctx.beginPath(); ctx.arc(n.x, n.y, n.r, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(150,210,250,.85)'; ctx.fill();
            ctx.beginPath(); ctx.arc(n.x, n.y, n.r * 3, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(92,198,245,.08)'; ctx.fill();
        }
        if (!reduce) raf = requestAnimationFrame(draw);
    }

    resize();
    draw();
    let rt;
    window.addEventListener('resize', () => { clearTimeout(rt); rt = setTimeout(resize, 200); });
})();
