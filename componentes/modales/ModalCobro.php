<div class="modal-overlay" id="modal-cobro">
    <div class="modal-cobrar">
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
                <input type="number" id="pago-con" placeholder="0.00" oninput="calculaCambio()" />
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