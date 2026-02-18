<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dulce & Co — Acceso</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --cream:    #FDF6EE;
    --blush:    #F5DDD0;
    --rose:     #E8A89C;
    --berry:    #C96B7A;
    --dark:     #3D1F2A;
    --choco:    #6B3A4A;
    --gold:     #D4A853;
    --mint:     #8BBFAD;
  }

  *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--dark);
    min-height: 100vh;
    display: flex;
    overflow: hidden;
  }

  /* ── LEFT PANEL ── */
  .left {
    flex: 1;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 60px 64px;
    overflow: hidden;
  }

  /* animated blobs */
  .blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.25;
    animation: drift 12s ease-in-out infinite alternate;
  }
  .blob-1 { width: 520px; height: 520px; background: var(--berry); top: -120px; left: -100px; animation-delay: 0s; }
  .blob-2 { width: 380px; height: 380px; background: var(--gold);  bottom: -80px; left: 60px;  animation-delay: -4s; }
  .blob-3 { width: 300px; height: 300px; background: var(--rose);  top: 40%;  left: 50%;   animation-delay: -8s; }

  @keyframes drift {
    from { transform: translate(0, 0) scale(1); }
    to   { transform: translate(30px, 20px) scale(1.08); }
  }

  /* floating food emojis */
  .floaters { position: absolute; inset: 0; pointer-events: none; }
  .floater {
    position: absolute;
    font-size: 28px;
    opacity: 0;
    animation: floatUp 18s linear infinite;
    filter: drop-shadow(0 4px 12px rgba(0,0,0,0.3));
  }
  @keyframes floatUp {
    0%   { transform: translateY(110vh) rotate(0deg);   opacity: 0; }
    5%   { opacity: 0.6; }
    90%  { opacity: 0.4; }
    100% { transform: translateY(-10vh) rotate(30deg);  opacity: 0; }
  }

  /* branding */
  .branding { position: relative; z-index: 2; }

  .logo-mark {
    width: 64px; height: 64px;
    background: rgba(255,255,255,0.08);
    border: 1.5px solid rgba(255,255,255,0.15);
    border-radius: 18px;
    display: flex; align-items: center; justify-content: center;
    font-size: 30px;
    margin-bottom: 40px;
    backdrop-filter: blur(8px);
    animation: fadeDown 0.7s ease both;
  }

  .brand-name {
    font-family: 'Playfair Display', serif;
    font-size: 58px;
    font-weight: 700;
    color: var(--cream);
    line-height: 1.0;
    letter-spacing: -0.01em;
    animation: fadeDown 0.7s 0.1s ease both;
  }
  .brand-name em {
    font-style: italic;
    color: var(--rose);
  }

  .brand-tagline {
    font-size: 15px;
    color: rgba(253,246,238,0.45);
    margin-top: 14px;
    font-weight: 300;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    animation: fadeDown 0.7s 0.2s ease both;
  }

  .divider {
    width: 48px;
    height: 2px;
    background: linear-gradient(90deg, var(--gold), transparent);
    margin: 32px 0;
    animation: fadeDown 0.7s 0.3s ease both;
  }

  .brand-desc {
    font-size: 16px;
    color: rgba(253,246,238,0.55);
    line-height: 1.7;
    max-width: 360px;
    font-weight: 300;
    animation: fadeDown 0.7s 0.35s ease both;
  }

  /* stat pills */
  .stats {
    display: flex;
    gap: 12px;
    margin-top: 44px;
    animation: fadeDown 0.7s 0.45s ease both;
  }
  .stat-pill {
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(6px);
    border-radius: 40px;
    padding: 10px 18px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .stat-pill .s-icon { font-size: 18px; }
  .stat-pill .s-val {
    font-size: 15px;
    font-weight: 700;
    color: var(--cream);
  }
  .stat-pill .s-lbl {
    font-size: 11px;
    color: rgba(253,246,238,0.4);
    font-weight: 300;
  }

  @keyframes fadeDown {
    from { opacity: 0; transform: translateY(-14px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* ── RIGHT PANEL ── */
  .right {
    width: 460px;
    flex-shrink: 0;
    background: var(--cream);
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 52px 48px;
    position: relative;
    overflow: hidden;
  }

  /* decorative corner */
  .right::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 220px; height: 220px;
    background: var(--blush);
    border-radius: 50%;
    opacity: 0.6;
  }
  .right::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -40px;
    width: 200px; height: 200px;
    background: var(--blush);
    border-radius: 50%;
    opacity: 0.5;
  }

  .form-wrap {
    position: relative;
    z-index: 2;
    animation: slideRight 0.65s 0.15s cubic-bezier(0.22, 1, 0.36, 1) both;
  }
  @keyframes slideRight {
    from { opacity: 0; transform: translateX(28px); }
    to   { opacity: 1; transform: translateX(0); }
  }

  .form-eyebrow {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--berry);
    margin-bottom: 10px;
  }

  .form-title {
    font-family: 'Playfair Display', serif;
    font-size: 32px;
    font-weight: 700;
    color: var(--dark);
    line-height: 1.15;
    margin-bottom: 6px;
  }
  .form-title em { font-style: italic; color: var(--berry); }

  .form-sub {
    font-size: 13px;
    color: rgba(61,31,42,0.45);
    margin-bottom: 34px;
    font-weight: 300;
  }

  /* USER SELECTOR */
  .user-selector {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 26px;
  }
  .user-card {
    border: 2px solid rgba(61,31,42,0.09);
    border-radius: 14px;
    padding: 14px 12px;
    cursor: pointer;
    transition: all 0.2s;
    background: white;
    display: flex;
    align-items: center;
    gap: 10px;
    position: relative;
    overflow: hidden;
  }
  .user-card::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--rose), var(--berry));
    opacity: 0;
    transition: opacity 0.2s;
  }
  .user-card:hover { border-color: var(--rose); transform: translateY(-2px); box-shadow: 0 6px 20px rgba(201,107,122,0.18); }
  .user-card.selected {
    border-color: var(--berry);
    background: var(--dark);
  }
  .user-card.selected .u-name { color: white; }
  .user-card.selected .u-role { color: rgba(255,255,255,0.5); }
  .user-avatar {
    width: 38px; height: 38px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
    background: var(--blush);
    transition: background 0.2s;
    position: relative; z-index: 1;
  }
  .user-card.selected .user-avatar { background: rgba(255,255,255,0.12); }
  .u-info { flex: 1; position: relative; z-index: 1; }
  .u-name { font-size: 13px; font-weight: 600; color: var(--dark); transition: color 0.2s; }
  .u-role { font-size: 11px; color: rgba(61,31,42,0.4); font-weight: 300; transition: color 0.2s; }
  .u-check {
    position: absolute; top: 8px; right: 8px;
    width: 18px; height: 18px;
    border-radius: 50%;
    background: var(--berry);
    color: white;
    font-size: 10px;
    display: flex; align-items: center; justify-content: center;
    opacity: 0;
    transition: opacity 0.2s;
    z-index: 1;
  }
  .user-card.selected .u-check { opacity: 1; }

  /* INPUTS */
  .field { margin-bottom: 16px; }
  .field label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--choco);
    margin-bottom: 7px;
  }
  .input-wrap { position: relative; }
  .input-wrap input {
    width: 100%;
    padding: 13px 16px 13px 44px;
    border: 2px solid rgba(61,31,42,0.10);
    border-radius: 12px;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    color: var(--dark);
    background: white;
    outline: none;
    transition: all 0.2s;
    letter-spacing: 0.02em;
  }
  .input-wrap input::placeholder { color: rgba(61,31,42,0.3); }
  .input-wrap input:focus {
    border-color: var(--rose);
    box-shadow: 0 0 0 4px rgba(232,168,156,0.18);
  }
  .input-icon {
    position: absolute;
    left: 14px; top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    opacity: 0.45;
    pointer-events: none;
    transition: opacity 0.2s;
  }
  .input-wrap input:focus ~ .input-icon { opacity: 0.9; }
  .eye-toggle {
    position: absolute;
    right: 14px; top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    font-size: 16px;
    opacity: 0.35;
    transition: opacity 0.2s;
    padding: 0;
  }
  .eye-toggle:hover { opacity: 0.75; }

  /* PIN MODE */
  .pin-section { margin-bottom: 16px; }
  .pin-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--choco);
    margin-bottom: 10px;
    display: block;
  }
  .pin-dots {
    display: flex;
    gap: 10px;
    margin-bottom: 16px;
  }
  .pin-dot {
    flex: 1;
    height: 52px;
    border: 2px solid rgba(61,31,42,0.10);
    border-radius: 12px;
    background: white;
    display: flex; align-items: center; justify-content: center;
    font-size: 24px;
    color: var(--berry);
    transition: all 0.2s;
  }
  .pin-dot.filled {
    border-color: var(--berry);
    background: #FDF0F2;
  }
  .pin-dot.filled::after { content: '●'; }
  .pin-dot.error { border-color: #E44; background: #FFF5F5; animation: shake 0.35s ease; }
  @keyframes shake {
    0%,100% { transform: translateX(0); }
    20%      { transform: translateX(-6px); }
    60%      { transform: translateX(6px); }
  }

  .pin-pad {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
  }
  .pin-key {
    height: 52px;
    border: 1.5px solid rgba(61,31,42,0.10);
    border-radius: 12px;
    background: white;
    font-family: 'DM Sans', sans-serif;
    font-size: 18px;
    font-weight: 600;
    color: var(--dark);
    cursor: pointer;
    transition: all 0.15s;
    display: flex; align-items: center; justify-content: center;
    user-select: none;
  }
  .pin-key:hover { background: var(--blush); border-color: var(--rose); transform: scale(0.97); }
  .pin-key:active { transform: scale(0.92); }
  .pin-key.del { font-size: 20px; color: var(--choco); }
  .pin-key.zero { grid-column: 2; }

  /* LOGIN MODE TOGGLE */
  .mode-toggle {
    display: flex;
    background: rgba(61,31,42,0.06);
    border-radius: 10px;
    padding: 3px;
    margin-bottom: 24px;
  }
  .mode-btn {
    flex: 1;
    padding: 8px;
    border: none;
    border-radius: 8px;
    background: transparent;
    font-family: 'DM Sans', sans-serif;
    font-size: 12px;
    font-weight: 600;
    color: rgba(61,31,42,0.45);
    cursor: pointer;
    transition: all 0.2s;
    letter-spacing: 0.03em;
  }
  .mode-btn.active {
    background: white;
    color: var(--dark);
    box-shadow: 0 2px 8px rgba(61,31,42,0.12);
  }

  /* SUBMIT */
  .btn-login {
    width: 100%;
    padding: 15px;
    border-radius: 14px;
    border: none;
    background: linear-gradient(135deg, var(--dark) 0%, var(--choco) 100%);
    color: var(--cream);
    font-family: 'Playfair Display', serif;
    font-size: 17px;
    font-weight: 600;
    letter-spacing: 0.02em;
    cursor: pointer;
    transition: all 0.22s;
    box-shadow: 0 6px 22px rgba(61,31,42,0.28);
    display: flex; align-items: center; justify-content: center; gap: 8px;
    margin-top: 6px;
    position: relative;
    overflow: hidden;
  }
  .btn-login::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--berry), #A8485A);
    opacity: 0;
    transition: opacity 0.22s;
  }
  .btn-login:hover::before { opacity: 1; }
  .btn-login:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(61,31,42,0.35); }
  .btn-login:active { transform: translateY(0); }
  .btn-login span { position: relative; z-index: 1; }
  .btn-login .btn-icon { position: relative; z-index: 1; font-size: 18px; }

  /* loading state */
  .btn-login.loading { pointer-events: none; }
  .btn-login.loading span { opacity: 0; }
  .btn-login.loading::after {
    content: '';
    position: absolute;
    width: 22px; height: 22px;
    border: 2.5px solid rgba(255,255,255,0.3);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    z-index: 2;
  }
  @keyframes spin { to { transform: rotate(360deg); } }

  /* ERROR */
  .error-msg {
    background: #FFF0F0;
    border: 1px solid rgba(200,60,60,0.2);
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 13px;
    color: #C44;
    margin-bottom: 14px;
    display: none;
    align-items: center;
    gap: 6px;
  }
  .error-msg.show { display: flex; }

  /* FOOTER */
  .form-footer {
    margin-top: 22px;
    text-align: center;
    font-size: 12px;
    color: rgba(61,31,42,0.35);
    font-weight: 300;
  }
  .form-footer strong { color: var(--choco); font-weight: 600; }

  /* success overlay */
  .success-overlay {
    position: fixed; inset: 0;
    background: var(--dark);
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    z-index: 999;
    opacity: 0; pointer-events: none;
    transition: opacity 0.4s;
    gap: 16px;
  }
  .success-overlay.show { opacity: 1; pointer-events: all; }
  .success-icon {
    font-size: 64px;
    animation: popIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
  }
  @keyframes popIn {
    from { transform: scale(0); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
  }
  .success-text {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    color: var(--cream);
    animation: fadeDown 0.5s 0.2s ease both;
  }
  .success-sub {
    font-size: 14px;
    color: rgba(253,246,238,0.45);
    animation: fadeDown 0.5s 0.3s ease both;
  }
  .progress-bar {
    width: 200px; height: 3px;
    background: rgba(255,255,255,0.12);
    border-radius: 3px;
    margin-top: 8px;
    overflow: hidden;
    animation: fadeDown 0.5s 0.35s ease both;
  }
  .progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--rose), var(--berry));
    border-radius: 3px;
    width: 0%;
    transition: width 1.8s linear;
  }
</style>
</head>
<body>

<!-- LEFT PANEL -->
<div class="left">
  <!-- blobs -->
  <div class="blob blob-1"></div>
  <div class="blob blob-2"></div>
  <div class="blob blob-3"></div>

  <!-- floating emojis -->
  <div class="floaters" id="floaters"></div>

  <!-- branding -->
  <div class="branding">
    <div class="logo-mark">🍓</div>
    <div class="brand-name">Dulce<br><em>& Co</em></div>
    <div class="brand-tagline">Sistema de punto de venta</div>
    <div class="divider"></div>
    <div class="brand-desc">
      Gestiona tu negocio de postres con elegancia. Pedidos, mesas y cobros en un solo lugar.
    </div>

    <div class="stats">
      <div class="stat-pill">
        <span class="s-icon">🧇</span>
        <div>
          <div class="s-val">22</div>
          <div class="s-lbl">Productos</div>
        </div>
      </div>
      <div class="stat-pill">
        <span class="s-icon">🪑</span>
        <div>
          <div class="s-val">8</div>
          <div class="s-lbl">Mesas</div>
        </div>
      </div>
      <div class="stat-pill">
        <span class="s-icon">☕</span>
        <div>
          <div class="s-val">Hoy</div>
          <div class="s-lbl" id="fecha-stat">—</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- RIGHT PANEL -->
<div class="right">
  <div class="form-wrap">
    <div class="form-eyebrow">Bienvenida de nuevo</div>
    <div class="form-title">Accede a tu<br><em>tablero</em></div>
    <div class="form-sub">Selecciona tu usuario para continuar</div>

    <!-- USER SELECTOR -->
    <div class="user-selector" id="user-selector">
      <div class="user-card selected" onclick="selectUser(this, 'Ana García', 'Cajera')" data-pass="1234" data-user="Ana García">
        <div class="user-avatar">👩‍💼</div>
        <div class="u-info">
          <div class="u-name">Ana García</div>
          <div class="u-role">Cajera</div>
        </div>
        <div class="u-check">✓</div>
      </div>
      <div class="user-card" onclick="selectUser(this, 'Carlos M.', 'Gerente')" data-pass="5678" data-user="Carlos M.">
        <div class="user-avatar">👨‍💼</div>
        <div class="u-info">
          <div class="u-name">Carlos M.</div>
          <div class="u-role">Gerente</div>
        </div>
        <div class="u-check">✓</div>
      </div>
      <div class="user-card" onclick="selectUser(this, 'Sofía R.', 'Mesera')" data-pass="9012" data-user="Sofía R.">
        <div class="user-avatar">👩‍🍳</div>
        <div class="u-info">
          <div class="u-name">Sofía R.</div>
          <div class="u-role">Mesera</div>
        </div>
        <div class="u-check">✓</div>
      </div>
      <div class="user-card" onclick="selectUser(this, 'Admin', 'Administrador')" data-pass="0000" data-user="Admin">
        <div class="user-avatar">🔑</div>
        <div class="u-info">
          <div class="u-name">Admin</div>
          <div class="u-role">Administrador</div>
        </div>
        <div class="u-check">✓</div>
      </div>
    </div>

    <!-- MODE TOGGLE -->
    <div class="mode-toggle">
      <button class="mode-btn active" onclick="setMode('pin', this)">🔢 PIN</button>
      <button class="mode-btn" onclick="setMode('pass', this)">🔒 Contraseña</button>
    </div>

    <!-- ERROR -->
    <div class="error-msg" id="error-msg">
      <span>⚠️</span> <span id="error-text">Credenciales incorrectas</span>
    </div>

    <!-- PIN MODE -->
    <div id="pin-mode">
      <span class="pin-label">Ingresa tu PIN</span>
      <div class="pin-dots" id="pin-dots">
        <div class="pin-dot" id="dot-0"></div>
        <div class="pin-dot" id="dot-1"></div>
        <div class="pin-dot" id="dot-2"></div>
        <div class="pin-dot" id="dot-3"></div>
      </div>
      <div class="pin-pad">
        <button class="pin-key" onclick="pinKey('1')">1</button>
        <button class="pin-key" onclick="pinKey('2')">2</button>
        <button class="pin-key" onclick="pinKey('3')">3</button>
        <button class="pin-key" onclick="pinKey('4')">4</button>
        <button class="pin-key" onclick="pinKey('5')">5</button>
        <button class="pin-key" onclick="pinKey('6')">6</button>
        <button class="pin-key" onclick="pinKey('7')">7</button>
        <button class="pin-key" onclick="pinKey('8')">8</button>
        <button class="pin-key" onclick="pinKey('9')">9</button>
        <button class="pin-key del" onclick="pinDel()">⌫</button>
        <button class="pin-key zero" onclick="pinKey('0')">0</button>
        <button class="pin-key" onclick="pinClear()">✕</button>
      </div>
    </div>

    <!-- PASSWORD MODE -->
    <div id="pass-mode" style="display:none">
      <div class="field">
        <label>Contraseña</label>
        <div class="input-wrap">
          <input type="password" id="pass-input" placeholder="••••••••" />
          <span class="input-icon">🔒</span>
          <button class="eye-toggle" onclick="toggleEye()" id="eye-btn">👁️</button>
        </div>
      </div>
      <button class="btn-login" onclick="loginPass()">
        <span class="btn-icon">🍰</span>
        <span>Ingresar al sistema</span>
      </button>
    </div>

    <div class="form-footer">
      PIN de prueba: <strong>Ana → 1234 · Carlos → 5678</strong><br>
      <span style="opacity:0.6">Contraseña: el mismo número</span>
    </div>
  </div>
</div>

<!-- SUCCESS OVERLAY -->
<div class="success-overlay" id="success-overlay">
  <div class="success-icon">🎉</div>
  <div class="success-text" id="success-name">¡Hola, Ana!</div>
  <div class="success-sub">Accediendo al sistema...</div>
  <div class="progress-bar">
    <div class="progress-fill" id="progress-fill"></div>
  </div>
</div>

<script>
// ── FLOATING EMOJIS ──
const floaters = ['🍓','🫔','🍰','🧇','🍫','🥤','🍦','🍮','🎂','🥭','🍪','🍩'];
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

// ── FECHA ──
const dias = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
const now = new Date();
document.getElementById('fecha-stat').textContent =
  `${dias[now.getDay()]} ${now.getDate()} ${meses[now.getMonth()]}`;

// ── USER SELECT ──
let currentUser = { name: 'Ana García', pass: '1234' };

function selectUser(card, name, role) {
  document.querySelectorAll('.user-card').forEach(c => c.classList.remove('selected'));
  card.classList.add('selected');
  currentUser = { name, pass: card.dataset.pass };
  pinReset();
  hideError();
}

// ── MODE TOGGLE ──
let loginMode = 'pin';

function setMode(mode, btn) {
  loginMode = mode;
  document.querySelectorAll('.mode-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('pin-mode').style.display  = mode === 'pin'  ? 'block' : 'none';
  document.getElementById('pass-mode').style.display = mode === 'pass' ? 'block' : 'none';
  pinReset();
  hideError();
}

// ── PIN ──
let pinVal = '';

function pinKey(digit) {
  if (pinVal.length >= 4) return;
  pinVal += digit;
  renderPinDots();
  if (pinVal.length === 4) {
    setTimeout(() => checkPin(), 120);
  }
}

function pinDel() {
  pinVal = pinVal.slice(0, -1);
  renderPinDots();
  hideError();
}

function pinClear() {
  pinReset();
  hideError();
}

function pinReset() {
  pinVal = '';
  renderPinDots();
}

function renderPinDots() {
  for (let i = 0; i < 4; i++) {
    const dot = document.getElementById(`dot-${i}`);
    dot.classList.toggle('filled', i < pinVal.length);
    dot.classList.remove('error');
  }
}

function checkPin() {
  if (pinVal === currentUser.pass) {
    loginSuccess();
  } else {
    for (let i = 0; i < 4; i++) {
      document.getElementById(`dot-${i}`).classList.add('error');
    }
    showError('PIN incorrecto. Inténtalo de nuevo.');
    setTimeout(() => { pinReset(); }, 900);
  }
}

// ── PASSWORD ──
function toggleEye() {
  const input = document.getElementById('pass-input');
  const btn = document.getElementById('eye-btn');
  if (input.type === 'password') {
    input.type = 'text';
    btn.textContent = '🙈';
  } else {
    input.type = 'password';
    btn.textContent = '👁️';
  }
}

function loginPass() {
  const val = document.getElementById('pass-input').value;
  const btn = document.querySelector('#pass-mode .btn-login');
  if (!val) { showError('Escribe tu contraseña'); return; }
  btn.classList.add('loading');
  setTimeout(() => {
    btn.classList.remove('loading');
    if (val === currentUser.pass) {
      loginSuccess();
    } else {
      showError('Contraseña incorrecta');
    }
  }, 900);
}

// ── SUCCESS ──
function loginSuccess() {
  const overlay = document.getElementById('success-overlay');
  document.getElementById('success-name').textContent =
    `¡Hola, ${currentUser.name.split(' ')[0]}!`;
  overlay.classList.add('show');
  setTimeout(() => {
    document.getElementById('progress-fill').style.width = '100%';
  }, 100);
  setTimeout(() => {
    // redirect simulation — replace with real redirect
    overlay.style.opacity = '0.85';
  }, 2200);
}

// ── ERROR ──
function showError(msg) {
  const el = document.getElementById('error-msg');
  document.getElementById('error-text').textContent = msg;
  el.classList.add('show');
}

function hideError() {
  document.getElementById('error-msg').classList.remove('show');
}

// keyboard support
document.addEventListener('keydown', e => {
  if (loginMode !== 'pin') return;
  if (e.key >= '0' && e.key <= '9') pinKey(e.key);
  if (e.key === 'Backspace') pinDel();
  if (e.key === 'Escape') pinClear();
});
</script>
</body>
</html>