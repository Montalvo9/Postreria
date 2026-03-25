<div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    <i class="fas fa-edit"></i> Editar <u>producto</u>
                </h1>

            </div>
            <div class="modal-body">
                <form id="frmEditarProducto">
                    <div class="form-section">
                        <input type="hidden" id="idProductoSeleccionado">

                        <!-- Nombre del producto-->
                        <div class="form-group">
                            <label class="form-label" for="nombre">Nombre del producto <span class="required">*</span></label>
                            <input type="text" class="form-input" name="editarNombre" id="editarNombre" placeholder="Ej: Fresas con crema" required />
                        </div>

                        <!-- Descripción -->
                        <div class="form-group">
                            <label class="form-label" for="id-descripcion">
                                Descripción <span class="required">*</span>
                            </label>
                            <textarea class="form-input" id="editar-descripcion" rows="2"></textarea>
                        </div>
                        <!-- Precio -->
                        <div class="form-group">
                            <label class="form-label" for="precio">Precio</label>
                            <input class="form-input" type="text" inputmode="decimal" id="editar-precio">
                        </div>

                        <!-- STOCK -->
                        <div class="form-group">
                            <label class="form-label" for="stock">Stock</label>
                            <input class="form-input" type="text" inputmode="numeric" id="editar-stock" require>
                        </div>

                        <!-- CATEGORIA -->
                        <div class="form-group">
                            <label class="form-label">Categoria</label>
                            <select class="form-input" name="id_categoria_modal" id="id_categoria_modal">
                                <option value="">Categoria</option>
                            </select>
                        </div>

                        <!-- ACTIVO -->
                        <div class="form-group">
                            <label class="form-label">ACTIVO</label>
                            <select class="form-input" name="activo" id="editarActivo">
                                <option value="">Selecionar</option>
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>

                        <!-- ACTIONS -->
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="cancelarFormEditar()">
                                <i class="fas fa-times"></i>
                                <span>Cancelar</span>
                            </button>

                            <button type="button" class="btn btn-primary" onclick="editarProducto()">
                                <i class="fas fa-check"></i>
                                <span id="submit-text">Editar producto</span>
                            </button>
                        </div>

                    </div>



                </form>
            </div>
        </div>
    </div>
</div>