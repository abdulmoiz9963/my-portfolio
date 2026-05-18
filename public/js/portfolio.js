// ── Typed text animation ─────────────────────────────────────
const roles = [
  'DevOps Engineer',
  'Cloud Infrastructure',
  'CI/CD Automation',
  'Container Orchestration',
  'AWS Solutions'
];
let roleIndex = 0, charIndex = 0, isDeleting = false;
const typedEl = document.getElementById('typedText');

function typeEffect() {
  if (!typedEl) return;
  const current = roles[roleIndex];
  if (isDeleting) {
    typedEl.textContent = current.substring(0, charIndex--);
    if (charIndex < 0) { isDeleting = false; roleIndex = (roleIndex + 1) % roles.length; setTimeout(typeEffect, 500); return; }
    setTimeout(typeEffect, 60);
  } else {
    typedEl.textContent = current.substring(0, charIndex++);
    if (charIndex > current.length) { isDeleting = true; setTimeout(typeEffect, 1800); return; }
    setTimeout(typeEffect, 100);
  }
}
typeEffect();

// ── Navbar scroll behavior ────────────────────────────────────
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 50);
  const sections = document.querySelectorAll('section[id]');
  const scrollPos = window.scrollY + 90;
  sections.forEach(sec => {
    const link = document.querySelector(`.nav-links a[href="#${sec.id}"]`);
    if (!link) return;
    if (sec.offsetTop <= scrollPos && sec.offsetTop + sec.offsetHeight > scrollPos) {
      document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
      link.classList.add('active');
    }
  });
});

// ── Hamburger ─────────────────────────────────────────────────
const hamburger = document.getElementById('hamburger');
const navLinks = document.querySelector('.nav-links');
if (hamburger) {
  hamburger.addEventListener('click', () => navLinks.classList.toggle('open'));
  document.querySelectorAll('.nav-links a').forEach(a => a.addEventListener('click', () => navLinks.classList.remove('open')));
}

// ── Reveal on scroll ──────────────────────────────────────────
const reveals = document.querySelectorAll('.reveal');
const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      setTimeout(() => entry.target.classList.add('visible'), i * 80);
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.1 });
reveals.forEach(el => revealObserver.observe(el));

// ── Smooth scroll ─────────────────────────────────────────────
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', e => {
    const href = anchor.getAttribute('href');
    if (href === '#') return;
    const target = document.querySelector(href);
    if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
  });
});

// ── Contact form popup ────────────────────────────────────────
// ── Contact form popup ────────────────────────────────────────
window.addEventListener('load', () => {
  const successMsg = document.getElementById('successPopup');
  if (successMsg) {
    // Small delay to allow CSS transition to work
    setTimeout(() => successMsg.classList.add('show'), 100);
    // Auto hide after 4 seconds
    setTimeout(() => successMsg.classList.remove('show'), 4500);
  }
});
window.openImageModal = function(imageSrc, caption) {
  const modal = document.getElementById('imageModal');
  const modalImage = document.getElementById('modalImage');
  const modalCaption = document.getElementById('modalCaption');
  if (!modal || !modalImage) return;
  modalImage.src = imageSrc;
  if (modalCaption) modalCaption.textContent = caption || '';
  modal.classList.add('show');
  document.body.style.overflow = 'hidden';
}

window.closeImageModal = function(event) {
  if (event && event.target && event.target.closest && event.target.closest('.modal-content')) return;
  const modal = document.getElementById('imageModal');
  if (!modal) return;
  modal.classList.remove('show');
  document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') window.closeImageModal();
});
