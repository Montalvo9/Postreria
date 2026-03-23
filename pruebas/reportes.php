<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dulce & Co — Reportes</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
    min-height: 100vh;
    display: flex;
    flex-direction: column;
  }

  /* ══════════ HEADER ══════════ */
  .header {
    background: var(--dark);
    padding: 0 28px;
    height: 62px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
  }
  .header-left { display: flex; align-items: center; gap: 28px; }
  .header-logo {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    color: var(--cream);
    letter-spacing: 0.02em;
  }
  .header-logo span { color: var(--rose); font-style: italic; }
  .header-nav {
    display: flex;
    gap: 6px;
  }
  .nav-link {
    padding: 7px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 500;
    color: rgba(253,246,238,0.55);
    text-decoration: none;
    transition: all 0.18s;
    border: 1px solid transparent;
  }
  .nav-link:hover { color: var(--cream); background: rgba(255,255,255,0.06); }
  .nav-link.active {
    color: var(--cream);
    background: rgba(255,255,255,0.08);
    border-color: rgba(255,255,255,0.12);
  }
  .header-right {
    display: flex;
    align-items: center;
    gap: 16px;
  }
  .user-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 14px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 20px;
    font-size: 13px;
    color: var(--cream);
  }

  /* ══════════ MAIN CONTAINER ══════════ */
  .container {
    flex: 1;
    padding: 24px 28px;
    overflow-y: auto;
  }
  .container::-webkit-scrollbar { width: 6px; }
  .container::-webkit-scrollbar-track { background: transparent; }
  .container::-webkit-scrollbar-thumb { background: var(--rose); border-radius: 6px; }

  /* ══════════ PAGE HEADER ══════════ */
  .page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    animation: fadeDown 0.5s ease both;
  }
  @keyframes fadeDown {
    from { opacity: 0; transform: translateY(-14px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .page-title {
    font-family: 'Playfair Display', serif;
    font-size: 32px;
    font-weight: 700;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .page-title .emoji { font-size: 32px; }

  .date-selector {
    display: flex;
    gap: 8px;
    align-items: center;
  }
  .date-btn {
    padding: 9px 16px;
    border-radius: 20px;
    border: 1.5px solid rgba(61,31,42,0.12);
    background: white;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: var(--chocolate);
    cursor: pointer;
    transition: all 0.18s;
  }
  .date-btn:hover { background: var(--blush); border-color: var(--rose); }
  .date-btn.active { background: var(--berry); color: white; border-color: var(--berry); }
  .date-input {
    padding: 9px 14px;
    border-radius: 20px;
    border: 1.5px solid rgba(61,31,42,0.12);
    background: white;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    color: var(--dark);
    outline: none;
  }
  .date-input:focus { border-color: var(--rose); }

  /* ══════════ STATS CARDS ══════════ */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
    animation: fadeDown 0.5s 0.1s ease both;
  }
  .stat-card {
    background: white;
    border-radius: var(--radius);
    padding: 20px 18px;
    box-shadow: var(--shadow);
    display: flex;
    flex-direction: column;
    gap: 8px;
    position: relative;
    overflow: hidden;
    transition: all 0.25s;
  }
  .stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
  }
  .stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
  }
  .stat-card.ventas::before { background: linear-gradient(90deg, var(--berry), #B5546A); }
  .stat-card.pedidos::before { background: linear-gradient(90deg, var(--gold), #C6A644); }
  .stat-card.promedio::before { background: linear-gradient(90deg, var(--mint), #7AAE9C); }
  .stat-card.productos::before { background: linear-gradient(90deg, var(--rose), var(--berry)); }

  .stat-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .stat-icon {
    font-size: 24px;
    opacity: 0.85;
  }
  .stat-trend {
    font-size: 11px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 3px;
  }
  .stat-trend.up { background: var(--mint-light); color: #5A9E8A; }
  .stat-trend.down { background: #FFE5E5; color: #C44; }

  .stat-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: rgba(61,31,42,0.45);
  }
  .stat-value {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    color: var(--dark);
    line-height: 1;
  }
  .stat-meta {
    font-size: 12px;
    color: rgba(61,31,42,0.4);
  }

  /* ══════════ MAIN GRID ══════════ */
  .main-grid {
    display: grid;
    grid-template-columns: 1fr 360px;
    gap: 20px;
    animation: fadeDown 0.5s 0.2s ease both;
  }

  /* ══════════ SALES HISTORY ══════════ */
  .sales-section {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }

  .section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .section-title {
    font-family: 'Playfair Display', serif;
    font-size: 20px;
    font-weight: 700;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .section-title .emoji { font-size: 20px; }
  .section-actions {
    display: flex;
    gap: 6px;
  }
  .action-btn {
    padding: 7px 14px;
    border-radius: 18px;
    border: 1.5px solid rgba(61,31,42,0.12);
    background: white;
    font-size: 12px;
    font-weight: 600;
    color: var(--chocolate);
    cursor: pointer;
    transition: all 0.18s;
    display: flex;
    align-items: center;
    gap: 5px;
  }
  .action-btn:hover { background: var(--blush); border-color: var(--rose); }

  /* SALES TABLE */
  .sales-table-wrap {
    background: white;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }
  .sales-table {
    width: 100%;
    border-collapse: collapse;
  }
  .sales-table thead {
    background: var(--dark);
  }
  .sales-table th {
    text-align: left;
    padding: 12px 16px;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--cream);
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
  .sales-table tbody tr {
    border-bottom: 1px solid rgba(61,31,42,0.06);
    transition: background 0.15s;
  }
  .sales-table tbody tr:hover { background: var(--blush); }
  .sales-table td {
    padding: 14px 16px;
    font-size: 13px;
    color: var(--dark);
  }
  .td-id {
    font-family: 'Courier New', monospace;
    font-size: 12px;
    color: rgba(61,31,42,0.5);
    font-weight: 600;
  }
  .td-time {
    font-size: 12px;
    color: rgba(61,31,42,0.45);
  }
  .td-mesa {
    font-weight: 600;
    color: var(--dark);
  }
  .td-items {
    font-size: 12px;
    color: rgba(61,31,42,0.45);
  }
  .td-total {
    font-family: 'Playfair Display', serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--berry);
  }
  .payment-badge {
    display: inline-block;
    padding: 3px 9px;
    border-radius: 6px;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }
  .payment-efectivo { background: var(--mint-light); color: #5A9E8A; }
  .payment-tarjeta { background: var(--gold-light); color: var(--gold); }
  .payment-transferencia { background: #F0E8FF; color: #8B5CF6; }

  .td-actions-cell {
    display: flex;
    gap: 5px;
  }
  .icon-btn {
    width: 28px;
    height: 28px;
    border-radius: 7px;
    border: 1.5px solid rgba(61,31,42,0.12);
    background: white;
    cursor: pointer;
    transition: all 0.15s;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
  }
  .icon-btn:hover { background: var(--blush); border-color: var(--rose); }
  .icon-btn.delete:hover { background: #FFE5E5; border-color: #E88; }

  /* ══════════ RIGHT SIDEBAR ══════════ */
  .right-sidebar {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  /* TOP PRODUCTS */
  .top-products-card {
    background: white;
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
  }
  .top-products-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 14px;
  }
  .product-row {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px;
    background: var(--cream);
    border-radius: var(--radius-sm);
    transition: all 0.18s;
  }
  .product-row:hover { background: var(--blush); transform: translateX(4px); }
  .product-rank {
    width: 26px;
    height: 26px;
    border-radius: 8px;
    background: var(--dark);
    color: var(--cream);
    font-size: 12px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }
  .product-rank.rank-1 { background: var(--gold); color: var(--dark); }
  .product-rank.rank-2 { background: #C0C0C0; color: var(--dark); }
  .product-rank.rank-3 { background: #CD7F32; color: white; }
  .product-emoji {
    font-size: 22px;
    flex-shrink: 0;
  }
  .product-info {
    flex: 1;
    min-width: 0;
  }
  .product-name {
    font-size: 13px;
    font-weight: 600;
    color: var(--dark);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .product-sales {
    font-size: 11px;
    color: rgba(61,31,42,0.45);
  }
  .product-revenue {
    font-family: 'Playfair Display', serif;
    font-size: 14px;
    font-weight: 700;
    color: var(--berry);
    white-space: nowrap;
  }

  /* PAYMENT METHODS */
  .payment-methods-card {
    background: white;
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
  }
  .payment-grid {
    display: grid;
    gap: 10px;
    margin-top: 14px;
  }
  .payment-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 14px;
    background: var(--cream);
    border-radius: var(--radius-sm);
  }
  .payment-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: var(--dark);
  }
  .payment-icon { font-size: 18px; }
  .payment-amount {
    font-family: 'Playfair Display', serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--berry);
  }

  /* QUICK ACTIONS */
  .quick-actions-card {
    background: white;
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--shadow);
  }
  .action-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 14px;
  }
  .quick-action-btn {
    padding: 14px 12px;
    border-radius: var(--radius-sm);
    border: 1.5px solid rgba(61,31,42,0.12);
    background: var(--cream);
    cursor: pointer;
    transition: all 0.2s;
    text-align: center;
    font-family: 'DM Sans', sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
  }
  .quick-action-btn:hover {
    background: var(--dark);
    border-color: var(--dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(61,31,42,0.25);
  }
  .quick-action-btn:hover .qa-icon { transform: scale(1.1); }
  .quick-action-btn:hover .qa-text { color: white; }
  .qa-icon { font-size: 24px; transition: transform 0.2s; }
  .qa-text {
    font-size: 12px;
    font-weight: 600;
    color: var(--chocolate);
    transition: color 0.2s;
  }

  /* EMPTY STATE */
  .empty-state {
    padding: 60px 20px;
    text-align: center;
    color: rgba(61,31,42,0.35);
  }
  .empty-icon { font-size: 48px; margin-bottom: 12px; }
  .empty-text { font-size: 15px; }

  /* TOAST */
  .toast {
    position: fixed;
    bottom: 30px;
    left: 50%;
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

  /* RESPONSIVE */
  @media (max-width: 1400px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .main-grid { grid-template-columns: 1fr; }
    .right-sidebar { 
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 16px;
    }
  }
</style>
</head>
<body>

<!-- HEADER -->
<header class="header">
  <div class="header-left">
    <div class="header-logo">Dulce <span>&</span> Co</div>
    <nav class="header-nav">
      <a href="#" class="nav-link">🍰 POS</a>
      <a href="#" class="nav-link">📦 Productos</a>
      <a href="#" class="nav-link">👥 Usuarios</a>
      <a href="#" class="nav-link active">📊 Reportes</a>
      <a href="#" class="nav-link">⚙️ Config</a>
    </nav>
  </div>
  <div class="header-right">
    <div class="user-badge">
      <span>👩‍💼</span>
      <span>Ana García</span>
    </div>
  </div>
</header>

<!-- MAIN -->
<div class="container">

  <!-- PAGE HEADER -->
  <div class="page-header">
    <div class="page-title">
      <span class="emoji">📊</span>
      Reportes & Ventas
    </div>
    <div class="date-selector">
      <button class="date-btn active" onclick="setPeriod('hoy', this)">Hoy</button>
      <button class="date-btn" onclick="setPeriod('semana', this)">Semana</button>
      <button class="date-btn" onclick="setPeriod('mes', this)">Mes</button>
      <input type="date" class="date-input" id="date-custom" onchange="setPeriod('custom', this)" />
    </div>
  </div>

  <!-- STATS CARDS -->
  <div class="stats-grid">
    <div class="stat-card ventas">
      <div class="stat-header">
        <span class="stat-icon">💰</span>
        <span class="stat-trend up">↑ 12%</span>
      </div>
      <div class="stat-label">Ventas totales</div>
      <div class="stat-value" id="total-ventas">$4,850</div>
      <div class="stat-meta">48 transacciones</div>
    </div>

    <div class="stat-card pedidos">
      <div class="stat-header">
        <span class="stat-icon">🧾</span>
        <span class="stat-trend up">↑ 8%</span>
      </div>
      <div class="stat-label">Pedidos</div>
      <div class="stat-value" id="total-pedidos">48</div>
      <div class="stat-meta">Promedio 6/hora</div>
    </div>

    <div class="stat-card promedio">
      <div class="stat-header">
        <span class="stat-icon">📈</span>
        <span class="stat-trend up">↑ 4%</span>
      </div>
      <div class="stat-label">Ticket promedio</div>
      <div class="stat-value" id="ticket-promedio">$101</div>
      <div class="stat-meta">vs $97 ayer</div>
    </div>

    <div class="stat-card productos">
      <div class="stat-header">
        <span class="stat-icon">🧁</span>
        <span class="stat-trend down">↓ 2%</span>
      </div>
      <div class="stat-label">Productos vendidos</div>
      <div class="stat-value" id="productos-vendidos">156</div>
      <div class="stat-meta">22 categorías</div>
    </div>
  </div>

  <!-- MAIN GRID -->
  <div class="main-grid">

    <!-- LEFT: SALES HISTORY -->
    <div class="sales-section">
      <div class="section-header">
        <div class="section-title">
          <span class="emoji">🕐</span>
          Historial de ventas
        </div>
        <div class="section-actions">
          <button class="action-btn" onclick="exportarReporte('excel')">
            <span>📊</span> Excel
          </button>
          <button class="action-btn" onclick="exportarReporte('pdf')">
            <span>📄</span> PDF
          </button>
          <button class="action-btn" onclick="imprimirReporte()">
            <span>🖨️</span> Imprimir
          </button>
        </div>
      </div>

      <div class="sales-table-wrap">
        <table class="sales-table" id="sales-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Hora</th>
              <th>Mesa</th>
              <th>Items</th>
              <th>Pago</th>
              <th>Total</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="sales-tbody">
            <!-- Generated by JS -->
          </tbody>
        </table>
      </div>
    </div>

    <!-- RIGHT: SIDEBAR -->
    <div class="right-sidebar">

      <!-- TOP PRODUCTS -->
      <div class="top-products-card">
        <div class="section-title">
          <span class="emoji">🏆</span>
          Más vendidos
        </div>
        <div class="top-products-list" id="top-products-list">
          <!-- Generated by JS -->
        </div>
      </div>

      <!-- PAYMENT METHODS -->
      <div class="payment-methods-card">
        <div class="section-title">
          <span class="emoji">💳</span>
          Métodos de pago
        </div>
        <div class="payment-grid">
          <div class="payment-row">
            <div class="payment-label">
              <span class="payment-icon">💵</span>
              Efectivo
            </div>
            <div class="payment-amount" id="efectivo-total">$2,845</div>
          </div>
          <div class="payment-row">
            <div class="payment-label">
              <span class="payment-icon">💳</span>
              Tarjeta
            </div>
            <div class="payment-amount" id="tarjeta-total">$1,605</div>
          </div>
          <div class="payment-row">
            <div class="payment-label">
              <span class="payment-icon">📲</span>
              Transfer.
            </div>
            <div class="payment-amount" id="transfer-total">$400</div>
          </div>
        </div>
      </div>

      <!-- QUICK ACTIONS -->
      <div class="quick-actions-card">
        <div class="section-title">
          <span class="emoji">⚡</span>
          Acciones rápidas
        </div>
        <div class="action-grid">
          <button class="quick-action-btn" onclick="showToast('Cierre de caja en desarrollo')">
            <span class="qa-icon">💼</span>
            <span class="qa-text">Cierre caja</span>
          </button>
          <button class="quick-action-btn" onclick="showToast('Inventario en desarrollo')">
            <span class="qa-icon">📦</span>
            <span class="qa-text">Inventario</span>
          </button>
          <button class="quick-action-btn" onclick="showToast('Gráficas en desarrollo')">
            <span class="qa-icon">📈</span>
            <span class="qa-text">Gráficas</span>
          </button>
          <button class="quick-action-btn" onclick="exportarReporte('excel')">
            <span class="qa-icon">📊</span>
            <span class="qa-text">Exportar</span>
          </button>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<script>
// ═══════════════════════════════════════════════════════════
// DATA - VENTAS SIMULADAS
// ═══════════════════════════════════════════════════════════
const ventas = [
  { id: 'V-048', hora: '18:24', mesa: 5, items: 4, pago: 'efectivo', total: 285 },
  { id: 'V-047', hora: '18:15', mesa: 3, items: 2, pago: 'tarjeta', total: 125 },
  { id: 'V-046', hora: '17:58', mesa: 7, items: 5, pago: 'efectivo', total: 340 },
  { id: 'V-045', hora: '17:42', mesa: 2, items: 3, pago: 'transferencia', total: 180 },
  { id: 'V-044', hora: '17:30', mesa: 1, items: 2, pago: 'tarjeta', total: 145 },
  { id: 'V-043', hora: '17:12', mesa: 4, items: 6, pago: 'efectivo', total: 420 },
  { id: 'V-042', hora: '16:55', mesa: 6, items: 3, pago: 'tarjeta', total: 210 },
  { id: 'V-041', hora: '16:38', mesa: 8, items: 4, pago: 'efectivo', total: 265 },
  { id: 'V-040', hora: '16:20', mesa: 3, items: 2, pago: 'transferencia', total: 130 },
  { id: 'V-039', hora: '16:05', mesa: 5, items: 5, pago: 'efectivo', total: 385 },
  { id: 'V-038', hora: '15:48', mesa: 2, items: 3, pago: 'tarjeta', total: 195 },
  { id: 'V-037', hora: '15:30', mesa: 7, items: 4, pago: 'efectivo', total: 280 },
];

const topProductos = [
  { rank: 1, emoji: '🫔', nombre: 'Crepa Nutella', ventas: 28, total: 1820 },
  { rank: 2, emoji: '🍓', nombre: 'Fresas c/Crema', ventas: 22, total: 1210 },
  { rank: 3, emoji: '🧇', nombre: 'Waffle Clásico', ventas: 18, total: 1296 },
  { rank: 4, emoji: '🍦', nombre: 'Sundae Vainilla', ventas: 16, total: 720 },
  { rank: 5, emoji: '🥤', nombre: 'Malteada Fresa', ventas: 14, total: 980 },
];

// ═══════════════════════════════════════════════════════════
// RENDER
// ═══════════════════════════════════════════════════════════
function renderVentas() {
  const tbody = document.getElementById('sales-tbody');
  tbody.innerHTML = ventas.map(v => `
    <tr>
      <td class="td-id">${v.id}</td>
      <td class="td-time">${v.hora}</td>
      <td class="td-mesa">Mesa ${v.mesa}</td>
      <td class="td-items">${v.items} productos</td>
      <td>
        <span class="payment-badge payment-${v.pago}">
          ${v.pago === 'efectivo' ? '💵' : v.pago === 'tarjeta' ? '💳' : '📲'} 
          ${v.pago.charAt(0).toUpperCase() + v.pago.slice(1)}
        </span>
      </td>
      <td class="td-total">$${v.total.toFixed(2)}</td>
      <td>
        <div class="td-actions-cell">
          <button class="icon-btn" onclick="verDetalleVenta('${v.id}')" title="Ver detalle">👁️</button>
          <button class="icon-btn" onclick="imprimirTicket('${v.id}')" title="Imprimir">🖨️</button>
          <button class="icon-btn delete" onclick="eliminarVenta('${v.id}')" title="Eliminar">🗑️</button>
        </div>
      </td>
    </tr>
  `).join('');
}

function renderTopProductos() {
  const list = document.getElementById('top-products-list');
  list.innerHTML = topProductos.map(p => `
    <div class="product-row">
      <div class="product-rank rank-${p.rank}">${p.rank}</div>
      <div class="product-emoji">${p.emoji}</div>
      <div class="product-info">
        <div class="product-name">${p.nombre}</div>
        <div class="product-sales">${p.ventas} vendidos</div>
      </div>
      <div class="product-revenue">$${p.total}</div>
    </div>
  `).join('');
}

// ═══════════════════════════════════════════════════════════
// PERIOD SELECTOR
// ═══════════════════════════════════════════════════════════
let currentPeriod = 'hoy';

function setPeriod(period, btn) {
  currentPeriod = period;
  document.querySelectorAll('.date-btn').forEach(b => b.classList.remove('active'));
  if (btn && btn.classList.contains('date-btn')) {
    btn.classList.add('active');
  }
  showToast(`Vista: ${period === 'hoy' ? 'Hoy' : period === 'semana' ? 'Esta semana' : period === 'mes' ? 'Este mes' : 'Fecha personalizada'}`);
  // Aquí puedes filtrar los datos según el período
}

// ═══════════════════════════════════════════════════════════
// ACTIONS
// ═══════════════════════════════════════════════════════════
function verDetalleVenta(id) {
  showToast(`📄 Ver detalle ${id}`);
}

function imprimirTicket(id) {
  showToast(`🖨️ Imprimiendo ticket ${id}`, 'success');
}

function eliminarVenta(id) {
  if (!confirm(`¿Eliminar venta ${id}?`)) return;
  // Eliminar del array
  const idx = ventas.findIndex(v => v.id === id);
  if (idx >= 0) {
    ventas.splice(idx, 1);
    renderVentas();
    showToast(`🗑️ Venta ${id} eliminada`);
  }
}

function exportarReporte(formato) {
  showToast(`📊 Exportando reporte en ${formato.toUpperCase()}...`, 'success');
}

function imprimirReporte() {
  showToast('🖨️ Preparando impresión...', 'success');
}

// ═══════════════════════════════════════════════════════════
// TOAST
// ═══════════════════════════════════════════════════════════
function showToast(msg, tipo = '') {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.className = `toast show ${tipo}`;
  setTimeout(() => t.className = 'toast', 2500);
}

// ═══════════════════════════════════════════════════════════
// INIT
// ═══════════════════════════════════════════════════════════
renderVentas();
renderTopProductos();
</script>
</body>
</html>