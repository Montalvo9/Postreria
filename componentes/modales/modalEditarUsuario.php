<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-edit"></i>Editar <u></u>suario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="frmEditarUsuario">
                    <input type="hidden" id="idUsuarioSelecionado">
                    <!-- Nombre completo -->
                    <div class="form-group">
                        <label class="form-label" for="nombre">Nombre completo <span class="required">*</span></label>
                        <input type="text" class="form-input" id="editarNombre" placeholder="Ej: Daniela" required />
                    </div>

                    <!-- Nombre de usuario -->
                    <div class="form-group">
                        <label class="form-label" for="usuario">Nombre de usuario<span class="required">*</span></label>
                        <input type="text" class="form-input" id="editarNombreDeUsuario" placeholder="Ej: Dani" require>
                    </div>

                    <!--Contraseña -->
                    <div class="form-group">
                        <label class="form-label" for="password">Contraseña<span class="required">*</span></label>
                        <input type="password" class="form-input" id="editarPassword" require>
                    </div>

                    <!-- ROL -->
                    <div class="form-group">
                        <div class="role-grid">
                            <div class="role-card" onclick="selectRole(this, 'vendedor')">
                                <span class="role-icon"><i class="fas fa-user-tie fa-2x"></i></span>
                                <div class="role-name">Vendedor</div>
                                <div class="role-desc">Realiza ventas</div>
                            </div>

                            <div class="role-card" onclick="selectRole(this, 'admin')">
                                <span class="role-icon"><i class="fas fa-key fa-2x"></i></span>
                                <div class="role-name">Admin</div>
                                <div class="role-desc">Acceso total</div>
                            </div>

                            <input type="hidden" name="rol" id="editarRol" required />
                        </div>
                    </div>

                    <!-- ACTIVO -->
                    <div class="status-toggle-wrap">
                        <div class="status-label">
                            <span class="status-emoji" id="status-emoji">✅</span>
                            <span id="status-text">Usuario activo</span>
                        </div>
                        <div class="toggle-switch active" id="status-toggle" onclick="toggleStatus()">
                            <div class="toggle-knob"></div>
                        </div>
                        <input type="hidden" name="activo" id="editarActivo" value="1">
                    </div>


                    <!-- ACTIONS -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-secondary" onclick="cancelarForm()">
                            <i class="fas fa-times"></i>
                            <span>Cancelar</span>
                        </button>
                        <button type="button" class="btn btn-primary" id="submit-btn" onclick="registrarUsuario()">
                            <i class="fas fa-check"></i>
                            <span id="submit-text">Crear usuario</span>
                        </button>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
                <button type="button" class="btn btn-primary" onclick="editarUsuario()">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>