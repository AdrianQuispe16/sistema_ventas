<div class="modal fade" id="modalCambiarPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form id="formCambiarPassword" onsubmit="return cambio_password();">
          <!-- HIDDEN en lugar de text -->
          <input type="hidden" name="id_usuario" id="id_usuario">
          
          <div class="mb-3">
            <label for="new_password" class="col-form-label">Nuevo Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" form="formCambiarPassword" class="btn btn-primary">Guardar</button>
      </div>

    </div>
  </div>
</div>
