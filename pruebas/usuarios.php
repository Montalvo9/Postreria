<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dulce & Co — Usuarios</title>
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
            --shadow: 0 4px 24px rgba(61, 31, 42, 0.10);
            --shadow-lg: 0 8px 40px rgba(61, 31, 42, 0.16);
            --radius: 18px;
            --radius-sm: 10px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

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

        .header-left {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .header-logo {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: var(--cream);
            letter-spacing: 0.02em;
        }

        .header-logo span {
            color: var(--rose);
            font-style: italic;
        }

        .header-nav {
            display: flex;
            gap: 6px;
        }

        .nav-link {
            padding: 7px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            color: rgba(253, 246, 238, 0.55);
            text-decoration: none;
            transition: all 0.18s;
            border: 1px solid transparent;
        }

        .nav-link:hover {
            color: var(--cream);
            background: rgba(255, 255, 255, 0.06);
        }

        .nav-link.active {
            color: var(--cream);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.12);
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
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            font-size: 13px;
            color: var(--cream);
        }

        /* ══════════ MAIN LAYOUT ══════════ */
        .container {
            display: grid;
            grid-template-columns: 460px 1fr;
            gap: 0;
            flex: 1;
            overflow: hidden;
        }

        /* ══════════ LEFT: FORM ══════════ */
        .left-panel {
            background: white;
            border-right: 1px solid rgba(61, 31, 42, 0.07);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            padding: 32px 28px;
        }

        .left-panel::-webkit-scrollbar {
            width: 4px;
        }

        .left-panel::-webkit-scrollbar-thumb {
            background: var(--rose);
            border-radius: 4px;
        }

        .form-header {
            margin-bottom: 28px;
            animation: fadeDown 0.5s ease both;
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            margin-bottom: 8px;
        }

        .form-title em {
            font-style: italic;
            color: var(--berry);
        }

        .form-subtitle {
            font-size: 13px;
            color: rgba(61, 31, 42, 0.45);
            line-height: 1.5;
        }

        /* AVATAR SELECTOR */
        .avatar-section {
            margin-bottom: 24px;
            animation: fadeDown 0.5s 0.1s ease both;
        }

        .avatar-label {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--chocolate);
            margin-bottom: 12px;
            display: block;
        }

        .avatar-label .required {
            color: var(--berry);
        }

        .avatar-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 8px;
        }

        .avatar-option {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            border: 2px solid rgba(61, 31, 42, 0.09);
            background: var(--cream);
            font-size: 26px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .avatar-option:hover {
            transform: translateY(-3px) scale(1.05);
            border-color: var(--rose);
            box-shadow: 0 6px 20px rgba(232, 168, 156, 0.25);
        }

        .avatar-option.selected {
            border-color: var(--berry);
            background: var(--dark);
            transform: scale(1.08);
        }

        .avatar-check {
            position: absolute;
            bottom: -4px;
            right: -4px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--berry);
            color: white;
            font-size: 10px;
            display: none;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }

        .avatar-option.selected .avatar-check {
            display: flex;
        }

        /* FORM FIELDS */
        .form-section {
            animation: fadeDown 0.5s 0.15s ease both;
        }

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

        .form-label .required {
            color: var(--berry);
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid rgba(61, 31, 42, 0.12);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--dark);
            background: var(--cream);
            outline: none;
            transition: all 0.2s;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: var(--rose);
            box-shadow: 0 0 0 4px rgba(232, 168, 156, 0.15);
            background: white;
        }

        .form-input::placeholder {
            color: rgba(61, 31, 42, 0.3);
        }

        /* INPUT WITH ICON */
        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            opacity: 0.45;
            pointer-events: none;
        }

        .input-wrap .form-input {
            padding-left: 44px;
        }

        .input-wrap .form-input:focus~.input-icon {
            opacity: 0.9;
        }

        /* PASSWORD TOGGLE */
        .eye-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            opacity: 0.35;
            transition: opacity 0.2s;
            padding: 0;
        }

        .eye-toggle:hover {
            opacity: 0.75;
        }

        /* ROLE SELECTOR */
        .role-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .role-card {
            border: 2px solid rgba(61, 31, 42, 0.09);
            border-radius: 12px;
            padding: 14px 12px;
            cursor: pointer;
            transition: all 0.2s;
            background: var(--cream);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            text-align: center;
        }

        .role-card:hover {
            border-color: var(--rose);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(201, 107, 122, 0.18);
        }

        .role-card.selected {
            border-color: var(--berry);
            background: var(--dark);
        }

        .role-emoji {
            font-size: 28px;
            transition: transform 0.2s;
        }

        .role-card.selected .role-emoji {
            transform: scale(1.1);
        }

        .role-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            transition: color 0.2s;
        }

        .role-card.selected .role-name {
            color: white;
        }

        .role-desc {
            font-size: 11px;
            color: rgba(61, 31, 42, 0.4);
            line-height: 1.3;
            transition: color 0.2s;
        }

        .role-card.selected .role-desc {
            color: rgba(255, 255, 255, 0.5);
        }

        /* STATUS TOGGLE */
        .status-toggle-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            background: var(--cream);
            border: 1.5px solid rgba(61, 31, 42, 0.12);
            border-radius: var(--radius-sm);
            transition: all 0.2s;
        }

        .status-toggle-wrap:hover {
            border-color: var(--rose);
        }

        .status-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 500;
            color: var(--dark);
        }

        .status-emoji {
            font-size: 18px;
        }

        /* Toggle Switch */
        .toggle-switch {
            position: relative;
            width: 52px;
            height: 28px;
            background: rgba(61, 31, 42, 0.15);
            border-radius: 40px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .toggle-switch.active {
            background: var(--mint);
        }

        .toggle-knob {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 22px;
            height: 22px;
            background: white;
            border-radius: 50%;
            transition: transform 0.3s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .toggle-switch.active .toggle-knob {
            transform: translateX(24px);
        }

        /* PIN GENERATOR */
        .pin-display {
            background: var(--gold-light);
            border: 2px solid var(--gold);
            border-radius: var(--radius-sm);
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 8px;
        }

        .pin-code {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--dark);
            letter-spacing: 0.12em;
        }

        .pin-actions {
            display: flex;
            gap: 6px;
        }

        .pin-btn {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            border: 1.5px solid rgba(61, 31, 42, 0.15);
            background: white;
            cursor: pointer;
            transition: all 0.15s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
        }

        .pin-btn:hover {
            background: var(--blush);
            border-color: var(--rose);
        }

        .pin-btn:active {
            transform: scale(0.92);
        }

        /* EDIT MODE INDICATOR */
        .edit-mode-badge {
            display: none;
            background: var(--gold-light);
            border: 1.5px solid var(--gold);
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            color: var(--chocolate);
            align-items: center;
            gap: 10px;
            animation: fadeDown 0.3s ease both;
        }

        .edit-mode-badge.show {
            display: flex;
        }

        .edit-icon {
            font-size: 18px;
        }

        .edit-info strong {
            display: block;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .edit-info small {
            font-size: 11px;
            opacity: 0.7;
        }

        /* FORM ACTIONS */
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(61, 31, 42, 0.08);
            animation: fadeDown 0.5s 0.25s ease both;
        }

        .btn {
            flex: 1;
            padding: 15px;
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
            gap: 7px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--dark) 0%, var(--chocolate) 100%);
            color: var(--cream);
            box-shadow: 0 6px 22px rgba(61, 31, 42, 0.28);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--berry), #A8485A);
            opacity: 0;
            transition: opacity 0.22s;
        }

        .btn-primary:hover::before {
            opacity: 1;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(61, 31, 42, 0.35);
        }

        .btn-primary span {
            position: relative;
            z-index: 1;
        }

        .btn-primary .btn-icon {
            position: relative;
            z-index: 1;
            font-size: 16px;
        }

        .btn-secondary {
            background: white;
            color: var(--chocolate);
            border: 1.5px solid rgba(61, 31, 42, 0.12);
        }

        .btn-secondary:hover {
            background: var(--blush);
            border-color: var(--rose);
        }

        .btn:active {
            transform: translateY(0);
        }

        /* LOADING STATE */
        .btn-primary.loading {
            pointer-events: none;
        }

        .btn-primary.loading span {
            opacity: 0;
        }

        .btn-primary.loading::after {
            content: '';
            position: absolute;
            width: 22px;
            height: 22px;
            border: 2.5px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            z-index: 2;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* ══════════ RIGHT: USERS TABLE SECTION ══════════ */
        .right-panel {
            display: flex;
            flex-direction: column;
            padding: 28px;
            overflow: hidden;
            background: var(--cream);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            animation: fadeDown 0.5s ease both;
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

        .panel-title .emoji {
            font-size: 28px;
        }

        .panel-stats {
            display: flex;
            gap: 8px;
        }

        .stat-badge {
            background: white;
            border: 1.5px solid rgba(61, 31, 42, 0.08);
            border-radius: 22px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            color: var(--chocolate);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .stat-badge .s-emoji {
            font-size: 16px;
        }

        /* TABLE CONTROLS */
        .table-controls {
            display: flex;
            gap: 10px;
            margin-bottom: 18px;
            animation: fadeDown 0.5s 0.1s ease both;
        }

        .search-wrap {
            flex: 1;
            position: relative;
        }

        .search-wrap input {
            width: 100%;
            padding: 11px 16px 11px 42px;
            border-radius: var(--radius-sm);
            border: 1.5px solid rgba(61, 31, 42, 0.1);
            background: white;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--dark);
            outline: none;
            transition: border-color 0.2s;
        }

        .search-wrap input:focus {
            border-color: var(--rose);
        }

        .search-wrap input::placeholder {
            color: rgba(61, 31, 42, 0.35);
        }

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
            border: 1.5px solid rgba(61, 31, 42, 0.1);
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

        .filter-btn:hover {
            background: var(--blush);
            border-color: var(--rose);
        }

        /* TABLE CONTAINER - READY FOR YOUR TABLE */
        .table-container {
            flex: 1;
            background: white;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 20px;
            overflow-y: auto;
            animation: fadeDown 0.5s 0.15s ease both;
        }

        .table-container::-webkit-scrollbar {
            width: 5px;
        }

        .table-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .table-container::-webkit-scrollbar-thumb {
            background: var(--rose);
            border-radius: 5px;
        }

        /* PLACEHOLDER FOR YOUR TABLE */
        .table-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            gap: 14px;
            color: rgba(61, 31, 42, 0.35);
        }

        .table-placeholder-icon {
            font-size: 56px;
        }

        .table-placeholder-text {
            font-size: 15px;
            text-align: center;
            line-height: 1.6;
        }

        .table-placeholder-text strong {
            display: block;
            color: var(--chocolate);
            font-weight: 600;
            margin-bottom: 4px;
        }

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

        .toast.show {
            transform: translateX(-50%) translateY(0);
        }

        .toast.success {
            background: #5A9E8A;
        }

        .toast.error {
            background: #C44;
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .container {
                grid-template-columns: 420px 1fr;
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
                <a href="#" class="nav-link active">👥 Usuarios</a>
                <a href="#" class="nav-link">📊 Reportes</a>
                <a href="#" class="nav-link">⚙️ Config</a>
            </nav>
        </div>
        <div class="header-right">
            <div class="user-badge">
                <span>🔑</span>
                <span>Admin</span>
            </div>
        </div>
    </header>

    <!-- MAIN -->
    <div class="container">

        <!-- LEFT: FORM -->
        <div class="left-panel">
            <div class="edit-mode-badge" id="edit-mode-badge">
                <span class="edit-icon">✏️</span>
                <div class="edit-info">
                    <strong>Editando usuario</strong>
                    <small id="edit-user-name">—</small>
                </div>
            </div>

            <div class="form-header">
                <div class="form-eyebrow">Gestión de equipo</div>
                <h2 class="form-title" id="form-title">Nuevo <em>usuario</em></h2>
                <p class="form-subtitle">Completa la información para registrar un nuevo miembro del equipo</p>
            </div>

            <form id="user-form">
                <!-- AVATAR SELECTOR -->
                <div class="avatar-section">
                    <label class="avatar-label">Avatar <span class="required">*</span></label>
                    <div class="avatar-grid" id="avatar-grid">
                        <!-- Generated by JS -->
                    </div>
                    <input type="hidden" id="avatar-input" required />
                </div>

                <div class="form-section">
                    <!-- NOMBRE COMPLETO -->
                    <div class="form-group">
                        <label class="form-label" for="nombre-completo">Nombre completo <span class="required">*</span></label>
                        <div class="input-wrap">
                            <input type="text" class="form-input" id="nombre-completo" placeholder="Ej: Ana María García" required />
                            <span class="input-icon">👤</span>
                        </div>
                    </div>

                    <!-- EMAIL -->
                    <div class="form-group">
                        <label class="form-label" for="email">Correo electrónico <span class="required">*</span></label>
                        <div class="input-wrap">
                            <input type="email" class="form-input" id="email" placeholder="usuario@dulce.com" required />
                            <span class="input-icon">📧</span>
                        </div>
                    </div>

                    <!-- TELÉFONO -->
                    <div class="form-group">
                        <label class="form-label" for="telefono">Teléfono</label>
                        <div class="input-wrap">
                            <input type="tel" class="form-input" id="telefono" placeholder="(000) 000-0000" />
                            <span class="input-icon">📱</span>
                        </div>
                    </div>

                    <!-- ROL -->
                    <div class="form-group">
                        <label class="form-label">Rol <span class="required">*</span></label>
                        <div class="role-grid">
                            <div class="role-card" onclick="selectRole(this, 'Cajera')">
                                <span class="role-emoji">👩‍💼</span>
                                <div class="role-name">Cajera</div>
                                <div class="role-desc">Cobra y atiende</div>
                            </div>
                            <div class="role-card" onclick="selectRole(this, 'Gerente')">
                                <span class="role-emoji">👨‍💼</span>
                                <div class="role-name">Gerente</div>
                                <div class="role-desc">Supervisa todo</div>
                            </div>
                            <div class="role-card" onclick="selectRole(this, 'Mesera')">
                                <span class="role-emoji">👩‍🍳</span>
                                <div class="role-name">Mesera</div>
                                <div class="role-desc">Toma pedidos</div>
                            </div>
                            <div class="role-card" onclick="selectRole(this, 'Admin')">
                                <span class="role-emoji">🔑</span>
                                <div class="role-name">Admin</div>
                                <div class="role-desc">Acceso total</div>
                            </div>
                        </div>
                        <input type="hidden" id="rol-input" required />
                    </div>

                    <!-- PIN -->
                    <div class="form-group">
                        <label class="form-label">PIN de acceso <span class="required">*</span></label>
                        <div class="pin-display">
                            <div class="pin-code" id="pin-display">----</div>
                            <div class="pin-actions">
                                <button type="button" class="pin-btn" onclick="generarPIN()" title="Generar nuevo">🔄</button>
                                <button type="button" class="pin-btn" onclick="copiarPIN()" title="Copiar">📋</button>
                            </div>
                        </div>
                        <input type="hidden" id="pin-input" required />
                    </div>

                    <!-- CONTRASEÑA -->
                    <div class="form-group">
                        <label class="form-label" for="password">Contraseña <span class="required">*</span></label>
                        <div class="input-wrap">
                            <input type="password" class="form-input" id="password" placeholder="••••••••" required />
                            <span class="input-icon">🔒</span>
                            <button type="button" class="eye-toggle" onclick="togglePassword()" id="eye-btn">👁️</button>
                        </div>
                    </div>

                    <!-- STATUS ACTIVO -->
                    <div class="form-group">
                        <label class="form-label">Estado</label>
                        <div class="status-toggle-wrap">
                            <div class="status-label">
                                <span class="status-emoji" id="status-emoji">✅</span>
                                <span id="status-text">Usuario activo</span>
                            </div>
                            <div class="toggle-switch active" id="status-toggle" onclick="toggleStatus()">
                                <div class="toggle-knob"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="cancelarForm()">
                        <span>✕</span>
                        <span>Cancelar</span>
                    </button>
                    <button type="submit" class="btn btn-primary" id="submit-btn">
                        <span class="btn-icon">✓</span>
                        <span id="submit-text">Crear usuario</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- RIGHT: TABLE SECTION -->
        <div class="right-panel">
            <div class="panel-header">
                <div class="panel-title">
                    <span class="emoji">👥</span>
                    Equipo registrado
                </div>
                <div class="panel-stats">
                    <div class="stat-badge">
                        <span class="s-emoji">👤</span>
                        <span id="total-usuarios">0</span> usuarios
                    </div>
                    <div class="stat-badge">
                        <span class="s-emoji">✅</span>
                        <span id="usuarios-activos">0</span> activos
                    </div>
                </div>
            </div>

            <div class="table-controls">
                <div class="search-wrap">
                    <span class="search-icon">🔍</span>
                    <input type="text" placeholder="Buscar usuario..." id="search-input" />
                </div>
                <button class="filter-btn" id="filter-btn">
                    <span>🏷️</span> Filtrar
                </button>
            </div>

            <!-- 
      ════════════════════════════════════════════════════════════
      AQUÍ VA TU TABLA
      ════════════════════════════════════════════════════════════
      Esta sección está lista para que insertes tu DataTable
      o tabla personalizada. El contenedor tiene:
      - Scroll automático
      - Estilos de scrollbar personalizados
      - Fondo blanco con sombra
      - Bordes redondeados
      
      Puedes reemplazar el .table-placeholder con tu tabla HTML
      o inicializar aquí tu DataTable / librería de tablas.
    -->
            <div class="table-container" id="table-container">
                <div class="table-placeholder">
                    <div class="table-placeholder-icon">📋</div>
                    <div class="table-placeholder-text">
                        <strong>Contenedor listo para tu tabla</strong>
                        Inserta aquí tu DataTable o tabla HTML personalizada.<br>
                        El formulario enviará los datos al array <code>usuarios</code>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST -->
    <div class="toast" id="toast"></div>

    <script>
        // ═══════════════════════════════════════════════════════════
        // DATA
        // ═══════════════════════════════════════════════════════════
        let usuarios = [];
        let nextId = 1;
        let editingId = null;
        let userStatus = true;

        const AVATARES = ["👩‍💼", "👨‍💼", "👩‍🍳", "👨‍🍳", "👩", "👨", "👧", "👦", "🧑‍💼", "👩‍🔧", "👨‍🔧", "🧑‍🍳"];

        // ═══════════════════════════════════════════════════════════
        // INIT
        // ═══════════════════════════════════════════════════════════
        renderAvatares();
        generarPIN();

        // ═══════════════════════════════════════════════════════════
        // AVATAR SELECTOR
        // ═══════════════════════════════════════════════════════════
        function renderAvatares() {
            const grid = document.getElementById('avatar-grid');
            grid.innerHTML = AVATARES.map(a => `
    <div class="avatar-option" onclick="selectAvatar(this, '${a}')">
      ${a}
      <div class="avatar-check">✓</div>
    </div>
  `).join('');
        }

        function selectAvatar(el, avatar) {
            document.querySelectorAll('.avatar-option').forEach(o => o.classList.remove('selected'));
            el.classList.add('selected');
            document.getElementById('avatar-input').value = avatar;
        }

        // ═══════════════════════════════════════════════════════════
        // ROLE SELECTOR
        // ═══════════════════════════════════════════════════════════
        function selectRole(el, rol) {
            document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            document.getElementById('rol-input').value = rol;
        }

        // ═══════════════════════════════════════════════════════════
        // PIN GENERATOR
        // ═══════════════════════════════════════════════════════════
        function generarPIN() {
            const pin = String(Math.floor(1000 + Math.random() * 9000));
            document.getElementById('pin-display').textContent = pin;
            document.getElementById('pin-input').value = pin;
        }

        function copiarPIN() {
            const pin = document.getElementById('pin-input').value;
            navigator.clipboard.writeText(pin);
            showToast('📋 PIN copiado', 'success');
        }

        // ═══════════════════════════════════════════════════════════
        // PASSWORD TOGGLE
        // ═══════════════════════════════════════════════════════════
        function togglePassword() {
            const input = document.getElementById('password');
            const btn = document.getElementById('eye-btn');
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = '🙈';
            } else {
                input.type = 'password';
                btn.textContent = '👁️';
            }
        }

        // ═══════════════════════════════════════════════════════════
        // STATUS TOGGLE
        // ═══════════════════════════════════════════════════════════
        function toggleStatus() {
            const toggle = document.getElementById('status-toggle');
            const emoji = document.getElementById('status-emoji');
            const text = document.getElementById('status-text');

            userStatus = !userStatus;
            toggle.classList.toggle('active', userStatus);

            if (userStatus) {
                emoji.textContent = '✅';
                text.textContent = 'Usuario activo';
            } else {
                emoji.textContent = '⛔';
                text.textContent = 'Usuario inactivo';
            }
        }

        // ═══════════════════════════════════════════════════════════
        // FORM SUBMIT
        // ═══════════════════════════════════════════════════════════
        document.getElementById('user-form').addEventListener('submit', e => {
            e.preventDefault();

            const avatar = document.getElementById('avatar-input').value;
            const nombre = document.getElementById('nombre-completo').value.trim();
            const email = document.getElementById('email').value.trim();
            const telefono = document.getElementById('telefono').value.trim();
            const rol = document.getElementById('rol-input').value;
            const pin = document.getElementById('pin-input').value;
            const password = document.getElementById('password').value;

            if (!avatar) {
                showToast('Selecciona un avatar', 'error');
                return;
            }
            if (!rol) {
                showToast('Selecciona un rol', 'error');
                return;
            }

            const btn = document.getElementById('submit-btn');
            btn.classList.add('loading');

            setTimeout(() => {
                btn.classList.remove('loading');

                if (editingId) {
                    // UPDATE
                    const user = usuarios.find(u => u.id === editingId);
                    user.avatar = avatar;
                    user.nombre = nombre;
                    user.email = email;
                    user.telefono = telefono;
                    user.rol = rol;
                    user.pin = pin;
                    user.password = password;
                    user.activo = userStatus;
                    showToast(`✓ ${nombre} actualizado`, 'success');
                    editingId = null;
                    document.getElementById('edit-mode-badge').classList.remove('show');
                } else {
                    // CREATE
                    usuarios.push({
                        id: nextId++,
                        avatar,
                        nombre,
                        email,
                        telefono,
                        rol,
                        pin,
                        password,
                        activo: userStatus,
                        fechaCreacion: new Date()
                    });
                    showToast(`✓ ${nombre} registrado`, 'success');
                }

                actualizarEstadisticas();
                resetForm();

                // AQUÍ PUEDES LLAMAR A TU FUNCIÓN DE RENDERIZADO DE TABLA
                // Ejemplo: renderTabla();

                console.log('Usuarios registrados:', usuarios);
            }, 800);
        });

        // ═══════════════════════════════════════════════════════════
        // CANCEL / RESET
        // ═══════════════════════════════════════════════════════════
        function cancelarForm() {
            if (editingId && !confirm('¿Cancelar edición?')) return;
            resetForm();
        }

        function resetForm() {
            editingId = null;
            document.getElementById('user-form').reset();
            document.querySelectorAll('.avatar-option').forEach(o => o.classList.remove('selected'));
            document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
            document.getElementById('form-title').innerHTML = 'Nuevo <em>usuario</em>';
            document.getElementById('submit-text').textContent = 'Crear usuario';
            document.getElementById('edit-mode-badge').classList.remove('show');
            userStatus = true;
            document.getElementById('status-toggle').classList.add('active');
            document.getElementById('status-emoji').textContent = '✅';
            document.getElementById('status-text').textContent = 'Usuario activo';
            generarPIN();
        }

        // ═══════════════════════════════════════════════════════════
        // STATS
        // ═══════════════════════════════════════════════════════════
        function actualizarEstadisticas() {
            document.getElementById('total-usuarios').textContent = usuarios.length;
            const activos = usuarios.filter(u => u.activo).length;
            document.getElementById('usuarios-activos').textContent = activos;
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
        // EDIT FUNCTION (para llamar desde tu tabla)
        // ═══════════════════════════════════════════════════════════
        function editarUsuario(id) {
            const user = usuarios.find(u => u.id === id);
            if (!user) return;

            editingId = id;

            // Populate form
            document.querySelectorAll('.avatar-option').forEach(el => {
                el.classList.toggle('selected', el.textContent.trim() === user.avatar);
            });
            document.getElementById('avatar-input').value = user.avatar;
            document.getElementById('nombre-completo').value = user.nombre;
            document.getElementById('email').value = user.email;
            document.getElementById('telefono').value = user.telefono || '';

            document.querySelectorAll('.role-card').forEach(el => {
                const roleName = el.querySelector('.role-name').textContent;
                el.classList.toggle('selected', roleName === user.rol);
            });
            document.getElementById('rol-input').value = user.rol;

            document.getElementById('pin-display').textContent = user.pin;
            document.getElementById('pin-input').value = user.pin;
            document.getElementById('password').value = user.password;

            userStatus = user.activo;
            document.getElementById('status-toggle').classList.toggle('active', userStatus);
            document.getElementById('status-emoji').textContent = userStatus ? '✅' : '⛔';
            document.getElementById('status-text').textContent = userStatus ? 'Usuario activo' : 'Usuario inactivo';

            // Update UI
            document.getElementById('form-title').innerHTML = 'Editar <em>usuario</em>';
            document.getElementById('submit-text').textContent = 'Actualizar';
            document.getElementById('edit-mode-badge').classList.add('show');
            document.getElementById('edit-user-name').textContent = user.nombre;

            // Scroll to top
            document.querySelector('.left-panel').scrollTop = 0;
        }

        // ═══════════════════════════════════════════════════════════
        // DELETE FUNCTION (para llamar desde tu tabla)
        // ═══════════════════════════════════════════════════════════
        function eliminarUsuario(id) {
            const user = usuarios.find(u => u.id === id);
            if (!user) return;
            if (!confirm(`¿Eliminar a "${user.nombre}"?`)) return;

            usuarios = usuarios.filter(u => u.id !== id);
            actualizarEstadisticas();
            showToast(`🗑️ ${user.nombre} eliminado`);

            // AQUÍ LLAMA A TU FUNCIÓN DE RENDERIZADO DE TABLA
            // Ejemplo: renderTabla();
        }
    </script>
</body>

</html>