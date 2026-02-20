<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dulce & Co — Productos</title>
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
    position: relative;
    z-index: 10;
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

  /* ══════════ MAIN LAYOUT ══════════ */
  .container {
    display: grid;
    grid-template-columns: 1fr 420px;
    gap: 0;
    flex: 1;
    overflow: hidden;
  }

  /* ══════════ LEFT: DATA TABLE ══════════ */
  .left-panel {
    display: flex;
    flex-direction: column;
    padding: 24px 24px 24px 28px;
    overflow: hidden;
    gap: 18px;
  }

  .panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-shrink: 0;
  }
  .panel-title {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 700;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .panel-title .emoji { font-size: 28px; }
  .panel-stats {
    display: flex;
    gap: 8px;
  }
  .stat-badge {
    background: white;
    border: 1.5px solid rgba(61,31,42,0.08);
    border-radius: 22px;
    padding: 6px 14px;
    font-size: 12px;
    font-weight: 600;
    color: var(--chocolate);
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .stat-badge .s-emoji { font-size: 16px; }

  /* SEARCH BAR */
  .table-controls {
    display: flex;
    gap: 10px;
    flex-shrink: 0;
  }
  .search-wrap {
    flex: 1;
    position: relative;
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
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    opacity: 0.4;
  }
  .filter-btn {
    padding: 11px 18px;
    border-radius: var(--radius-sm);
    border: 1.5px solid rgba(61,31,42,0.1);
    background: white;
    font-family: 'DM Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    color: var(--chocolate);
    cursor: pointer;
    transition: all 0.18s;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .filter-btn:hover { background: var(--blush); border-color: var(--rose); }
  .filter-btn.active { background: var(--berry); color: white; border-color: var(--berry); }

  /* TABLE */
  .table-container {
    flex: 1;
    overflow-y: auto;
    background: white;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
  }
  .table-container::-webkit-scrollbar { width: 5px; }
  .table-container::-webkit-scrollbar-track { background: transparent; }
  .table-container::-webkit-scrollbar-thumb { background: var(--rose); border-radius: 5px; }

  .data-table {
    width: 100%;
    border-collapse: collapse;
  }
  .data-table thead {
    position: sticky;
    top: 0;
    background: var(--dark);
    z-index: 2;
  }
  .data-table th {
    text-align: left;
    padding: 14px 16px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--cream);
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
  .data-table tbody tr {
    border-bottom: 1px solid rgba(61,31,42,0.06);
    transition: background 0.15s;
  }
  .data-table tbody tr:hover { background: var(--blush); }
  .data-table td {
    padding: 14px 16px;
    font-size: 13px;
    color: var(--dark);
  }
  .td-emoji {
    font-size: 24px;
    text-align: center;
    width: 60px;
  }
  .td-name {
    font-weight: 600;
    color: var(--dark);
  }
  .td-cat {
    font-size: 12px;
    color: rgba(61,31,42,0.45);
  }
  .td-price {
    font-family: 'Playfair Display', serif;
    font-size: 16px;
    font-weight: 700;
    color: var(--berry);
  }
  .td-stock {
    font-weight: 600;
  }
  .stock-ok { color: var(--mint); }
  .stock-low { color: var(--gold); }
  .stock-out { color: #E44; }
  .td-actions {
    display: flex;
    gap: 6px;
  }
  .action-btn {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: 1.5px solid rgba(61,31,42,0.12);
    background: white;
    cursor: pointer;
    transition: all 0.15s;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
  }
  .action-btn.edit:hover { background: var(--blush); border-color: var(--rose); }
  .action-btn.delete:hover { background: #FFE5E5; border-color: #E88; color: #C44; }

  .tag {
    display: inline-block;
    padding: 3px 9px;
    border-radius: 6px;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }
  .tag-popular { background: var(--gold-light); color: var(--gold); }
  .tag-nuevo { background: var(--mint-light); color: #5A9E8A; }
  .tag-especial { background: #FDF0F2; color: var(--berry); }

  /* EMPTY STATE */
  .empty-table {
    padding: 60px 20px;
    text-align: center;
    color: rgba(61,31,42,0.35);
  }
  .empty-table-icon { font-size: 48px; margin-bottom: 12px; }
  .empty-table-text { font-size: 15px; }

  /* ══════════ RIGHT: FORM ══════════ */
  .right-panel {
    background: white;
    border-left: 1px solid rgba(61,31,42,0.07);
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    padding: 28px;
  }
  .right-panel::-webkit-scrollbar { width: 4px; }
  .right-panel::-webkit-scrollbar-thumb { background: var(--rose); border-radius: 4px; }

  .form-header {
    margin-bottom: 24px;
  }
  .form-title {
    font-family: 'Playfair Display', serif;
    font-size: 24px;
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 6px;
  }
  .form-title em { font-style: italic; color: var(--berry); }
  .form-subtitle {
    font-size: 13px;
    color: rgba(61,31,42,0.45);
  }

  /* FORM FIELDS */
  .form-group {
    margin-bottom: 18px;
  }
  .form-label {
    display: block;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--chocolate);
    margin-bottom: 7px;
  }
  .form-label .required { color: var(--berry); }
  .form-input, .form-select, .form-textarea {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid rgba(61,31,42,0.12);
    border-radius: var(--radius-sm);
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    color: var(--dark);
    background: var(--cream);
    outline: none;
    transition: all 0.2s;
  }
  .form-input:focus, .form-select:focus, .form-textarea:focus {
    border-color: var(--rose);
    box-shadow: 0 0 0 4px rgba(232,168,156,0.15);
    background: white;
  }
  .form-input::placeholder, .form-textarea::placeholder {
    color: rgba(61,31,42,0.3);
  }
  .form-textarea {
    resize: vertical;
    min-height: 80px;
  }

  /* EMOJI PICKER */
  .emoji-picker {
    display: grid;
    grid-template-columns: repeat(8, 1fr);
    gap: 6px;
    padding: 10px;
    background: var(--cream);
    border: 1.5px solid rgba(61,31,42,0.12);
    border-radius: var(--radius-sm);
    margin-top: 7px;
  }
  .emoji-option {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    border: 2px solid transparent;
    background: white;
    font-size: 22px;
    cursor: pointer;
    transition: all 0.15s;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .emoji-option:hover { transform: scale(1.1); }
  .emoji-option.selected {
    border-color: var(--berry);
    background: #FDF0F2;
    transform: scale(1.05);
  }

  /* PRICE ROW */
  .price-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  /* TAG SELECTOR */
  .tag-selector {
    display: flex;
    gap: 8px;
    margin-top: 7px;
  }
  .tag-option {
    padding: 7px 14px;
    border-radius: 18px;
    border: 1.5px solid rgba(61,31,42,0.12);
    background: white;
    font-size: 12px;
    font-weight: 600;
    color: var(--chocolate);
    cursor: pointer;
    transition: all 0.15s;
  }
  .tag-option:hover { background: var(--blush); }
  .tag-option.selected { background: var(--berry); color: white; border-color: var(--berry); }

  /* SUBMIT BUTTONS */
  .form-actions {
    display: flex;
    gap: 10px;
    margin-top: 28px;
    padding-top: 20px;
    border-top: 1px solid rgba(61,31,42,0.08);
  }
  .btn {
    flex: 1;
    padding: 14px;
    border-radius: var(--radius);
    border: none;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
  }
  .btn-primary {
    background: linear-gradient(135deg, var(--berry), #B5546A);
    color: white;
    box-shadow: 0 6px 20px rgba(201,107,122,0.3);
  }
  .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(201,107,122,0.4);
  }
  .btn-secondary {
    background: white;
    color: var(--chocolate);
    border: 1.5px solid rgba(61,31,42,0.12);
  }
  .btn-secondary:hover { background: var(--blush); border-color: var(--rose); }
  .btn:active { transform: translateY(0); }

  .btn-icon { font-size: 16px; }

  /* EDIT MODE INDICATOR */
  .edit-mode-badge {
    display: none;
    background: var(--gold-light);
    border: 1.5px solid var(--gold);
    border-radius: 10px;
    padding: 10px 14px;
    margin-bottom: 16px;
    font-size: 13px;
    color: var(--chocolate);
    align-items: center;
    gap: 8px;
  }
  .edit-mode-badge.show { display: flex; }
  .edit-mode-badge .emoji { font-size: 16px; }

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
  @media (max-width: 1200px) {
    .container { grid-template-columns: 1fr 380px; }
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
      <a href="#" class="nav-link active">📦 Productos</a>
      <a href="#" class="nav-link">📊 Reportes</a>
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

  <!-- LEFT: TABLE -->
  <div class="left-panel">
    <div class="panel-header">
      <div class="panel-title">
        <span class="emoji">🧁</span>
        Catálogo
      </div>
      <div class="panel-stats">
        <div class="stat-badge">
          <span class="s-emoji">📦</span>
          <span id="total-productos">0</span> productos
        </div>
        <div class="stat-badge">
          <span class="s-emoji">🎯</span>
          <span id="total-categorias">0</span> categorías
        </div>
      </div>
    </div>

    <div class="table-controls">
      <div class="search-wrap">
        <span class="search-icon">🔍</span>
        <input type="text" placeholder="Buscar producto..." id="search-input" oninput="buscarProducto()" />
      </div>
      <button class="filter-btn" id="filter-btn" onclick="toggleFiltro()">
        <span>🏷️</span> Filtrar
      </button>
    </div>

    <div class="table-container">
      <table class="data-table" id="data-table">
        <thead>
          <tr>
            <th>—</th>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Etiq.</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody id="table-body">
          <!-- Populated by JS -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- RIGHT: FORM -->
  <div class="right-panel">
    <div class="edit-mode-badge" id="edit-mode-badge">
      <span class="emoji">✏️</span>
      <div>
        <strong>Editando producto</strong><br>
        <small id="edit-product-name">—</small>
      </div>
    </div>

    <div class="form-header">
      <h2 class="form-title" id="form-title">Nuevo <em>producto</em></h2>
      <p class="form-subtitle">Completa los campos para agregar al catálogo</p>
    </div>

    <form id="product-form">
      <div class="form-group">
        <label class="form-label">Emoji <span class="required">*</span></label>
        <div class="emoji-picker" id="emoji-picker">
          <!-- Generated by JS -->
        </div>
        <input type="hidden" id="emoji-input" required />
      </div>

      <div class="form-group">
        <label class="form-label" for="nombre">Nombre del producto <span class="required">*</span></label>
        <input type="text" class="form-input" id="nombre" placeholder="Ej: Crepa Nutella" required />
      </div>

      <div class="form-group">
        <label class="form-label" for="categoria">Categoría <span class="required">*</span></label>
        <select class="form-select" id="categoria" required>
          <option value="">Seleccionar...</option>
          <option value="crepas">🫔 Crepas</option>
          <option value="fresas">🍓 Fresas</option>
          <option value="helados">🍦 Helados</option>
          <option value="bebidas">🥤 Bebidas</option>
          <option value="waffles">🧇 Waffles</option>
          <option value="postres">🍮 Postres</option>
        </select>
      </div>

      <div class="form-group">
        <label class="form-label">Precio y Stock</label>
        <div class="price-row">
          <div>
            <input type="number" class="form-input" id="precio" placeholder="$0.00" step="0.01" min="0" required />
          </div>
          <div>
            <input type="number" class="form-input" id="stock" placeholder="Stock" min="0" value="50" required />
          </div>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Etiqueta (opcional)</label>
        <div class="tag-selector">
          <div class="tag-option" onclick="selectTag(this, '')">Sin etiqueta</div>
          <div class="tag-option" onclick="selectTag(this, 'Popular')">Popular</div>
          <div class="tag-option" onclick="selectTag(this, 'Nuevo')">Nuevo</div>
          <div class="tag-option" onclick="selectTag(this, 'Especial')">Especial</div>
        </div>
        <input type="hidden" id="tag-input" value="" />
      </div>

      <div class="form-group">
        <label class="form-label" for="descripcion">Descripción (opcional)</label>
        <textarea class="form-textarea" id="descripcion" placeholder="Detalles del producto..."></textarea>
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn-secondary" onclick="cancelarForm()">
          <span class="btn-icon">✕</span>
          Cancelar
        </button>
        <button type="submit" class="btn btn-primary" id="submit-btn">
          <span class="btn-icon">✓</span>
          <span id="submit-text">Guardar producto</span>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<script>
// ═══════════════════════════════════════════════════════════
// DATA
// ═══════════════════════════════════════════════════════════
let productos = [
  { id:1, emoji:"🫔", nombre:"Crepa Nutella", categoria:"crepas", precio:65, stock:25, tag:"Popular" },
  { id:2, emoji:"🍓", nombre:"Crepa Fresa", categoria:"crepas", precio:60, stock:30, tag:"" },
  { id:3, emoji:"🤎", nombre:"Crepa Cajeta", categoria:"crepas", precio:62, stock:20, tag:"Especial" },
  { id:4, emoji:"🍓", nombre:"Fresas c/Crema", categoria:"fresas", precio:55, stock:15, tag:"Popular" },
  { id:5, emoji:"🍦", nombre:"Sundae Vainilla", categoria:"helados", precio:45, stock:40, tag:"" },
  { id:6, emoji:"🥤", nombre:"Malteada Fresa", categoria:"bebidas", precio:70, stock:22, tag:"" },
  { id:7, emoji:"🧇", nombre:"Waffle Clásico", categoria:"waffles", precio:72, stock:8, tag:"Nuevo" },
  { id:8, emoji:"🍰", nombre:"Cheesecake", categoria:"postres", precio:65, stock:12, tag:"Especial" },
];

let nextId = 9;
let editingId = null;

const EMOJIS = ["🫔","🍓","🤎","🥭","🍪","🫶","🥥","🍦","🍫","🥤","🍼","☕","🧇","💛","🍑","🍰","🎂","🍩","🍮","🧃","🍇","🥞","🍌","🍉"];

// ═══════════════════════════════════════════════════════════
// INIT
// ═══════════════════════════════════════════════════════════
renderEmojiPicker();
renderTabla();
actualizarEstadisticas();

// ═══════════════════════════════════════════════════════════
// EMOJI PICKER
// ═══════════════════════════════════════════════════════════
function renderEmojiPicker() {
  const picker = document.getElementById('emoji-picker');
  picker.innerHTML = EMOJIS.map(e => 
    `<div class="emoji-option" onclick="selectEmoji(this, '${e}')">${e}</div>`
  ).join('');
}

function selectEmoji(el, emoji) {
  document.querySelectorAll('.emoji-option').forEach(o => o.classList.remove('selected'));
  el.classList.add('selected');
  document.getElementById('emoji-input').value = emoji;
}

// ═══════════════════════════════════════════════════════════
// TAG SELECTOR
// ═══════════════════════════════════════════════════════════
function selectTag(el, tag) {
  document.querySelectorAll('.tag-option').forEach(o => o.classList.remove('selected'));
  el.classList.add('selected');
  document.getElementById('tag-input').value = tag;
}

// ═══════════════════════════════════════════════════════════
// RENDER TABLE
// ═══════════════════════════════════════════════════════════
function renderTabla(lista = productos) {
  const tbody = document.getElementById('table-body');
  
  if (!lista.length) {
    tbody.innerHTML = `
      <tr>
        <td colspan="7">
          <div class="empty-table">
            <div class="empty-table-icon">📦</div>
            <div class="empty-table-text">No hay productos registrados</div>
          </div>
        </td>
      </tr>
    `;
    return;
  }

  tbody.innerHTML = lista.map(p => {
    let stockClass = 'stock-ok';
    if (p.stock === 0) stockClass = 'stock-out';
    else if (p.stock < 10) stockClass = 'stock-low';

    let tagHTML = '';
    if (p.tag) {
      let tagClass = 'tag-popular';
      if (p.tag === 'Nuevo') tagClass = 'tag-nuevo';
      if (p.tag === 'Especial') tagClass = 'tag-especial';
      tagHTML = `<span class="tag ${tagClass}">${p.tag}</span>`;
    }

    return `
      <tr>
        <td class="td-emoji">${p.emoji}</td>
        <td>
          <div class="td-name">${p.nombre}</div>
        </td>
        <td>
          <div class="td-cat">${getCategoriaLabel(p.categoria)}</div>
        </td>
        <td class="td-price">$${p.precio.toFixed(2)}</td>
        <td class="td-stock ${stockClass}">${p.stock}</td>
        <td>${tagHTML}</td>
        <td>
          <div class="td-actions">
            <button class="action-btn edit" onclick="editarProducto(${p.id})" title="Editar">✏️</button>
            <button class="action-btn delete" onclick="eliminarProducto(${p.id})" title="Eliminar">🗑️</button>
          </div>
        </td>
      </tr>
    `;
  }).join('');
}

function getCategoriaLabel(cat) {
  const map = {
    crepas: 'Crepas',
    fresas: 'Fresas',
    helados: 'Helados',
    bebidas: 'Bebidas',
    waffles: 'Waffles',
    postres: 'Postres'
  };
  return map[cat] || cat;
}

// ═══════════════════════════════════════════════════════════
// SEARCH
// ═══════════════════════════════════════════════════════════
function buscarProducto() {
  const query = document.getElementById('search-input').value.toLowerCase();
  const filtrados = productos.filter(p =>
    p.nombre.toLowerCase().includes(query) ||
    p.categoria.toLowerCase().includes(query)
  );
  renderTabla(filtrados);
}

// ═══════════════════════════════════════════════════════════
// FORM SUBMIT
// ═══════════════════════════════════════════════════════════
document.getElementById('product-form').addEventListener('submit', e => {
  e.preventDefault();

  const emoji = document.getElementById('emoji-input').value;
  const nombre = document.getElementById('nombre').value.trim();
  const categoria = document.getElementById('categoria').value;
  const precio = parseFloat(document.getElementById('precio').value);
  const stock = parseInt(document.getElementById('stock').value);
  const tag = document.getElementById('tag-input').value;
  const descripcion = document.getElementById('descripcion').value.trim();

  if (!emoji) {
    showToast('Selecciona un emoji', 'error');
    return;
  }

  if (editingId) {
    // UPDATE
    const prod = productos.find(p => p.id === editingId);
    prod.emoji = emoji;
    prod.nombre = nombre;
    prod.categoria = categoria;
    prod.precio = precio;
    prod.stock = stock;
    prod.tag = tag;
    prod.descripcion = descripcion;
    showToast(`✓ ${nombre} actualizado`, 'success');
    editingId = null;
    document.getElementById('edit-mode-badge').classList.remove('show');
  } else {
    // CREATE
    productos.push({
      id: nextId++,
      emoji, nombre, categoria, precio, stock, tag, descripcion
    });
    showToast(`✓ ${nombre} agregado`, 'success');
  }

  renderTabla();
  actualizarEstadisticas();
  resetForm();
});

// ═══════════════════════════════════════════════════════════
// EDIT
// ═══════════════════════════════════════════════════════════
function editarProducto(id) {
  const prod = productos.find(p => p.id === id);
  if (!prod) return;

  editingId = id;

  // populate form
  document.querySelectorAll('.emoji-option').forEach(el => {
    el.classList.toggle('selected', el.textContent === prod.emoji);
  });
  document.getElementById('emoji-input').value = prod.emoji;
  document.getElementById('nombre').value = prod.nombre;
  document.getElementById('categoria').value = prod.categoria;
  document.getElementById('precio').value = prod.precio;
  document.getElementById('stock').value = prod.stock;
  document.getElementById('descripcion').value = prod.descripcion || '';

  document.querySelectorAll('.tag-option').forEach(el => {
    const tagText = el.textContent.includes('Sin') ? '' : el.textContent;
    el.classList.toggle('selected', tagText === prod.tag);
  });
  document.getElementById('tag-input').value = prod.tag;

  // update UI
  document.getElementById('form-title').innerHTML = 'Editar <em>producto</em>';
  document.getElementById('submit-text').textContent = 'Actualizar';
  document.getElementById('edit-mode-badge').classList.add('show');
  document.getElementById('edit-product-name').textContent = prod.nombre;

  // scroll to top
  document.querySelector('.right-panel').scrollTop = 0;
}

// ═══════════════════════════════════════════════════════════
// DELETE
// ═══════════════════════════════════════════════════════════
function eliminarProducto(id) {
  const prod = productos.find(p => p.id === id);
  if (!prod) return;
  if (!confirm(`¿Eliminar "${prod.nombre}"?`)) return;

  productos = productos.filter(p => p.id !== id);
  renderTabla();
  actualizarEstadisticas();
  showToast(`🗑️ ${prod.nombre} eliminado`);
}

// ═══════════════════════════════════════════════════════════
// CANCEL / RESET
// ═══════════════════════════════════════════════════════════
function cancelarForm() {
  if (editingId && !confirm('¿Cancelar edición?')) return;
  resetForm();
}

function resetForm() {
  editingId = null;
  document.getElementById('product-form').reset();
  document.querySelectorAll('.emoji-option').forEach(o => o.classList.remove('selected'));
  document.querySelectorAll('.tag-option').forEach(o => o.classList.remove('selected'));
  document.getElementById('form-title').innerHTML = 'Nuevo <em>producto</em>';
  document.getElementById('submit-text').textContent = 'Guardar producto';
  document.getElementById('edit-mode-badge').classList.remove('show');
}

// ═══════════════════════════════════════════════════════════
// STATS
// ═══════════════════════════════════════════════════════════
function actualizarEstadisticas() {
  document.getElementById('total-productos').textContent = productos.length;
  const cats = new Set(productos.map(p => p.categoria));
  document.getElementById('total-categorias').textContent = cats.size;
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
// FILTER (placeholder)
// ═══════════════════════════════════════════════════════════
function toggleFiltro() {
  showToast('Función en desarrollo', 'error');
}
</script>
</body>
</html>