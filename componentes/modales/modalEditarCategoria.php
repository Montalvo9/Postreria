<div class="modal fade" id="editarCategoriaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-edit"></i>Editar </u>categoria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form id="frmEditarCategoria">

                <input type="hidden" id="idCategoriaSeleccionado"> 
                    <!-- Nombre de la categoria -->
                    <div class="form-group">
                        <label class="form-label" for="id-editarnombre">
                            Nombre de la categoria <span class="required">*</span>
                        </label>
                        <input type="text" class="form-input" id="id-editarnombre" placeholder="Ej: Postres" required>
                    </div>

                    <!-- icono de la categoria -->
                    <div class="form-group">
                        <label class="form-label" for="id-editaricono">
                            Icono de la categoria <span class="optional">(opcional)</span>
                        </label>
                        <input type="text" class="form-input" id="id-editaricono" placeholder="Ej: 🍰">
                    </div>

                    <!-- ACTIONS -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="cancelarFormEditar()">
                            <i class="fas fa-times"></i>
                            <span>Cancelar</span>
                        </button>

                        <button type="button" class="btn btn-primary" id="submit-btn" onclick="EditarCategoria()">
                            <i class="fas fa-check"></i>
                            <span id="submit-text">Editar categoria</span>
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>