<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dulce & Co — POS</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --cream: #FDF6EE;
    --blush: #F9E8D9;
    --rose: #E8A89C;
    --berry: #C96B7A;
    --dark: #3D1F2A;
    --chocolate: #6B3A4A;
    --mint: #8BBFAD;
    --mint-light: #D4EDE6;
    --gold: #D4A853;
    --gold-light: #F7EDD5;
    --shadow: 0 4px 24px rgba(61,31,42,0.10);
    --shadow-lg: 0 8px 40px rgba(61,31,42,0.16);
    --radius: 18px;
    --radius-sm: 10px;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--cream);
    color: var(--dark);
    height: 100vh;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }

  /* HEADER */
  .header {
    background: var(--dark);
    padding: 0 28px;
    height: 62px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
  }
  .header-logo {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    color: var(--cream);
    letter-spacing: 0.02em;
  }
  .header-logo span { color: var(--rose); font-style: italic; }
  .header-info {
    display: flex;
    align-items: center;
    gap: 20px;
  }
  .header-time {
    font-size: 13px;
    color: rgba(253,246,238,0.6);
    font-weight: 300;
  }
  #clock { color: var(--gold); font-weight: 600; font-size: 15px; }
  .cashier-badge {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 13px;
    color: var(--cream);
  }

  /* MAIN LAYOUT */
  .main {
    display: grid;
    grid-template-columns: 1fr 380px;
    flex: 1;
    overflow: hidden;
    gap: 0;
  }

  /* LEFT PANEL */
  .left-panel {
    display: flex;
    flex-direction: column;
    overflow: hidden;
    padding: 20px 20px 20px 24px;
    gap: 16px;
  }

  /* MESA BAR */
  .mesa-bar {
    display: flex;
    gap: 8px;
    align-items: center;
    flex-shrink: 0;
  }
  .mesa-label {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--chocolate);
    margin-right: 4px;
  }
  .mesa-btn {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    border: 2px solid transparent;
    background: white;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: var(--chocolate);
    cursor: pointer;
    transition: all 0.18s;
    box-shadow: 0 2px 8px rgba(61,31,42,0.08);
  }
  .mesa-btn:hover { border-color: var(--rose); }
  .mesa-btn.active {
    background: var(--dark);
    color: white;
    border-color: var(--dark);
    box-shadow: 0 4px 12px rgba(61,31,42,0.25);
  }
  .mesa-btn.ocupada {
    background: var(--gold-light);
    border-color: var(--gold);
    color: var(--chocolate);
  }
  .mesa-add {
    width: 44px; height: 44px;
    border-radius: 12px;
    border: 2px dashed var(--rose);
    background: transparent;
    color: var(--rose);
    font-size: 20px;
    cursor: pointer;
    transition: all 0.18s;
    display: flex; align-items: center; justify-content: center;
  }
  .mesa-add:hover { background: var(--blush); }

  /* CATEGORÍAS */
  .cat-bar {
    display: flex;
    gap: 8px;
    flex-shrink: 0;
    overflow-x: auto;
    padding-bottom: 2px;
  }
  .cat-bar::-webkit-scrollbar { height: 0; }
  .cat-btn {
    padding: 8px 18px;
    border-radius: 22px;
    border: none;
    background: white;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 500;
    color: var(--chocolate);
    cursor: pointer;
    transition: all 0.18s;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(61,31,42,0.07);
  }
  .cat-btn:hover { background: var(--blush); }
  .cat-btn.active {
    background: var(--berry);
    color: white;
    box-shadow: 0 4px 14px rgba(201,107,122,0.35);
  }
  .cat-emoji { margin-right: 5px; }

  /* BUSCADOR */
  .search-wrap {
    position: relative;
    flex-shrink: 0;
  }
  .search-wrap input {
    width: 100%;
    padding: 11px 16px 11px 42px;
    border-radius: var(--radius-sm);
    border: 1.5px solid rgba(61,31,42,0.1);
    background: white;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    color: var(--dark);
    outline: none;
    transition: border-color 0.2s;
  }
  .search-wrap input:focus { border-color: var(--rose); }
  .search-wrap input::placeholder { color: rgba(61,31,42,0.35); }
  .search-icon {
    position: absolute;
    left: 14px; top: 50%;
    transform: translateY(-50%);
    font-size: 16px; opacity: 0.4;
  }

  /* PRODUCTOS GRID */
  .products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 12px;
    overflow-y: auto;
    padding-right: 4px;
    align-content: start;
  }
  .products-grid::-webkit-scrollbar { width: 4px; }
  .products-grid::-webkit-scrollbar-track { background: transparent; }
  .products-grid::-webkit-scrollbar-thumb { background: var(--rose); border-radius: 4px; }

  .product-card {
    background: white;
    border-radius: var(--radius);
    padding: 16px 14px 14px;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: var(--shadow);
    border: 2px solid transparent;
    display: flex;
    flex-direction: column;
    gap: 8px;
    position: relative;
    overflow: hidden;
  }
  .product-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--rose), var(--berry));
    opacity: 0;
    transition: opacity 0.2s;
  }
  .product-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-lg);
    border-color: var(--blush);
  }
  .product-card:hover::before { opacity: 1; }
  .product-card:active { transform: translateY(0); }
  .product-emoji {
    font-size: 36px;
    text-align: center;
    line-height: 1;
  }
  .product-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--dark);
    text-align: center;
    line-height: 1.3;
  }
  .product-price {
    font-family: 'Playfair Display', serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--berry);
    text-align: center;
  }
  .product-tag {
    position: absolute;
    top: 10px; right: 10px;
    background: var(--gold-light);
    color: var(--gold);
    font-size: 10px;
    font-weight: 600;
    padding: 2px 7px;
    border-radius: 6px;
    letter-spacing: 0.04em;
  }

  /* RIGHT PANEL — TICKET */
  .right-panel {
    background: white;
    display: flex;
    flex-direction: column;
    border-left: 1px solid rgba(61,31,42,0.07);
    overflow: hidden;
  }

  .ticket-header {
    padding: 18px 20px 14px;
    border-bottom: 1px solid rgba(61,31,42,0.07);
    flex-shrink: 0;
  }
  .ticket-title {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    color: var(--dark);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .ticket-mesa-badge {
    background: var(--dark);
    color: var(--cream);
    font-family: 'DM Sans', sans-serif;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 20px;
  }
  .ticket-meta {
    font-size: 12px;
    color: rgba(61,31,42,0.45);
    margin-top: 4px;
  }

  /* ITEMS LIST */
  .ticket-items {
    flex: 1;
    overflow-y: auto;
    padding: 12px 20px;
  }
  .ticket-items::-webkit-scrollbar { width: 3px; }
  .ticket-items::-webkit-scrollbar-thumb { background: var(--rose); border-radius: 3px; }

  .empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    gap: 10px;
    opacity: 0.4;
  }
  .empty-state-icon { font-size: 48px; }
  .empty-state-text { font-size: 14px; color: var(--chocolate); text-align: center; }

  .ticket-item {
    display: grid;
    grid-template-columns: 1fr auto;
    align-items: center;
    gap: 8px;
    padding: 10px 0;
    border-bottom: 1px dashed rgba(61,31,42,0.08);
    animation: slideIn 0.2s ease;
  }
  @keyframes slideIn {
    from { opacity: 0; transform: translateX(10px); }
    to { opacity: 1; transform: translateX(0); }
  }
  .item-info { display: flex; align-items: center; gap: 8px; }
  .item-emoji { font-size: 20px; }
  .item-details { flex: 1; }
  .item-name { font-size: 13px; font-weight: 600; color: var(--dark); }
  .item-unit { font-size: 11px; color: rgba(61,31,42,0.45); }
  .item-controls { display: flex; align-items: center; gap: 6px; }
  .qty-btn {
    width: 26px; height: 26px;
    border-radius: 8px;
    border: 1.5px solid rgba(61,31,42,0.12);
    background: var(--cream);
    font-size: 15px;
    font-weight: 700;
    color: var(--dark);
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.15s;
    line-height: 1;
  }
  .qty-btn:hover { background: var(--blush); border-color: var(--rose); }
  .qty-btn.minus:hover { background: #FFE5E5; border-color: #E88; color: #c44; }
  .qty-num {
    font-size: 14px;
    font-weight: 700;
    color: var(--dark);
    min-width: 20px;
    text-align: center;
  }
  .item-total {
    font-family: 'Playfair Display', serif;
    font-size: 15px;
    font-weight: 700;
    color: var(--berry);
    min-width: 68px;
    text-align: right;
  }

  /* DESCUENTO */
  .discount-section {
    padding: 12px 20px;
    border-top: 1px solid rgba(61,31,42,0.07);
    flex-shrink: 0;
  }
  .discount-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 500;
    color: var(--chocolate);
    cursor: pointer;
    margin-bottom: 8px;
  }
  .discount-toggle span { font-size: 16px; }
  .discount-row {
    display: flex;
    gap: 8px;
  }
  .discount-input {
    flex: 1;
    padding: 8px 12px;
    border-radius: var(--radius-sm);
    border: 1.5px solid rgba(61,31,42,0.12);
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    color: var(--dark);
    outline: none;
    transition: border-color 0.2s;
    background: var(--cream);
  }
  .discount-input:focus { border-color: var(--rose); }
  .discount-type {
    display: flex;
    border-radius: var(--radius-sm);
    overflow: hidden;
    border: 1.5px solid rgba(61,31,42,0.12);
  }
  .discount-type button {
    padding: 0 14px;
    border: none;
    background: white;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: var(--chocolate);
    cursor: pointer;
    transition: all 0.15s;
  }
  .discount-type button.active {
    background: var(--berry);
    color: white;
  }
  .discount-apply {
    padding: 8px 16px;
    border-radius: var(--radius-sm);
    border: none;
    background: var(--dark);
    color: white;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.18s;
  }
  .discount-apply:hover { background: var(--berry); }

  /* TOTALES */
  .totals {
    padding: 14px 20px;
    border-top: 1px solid rgba(61,31,42,0.07);
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    gap: 6px;
  }
  .total-row {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: rgba(61,31,42,0.55);
  }
  .total-row.discount-row-display { color: var(--mint); }
  .total-row.grand {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 700;
    color: var(--dark);
    padding-top: 6px;
    border-top: 2px solid rgba(61,31,42,0.08);
    margin-top: 2px;
  }

  /* ACCIONES */
  .actions {
    padding: 14px 20px 20px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex-shrink: 0;
  }
  .btn-cobrar {
    padding: 15px;
    border-radius: var(--radius);
    border: none;
    background: linear-gradient(135deg, var(--berry), #B5546A);
    color: white;
    font-family: 'Playfair Display', serif;
    font-size: 17px;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 6px 20px rgba(201,107,122,0.4);
    letter-spacing: 0.02em;
  }
  .btn-cobrar:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(201,107,122,0.5);
  }
  .btn-cobrar:active { transform: translateY(0); }
  .btn-row { display: flex; gap: 8px; }
  .btn-secondary {
    flex: 1;
    padding: 11px;
    border-radius: var(--radius-sm);
    border: 1.5px solid rgba(61,31,42,0.12);
    background: white;
    color: var(--dark);
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.18s;
    display: flex; align-items: center; justify-content: center; gap: 5px;
  }
  .btn-secondary:hover { background: var(--blush); border-color: var(--rose); }
  .btn-clear {
    flex: 1;
    padding: 11px;
    border-radius: var(--radius-sm);
    border: 1.5px solid rgba(200,60,60,0.18);
    background: white;
    color: #C44;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.18s;
    display: flex; align-items: center; justify-content: center; gap: 5px;
  }
  .btn-clear:hover { background: #FFF0F0; border-color: #E88; }

  /* MODAL COBRO */
  .modal-overlay {
    position: fixed; inset: 0;
    background: rgba(61,31,42,0.55);
    backdrop-filter: blur(4px);
    display: flex; align-items: center; justify-content: center;
    z-index: 100;
    opacity: 0; pointer-events: none;
    transition: opacity 0.25s;
  }
  .modal-overlay.show { opacity: 1; pointer-events: all; }
  .modal {
    background: white;
    border-radius: 24px;
    padding: 32px 28px;
    width: 360px;
    box-shadow: 0 24px 80px rgba(61,31,42,0.3);
    transform: translateY(20px);
    transition: transform 0.25s;
  }
  .modal-overlay.show .modal { transform: translateY(0); }
  .modal-title {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    color: var(--dark);
    margin-bottom: 6px;
  }
  .modal-sub {
    font-size: 13px;
    color: rgba(61,31,42,0.5);
    margin-bottom: 22px;
  }
  .modal-total-display {
    background: var(--cream);
    border-radius: var(--radius);
    padding: 16px 20px;
    text-align: center;
    margin-bottom: 20px;
  }
  .modal-total-display .label { font-size: 12px; color: rgba(61,31,42,0.5); margin-bottom: 4px; }
  .modal-total-display .amount {
    font-family: 'Playfair Display', serif;
    font-size: 32px;
    font-weight: 700;
    color: var(--berry);
  }
  .payment-methods {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 8px;
    margin-bottom: 20px;
  }
  .pay-btn {
    padding: 14px 8px;
    border-radius: var(--radius-sm);
    border: 2px solid rgba(61,31,42,0.1);
    background: white;
    cursor: pointer;
    transition: all 0.18s;
    font-family: 'DM Sans', sans-serif;
    font-size: 12px;
    font-weight: 600;
    color: var(--dark);
    display: flex; flex-direction: column; align-items: center; gap: 5px;
  }
  .pay-btn .pay-icon { font-size: 24px; }
  .pay-btn:hover { border-color: var(--rose); background: var(--blush); }
  .pay-btn.selected { border-color: var(--berry); background: #FDF0F2; color: var(--berry); }
  .cash-section { margin-bottom: 20px; }
  .cash-label { font-size: 12px; font-weight: 600; color: var(--chocolate); margin-bottom: 8px; letter-spacing: 0.04em; text-transform: uppercase; }
  .cash-input-wrap { position: relative; }
  .cash-input-wrap input {
    width: 100%;
    padding: 12px 16px 12px 32px;
    border-radius: var(--radius-sm);
    border: 2px solid rgba(61,31,42,0.12);
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--dark);
    outline: none;
    transition: border-color 0.2s;
    background: var(--cream);
  }
  .cash-input-wrap input:focus { border-color: var(--rose); }
  .cash-prefix {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    font-weight: 700;
    color: rgba(61,31,42,0.4);
  }
  .cambio-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--mint-light);
    border-radius: var(--radius-sm);
    padding: 10px 14px;
    margin-top: 8px;
  }
  .cambio-label { font-size: 13px; font-weight: 600; color: var(--mint); }
  .cambio-amount {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    font-weight: 700;
    color: #5A9E8A;
  }
  .modal-actions { display: flex; gap: 10px; }
  .btn-cancel {
    flex: 1;
    padding: 13px;
    border-radius: var(--radius-sm);
    border: 1.5px solid rgba(61,31,42,0.12);
    background: white;
    color: var(--chocolate);
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.18s;
  }
  .btn-cancel:hover { background: var(--blush); }
  .btn-confirm {
    flex: 2;
    padding: 13px;
    border-radius: var(--radius-sm);
    border: none;
    background: linear-gradient(135deg, var(--berry), #B5546A);
    color: white;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 16px rgba(201,107,122,0.35);
  }
  .btn-confirm:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(201,107,122,0.45); }

  /* TOAST */
  .toast {
    position: fixed;
    bottom: 30px; left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: var(--dark);
    color: white;
    padding: 12px 24px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 500;
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    z-index: 200;
    white-space: nowrap;
  }
  .toast.show { transform: translateX(-50%) translateY(0); }
  .toast.success { background: #5A9E8A; }
  .toast.error { background: #C44; }

  /* NOTA EN ITEM */
  .item-note-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 13px;
    opacity: 0.4;
    transition: opacity 0.15s;
    padding: 0;
  }
  .item-note-btn:hover { opacity: 1; }
</style>
</head>
<body>

<!-- HEADER -->
<header class="header">
  <div class="header-logo">Dulce <span>&</span> Co</div>
  <div class="header-info">
    <div class="header-time">Mesa activa: <span id="mesa-actual">1</span> &nbsp;|&nbsp; <span id="clock"></span></div>
    <div class="cashier-badge">👩‍💼 Cajera</div>
  </div>
</header>

<!-- MAIN -->
<div class="main">

  <!-- LEFT: PRODUCTOS -->
  <div class="left-panel">

    <!-- MESAS -->
    <div class="mesa-bar">
      <span class="mesa-label">Mesas</span>
      <button class="mesa-btn active" onclick="seleccionarMesa(1, this)">1</button>
      <button class="mesa-btn" onclick="seleccionarMesa(2, this)">2</button>
      <button class="mesa-btn" onclick="seleccionarMesa(3, this)">3</button>
      <button class="mesa-btn" onclick="seleccionarMesa(4, this)">4</button>
      <button class="mesa-btn" onclick="seleccionarMesa(5, this)">5</button>
      <button class="mesa-btn" onclick="seleccionarMesa(6, this)">6</button>
      <button class="mesa-btn" onclick="seleccionarMesa(7, this)">7</button>
      <button class="mesa-btn" onclick="seleccionarMesa(8, this)">8</button>
      <button class="mesa-add" onclick="agregarMesa()">＋</button>
    </div>

    <!-- CATEGORÍAS -->
    <div class="cat-bar">
      <button class="cat-btn active" onclick="filtrarCat('todos', this)"><span class="cat-emoji">🌸</span>Todo</button>
      <button class="cat-btn" onclick="filtrarCat('crepas', this)"><span class="cat-emoji">🫔</span>Crepas</button>
      <button class="cat-btn" onclick="filtrarCat('fresas', this)"><span class="cat-emoji">🍓</span>Fresas</button>
      <button class="cat-btn" onclick="filtrarCat('helados', this)"><span class="cat-emoji">🍦</span>Helados</button>
      <button class="cat-btn" onclick="filtrarCat('bebidas', this)"><span class="cat-emoji">🥤</span>Bebidas</button>
      <button class="cat-btn" onclick="filtrarCat('waffles', this)"><span class="cat-emoji">🧇</span>Waffles</button>
      <button class="cat-btn" onclick="filtrarCat('postres', this)"><span class="cat-emoji">🍮</span>Postres</button>
    </div>

    <!-- BÚSQUEDA -->
    <div class="search-wrap">
      <span class="search-icon">🔍</span>
      <input type="text" placeholder="Buscar producto..." oninput="buscarProducto(this.value)" />
    </div>

    <!-- GRID -->
    <div class="products-grid" id="products-grid"></div>
  </div>

  <!-- RIGHT: TICKET -->
  <div class="right-panel">
    <div class="ticket-header">
      <div class="ticket-title">
        Pedido
        <span class="ticket-mesa-badge" id="ticket-mesa-badge">Mesa 1</span>
      </div>
      <div class="ticket-meta" id="ticket-hora">—</div>
    </div>

    <div class="ticket-items" id="ticket-items">
      <div class="empty-state" id="empty-state">
        <div class="empty-state-icon">🍰</div>
        <div class="empty-state-text">Agrega productos<br>al pedido</div>
      </div>
    </div>

    <!-- DESCUENTO -->
    <div class="discount-section">
      <div class="discount-toggle" onclick="toggleDescuento()">
        <span id="desc-arrow">▸</span> Aplicar descuento
      </div>
      <div id="descuento-panel" style="display:none">
        <div class="discount-row">
          <input class="discount-input" id="desc-valor" type="number" placeholder="10" min="0" />
          <div class="discount-type">
            <button id="btn-pct" class="active" onclick="tipodesc('pct')">%</button>
            <button id="btn-monto" onclick="tipodesc('monto')">$</button>
          </div>
          <button class="discount-apply" onclick="aplicarDescuento()">✓</button>
        </div>
      </div>
    </div>

    <!-- TOTALES -->
    <div class="totals" id="totals-section">
      <div class="total-row"><span>Subtotal</span><span id="subtotal-val">$0.00</span></div>
      <div class="total-row discount-row-display" id="desc-row" style="display:none"><span>🏷 Descuento</span><span id="desc-display">-$0.00</span></div>
      <div class="total-row grand"><span>Total</span><span id="total-val">$0.00</span></div>
    </div>

    <!-- ACCIONES -->
    <div class="actions">
      <button class="btn-cobrar" onclick="abrirModalCobro()">💳 Cobrar</button>
      <div class="btn-row">
        <button class="btn-secondary" onclick="imprimirTicket()">🖨️ Ticket</button>
        <button class="btn-secondary" onclick="nuevoPedido()">📋 Nuevo</button>
        <button class="btn-clear" onclick="limpiarPedido()">🗑️ Vaciar</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL COBRO -->
<div class="modal-overlay" id="modal-cobro">
  <div class="modal">
    <div class="modal-title">Cobrar pedido</div>
    <div class="modal-sub" id="modal-sub-mesa">Mesa 1</div>
    <div class="modal-total-display">
      <div class="label">Total a cobrar</div>
      <div class="amount" id="modal-total-amount">$0.00</div>
    </div>
    <div class="payment-methods">
      <button class="pay-btn selected" id="pay-efectivo" onclick="selectPago('efectivo')">
        <span class="pay-icon">💵</span>Efectivo
      </button>
      <button class="pay-btn" id="pay-tarjeta" onclick="selectPago('tarjeta')">
        <span class="pay-icon">💳</span>Tarjeta
      </button>
      <button class="pay-btn" id="pay-transferencia" onclick="selectPago('transferencia')">
        <span class="pay-icon">📲</span>Transf.
      </button>
    </div>
    <div class="cash-section" id="cash-section">
      <div class="cash-label">Pago con</div>
      <div class="cash-input-wrap">
        <span class="cash-prefix">$</span>
        <input type="number" id="pago-con" placeholder="0.00" oninput="calcCambio()" />
      </div>
      <div class="cambio-row" id="cambio-row" style="display:none">
        <span class="cambio-label">💚 Cambio</span>
        <span class="cambio-amount" id="cambio-val">$0.00</span>
      </div>
    </div>
    <div class="modal-actions">
      <button class="btn-cancel" onclick="cerrarModal()">Cancelar</button>
      <button class="btn-confirm" onclick="confirmarCobro()">✓ Confirmar cobro</button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<script>
// ==================== PRODUCTOS ====================
const PRODUCTOS = [
  { id:1, nombre:"Crepa Nutella", precio:65, emoji:"🫔", cat:"crepas", tag:"Popular" },
  { id:2, nombre:"Crepa Fresa", precio:60, emoji:"🍓", cat:"crepas" },
  { id:3, nombre:"Crepa Cajeta", precio:62, emoji:"🤎", cat:"crepas", tag:"Especial" },
  { id:4, nombre:"Crepa Mango", precio:60, emoji:"🥭", cat:"crepas" },
  { id:5, nombre:"Crepa Oreo", precio:68, emoji:"🍪", cat:"crepas", tag:"Nuevo" },
  { id:6, nombre:"Fresas c/Crema", precio:55, emoji:"🍓", cat:"fresas", tag:"Popular" },
  { id:7, nombre:"Fresas Nutella", precio:65, emoji:"🫶", cat:"fresas" },
  { id:8, nombre:"Fresas Coco", precio:58, emoji:"🥥", cat:"fresas" },
  { id:9, nombre:"Sundae Vainilla", precio:45, emoji:"🍦", cat:"helados" },
  { id:10, nombre:"Sundae Chocolate", precio:48, emoji:"🍫", cat:"helados", tag:"Popular" },
  { id:11, nombre:"Malteada Fresa", precio:70, emoji:"🥤", cat:"bebidas" },
  { id:12, nombre:"Malteada Vainilla", precio:70, emoji:"🍼", cat:"bebidas" },
  { id:13, nombre:"Café Frappé", precio:55, emoji:"☕", cat:"bebidas" },
  { id:14, nombre:"Waffle Clásico", precio:72, emoji:"🧇", cat:"waffles", tag:"Nuevo" },
  { id:15, nombre:"Waffle Nutella", precio:80, emoji:"💛", cat:"waffles" },
  { id:16, nombre:"Waffle Frutas", precio:78, emoji:"🍑", cat:"waffles" },
  { id:17, nombre:"Brownie", precio:40, emoji:"🍫", cat:"postres" },
  { id:18, nombre:"Cheesecake", precio:65, emoji:"🍰", cat:"postres", tag:"Especial" },
  { id:19, nombre:"Pastel 3 Leches", precio:60, emoji:"🎂", cat:"postres" },
  { id:20, nombre:"Churros", precio:35, emoji:"🍩", cat:"postres" },
  { id:21, nombre:"Agua Fresca", precio:25, emoji:"🧃", cat:"bebidas" },
  { id:22, nombre:"Crepa Frutas", precio:70, emoji:"🍇", cat:"crepas" },
];

// ==================== ESTADO ====================
let mesaActiva = 1;
let pedidos = {}; // { mesaNum: { items: [], descuento: {tipo, valor} } }
let descTipo = 'pct';
let metodoPago = 'efectivo';
let mesasTotal = 8;

function getPedido() {
  if (!pedidos[mesaActiva]) pedidos[mesaActiva] = { items: [], descuento: null };
  return pedidos[mesaActiva];
}

// ==================== RELOJ ====================
function actualizarReloj() {
  const now = new Date();
  const h = String(now.getHours()).padStart(2,'0');
  const m = String(now.getMinutes()).padStart(2,'0');
  const s = String(now.getSeconds()).padStart(2,'0');
  document.getElementById('clock').textContent = `${h}:${m}:${s}`;
}
setInterval(actualizarReloj, 1000);
actualizarReloj();

// ==================== RENDER PRODUCTOS ====================
let catActiva = 'todos';
let busqueda = '';

function renderProductos() {
  const grid = document.getElementById('products-grid');
  let lista = PRODUCTOS;
  if (catActiva !== 'todos') lista = lista.filter(p => p.cat === catActiva);
  if (busqueda) lista = lista.filter(p => p.nombre.toLowerCase().includes(busqueda.toLowerCase()));

  grid.innerHTML = lista.map(p => `
    <div class="product-card" onclick="agregarProducto(${p.id})">
      ${p.tag ? `<div class="product-tag">${p.tag}</div>` : ''}
      <div class="product-emoji">${p.emoji}</div>
      <div class="product-name">${p.nombre}</div>
      <div class="product-price">$${p.precio.toFixed(2)}</div>
    </div>
  `).join('');
}

function filtrarCat(cat, btn) {
  catActiva = cat;
  document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  renderProductos();
}

function buscarProducto(val) {
  busqueda = val;
  renderProductos();
}

// ==================== PEDIDO ====================
function agregarProducto(id) {
  const prod = PRODUCTOS.find(p => p.id === id);
  const pedido = getPedido();
  const existing = pedido.items.find(i => i.id === id);
  if (existing) {
    existing.qty++;
  } else {
    pedido.items.push({ ...prod, qty: 1 });
  }
  if (!pedidos[mesaActiva].hora) {
    pedidos[mesaActiva].hora = new Date();
    marcarMesaOcupada(mesaActiva);
  }
  renderTicket();
  showToast(`${prod.emoji} ${prod.nombre} agregado`, 'success');
}

function cambiarQty(id, delta) {
  const pedido = getPedido();
  const idx = pedido.items.findIndex(i => i.id === id);
  if (idx < 0) return;
  pedido.items[idx].qty += delta;
  if (pedido.items[idx].qty <= 0) pedido.items.splice(idx, 1);
  renderTicket();
}

function renderTicket() {
  const pedido = getPedido();
  const container = document.getElementById('ticket-items');
  const emptyState = document.getElementById('empty-state');

  if (!pedido.items.length) {
    container.innerHTML = `<div class="empty-state" id="empty-state">
      <div class="empty-state-icon">🍰</div>
      <div class="empty-state-text">Agrega productos<br>al pedido</div>
    </div>`;
    actualizarTotales(0, 0, 0);
    document.getElementById('ticket-hora').textContent = '—';
    return;
  }

  container.innerHTML = pedido.items.map(item => `
    <div class="ticket-item">
      <div class="item-info">
        <span class="item-emoji">${item.emoji}</span>
        <div class="item-details">
          <div class="item-name">${item.nombre}</div>
          <div class="item-unit">$${item.precio.toFixed(2)} c/u</div>
        </div>
      </div>
      <div style="display:flex;align-items:center;gap:8px">
        <div class="item-controls">
          <button class="qty-btn minus" onclick="cambiarQty(${item.id}, -1)">−</button>
          <span class="qty-num">${item.qty}</span>
          <button class="qty-btn" onclick="cambiarQty(${item.id}, 1)">+</button>
        </div>
        <div class="item-total">$${(item.precio * item.qty).toFixed(2)}</div>
      </div>
    </div>
  `).join('');

  // Hora
  if (pedido.hora) {
    const h = pedido.hora;
    document.getElementById('ticket-hora').textContent =
      `Pedido a las ${String(h.getHours()).padStart(2,'0')}:${String(h.getMinutes()).padStart(2,'0')}`;
  }

  // Totales
  const subtotal = pedido.items.reduce((s, i) => s + i.precio * i.qty, 0);
  let descuento = 0;
  if (pedido.descuento) {
    if (pedido.descuento.tipo === 'pct') {
      descuento = subtotal * (pedido.descuento.valor / 100);
    } else {
      descuento = pedido.descuento.valor;
    }
    descuento = Math.min(descuento, subtotal);
  }
  const total = subtotal - descuento;
  actualizarTotales(subtotal, descuento, total);
}

function actualizarTotales(subtotal, descuento, total) {
  document.getElementById('subtotal-val').textContent = `$${subtotal.toFixed(2)}`;
  document.getElementById('total-val').textContent = `$${total.toFixed(2)}`;
  const descRow = document.getElementById('desc-row');
  if (descuento > 0) {
    descRow.style.display = 'flex';
    document.getElementById('desc-display').textContent = `-$${descuento.toFixed(2)}`;
  } else {
    descRow.style.display = 'none';
  }
}

// ==================== MESAS ====================
function seleccionarMesa(num, btn) {
  mesaActiva = num;
  document.querySelectorAll('.mesa-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('mesa-actual').textContent = num;
  document.getElementById('ticket-mesa-badge').textContent = `Mesa ${num}`;
  document.getElementById('modal-sub-mesa').textContent = `Mesa ${num}`;
  renderTicket();
}

function marcarMesaOcupada(num) {
  document.querySelectorAll('.mesa-btn').forEach(b => {
    if (b.textContent === String(num)) b.classList.add('ocupada');
  });
}

function agregarMesa() {
  mesasTotal++;
  const bar = document.querySelector('.mesa-bar');
  const btn = document.createElement('button');
  btn.className = 'mesa-btn';
  btn.textContent = mesasTotal;
  btn.onclick = function() { seleccionarMesa(mesasTotal, this); };
  bar.insertBefore(btn, bar.querySelector('.mesa-add'));
  showToast(`Mesa ${mesasTotal} agregada`);
}

// ==================== DESCUENTO ====================
function toggleDescuento() {
  const panel = document.getElementById('descuento-panel');
  const arrow = document.getElementById('desc-arrow');
  if (panel.style.display === 'none') {
    panel.style.display = 'flex';
    arrow.textContent = '▾';
  } else {
    panel.style.display = 'none';
    arrow.textContent = '▸';
  }
}

function tipodesc(tipo) {
  descTipo = tipo;
  document.getElementById('btn-pct').classList.toggle('active', tipo === 'pct');
  document.getElementById('btn-monto').classList.toggle('active', tipo === 'monto');
}

function aplicarDescuento() {
  const val = parseFloat(document.getElementById('desc-valor').value);
  if (!val || val <= 0) { showToast('Ingresa un descuento válido', 'error'); return; }
  getPedido().descuento = { tipo: descTipo, valor: val };
  renderTicket();
  showToast(`Descuento aplicado ✓`, 'success');
}

// ==================== MODAL COBRO ====================
function abrirModalCobro() {
  const pedido = getPedido();
  if (!pedido.items.length) { showToast('El pedido está vacío', 'error'); return; }
  const total = calcTotal();
  document.getElementById('modal-total-amount').textContent = `$${total.toFixed(2)}`;
  document.getElementById('modal-cobro').classList.add('show');
  document.getElementById('pago-con').value = '';
  document.getElementById('cambio-row').style.display = 'none';
}

function cerrarModal() {
  document.getElementById('modal-cobro').classList.remove('show');
}

function selectPago(tipo) {
  metodoPago = tipo;
  ['efectivo','tarjeta','transferencia'].forEach(t => {
    document.getElementById(`pay-${t}`).classList.toggle('selected', t === tipo);
  });
  document.getElementById('cash-section').style.display = tipo === 'efectivo' ? 'block' : 'none';
}

function calcCambio() {
  const total = calcTotal();
  const pagoCon = parseFloat(document.getElementById('pago-con').value) || 0;
  const cambioRow = document.getElementById('cambio-row');
  if (pagoCon >= total) {
    cambioRow.style.display = 'flex';
    document.getElementById('cambio-val').textContent = `$${(pagoCon - total).toFixed(2)}`;
  } else {
    cambioRow.style.display = 'none';
  }
}

function confirmarCobro() {
  if (metodoPago === 'efectivo') {
    const total = calcTotal();
    const pagoCon = parseFloat(document.getElementById('pago-con').value) || 0;
    if (pagoCon < total) { showToast('El pago es insuficiente', 'error'); return; }
  }
  cerrarModal();
  // Limpiar mesa
  pedidos[mesaActiva] = { items: [], descuento: null };
  document.querySelectorAll('.mesa-btn').forEach(b => {
    if (b.textContent === String(mesaActiva)) b.classList.remove('ocupada');
  });
  renderTicket();
  showToast(`✅ Cobro exitoso · Mesa ${mesaActiva}`, 'success');
}

function calcTotal() {
  const pedido = getPedido();
  const subtotal = pedido.items.reduce((s, i) => s + i.precio * i.qty, 0);
  let descuento = 0;
  if (pedido.descuento) {
    if (pedido.descuento.tipo === 'pct') descuento = subtotal * (pedido.descuento.valor / 100);
    else descuento = pedido.descuento.valor;
    descuento = Math.min(descuento, subtotal);
  }
  return subtotal - descuento;
}

// ==================== OTROS ====================
function limpiarPedido() {
  if (!getPedido().items.length) return;
  pedidos[mesaActiva] = { items: [], descuento: null };
  document.querySelectorAll('.mesa-btn').forEach(b => {
    if (b.textContent === String(mesaActiva)) b.classList.remove('ocupada');
  });
  renderTicket();
  showToast('Pedido vaciado');
}

function nuevoPedido() {
  limpiarPedido();
}

function imprimirTicket() {
  const pedido = getPedido();
  if (!pedido.items.length) { showToast('El pedido está vacío', 'error'); return; }
  showToast('🖨️ Enviando a impresora...', 'success');
}

function showToast(msg, tipo = '') {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = `toast show ${tipo}`;
  setTimeout(() => t.className = 'toast', 2500);
}

// ==================== INIT ====================
renderProductos();
</script>
</body>
</html>