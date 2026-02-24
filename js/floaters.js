 // ── FLOATING EMOJIS : Esto hace que en el incio de sesion se vea que flotan los emojis──
 const floaters = ['🍓', '🫔', '🍰', '🧇', '🍫', '🥤', '🍦', '🍮', '🎂', '🥭', '🍪', '🍩'];
 const floaterContainer = document.getElementById('floaters');
 floaters.forEach((emoji, i) => {
     const el = document.createElement('div');
     el.className = 'floater';
     el.textContent = emoji;
     el.style.left = `${Math.random() * 90}%`;
     el.style.animationDelay = `${i * 1.5}s`;
     el.style.animationDuration = `${16 + Math.random() * 8}s`;
     el.style.fontSize = `${20 + Math.random() * 18}px`;
     floaterContainer.appendChild(el);
 });