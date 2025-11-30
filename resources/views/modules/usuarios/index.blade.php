@extends('layouts.main')
@section('titulo', $titulo)

@section('contenido')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Usuarios</h1>
    
  </div>
  
   <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Adminisrar Usuarios</h5>
              <p>
                Adminisrar las cuentas de los usuarios del sistema.
              </p>
              <a href="{{route("usuarios.create")}}" class="btn btn-primary mb-3" >
                  <i class="fa fa-plus"></i> Agregar Nueva Uusario
              </a>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th class="text-center">Email</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Rol</th>
                    <th class="text-center">Cambio Password</th>
                    <th class="text-center">Activo</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody id="tbody-usuarios">
                 @include('modules.usuarios.tbody', ['items' => $items])
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </section>
</main>
@include('modules.usuarios.modal_cambiar_pasword')
@endsection

@push('scripts')
  <script>
    
    function agregarIdUsuario(id_usuario){
      $('#id_usuario').val(id_usuario);
    }

    function cambio_password(){
      let id = $('#id_usuario').val();
      let password = $('#password').val();

      $.ajax({
        type: 'GET',
        url: "usuarios/cambiar-password/" + id + '/' + password,
        success: function(respuesta) {
          if(respuesta == 1){
            alert('Password actualizado correctamente');
            $('#modalCambiarPassword').modal('hide');
            $('#formCambiarPassword')[0].reset();
          } else {
            alert('Error al actualizar el password');
          }
        },
      });
      return false; // Evitar el envío del formulario
    }

    $(document).ready(function() {
      function cargarTbody() {
        $.ajax({
          url: '{{ route("usuarios.tbody") }}',
          method: 'GET',
          success: function(respuesta) {
            console.log(respuesta);
          },
        });
      }

      function cambiarEstado(id, estado) {
        $.ajax({
          url: "usuarios/cambiar-estado/" + id + '/' + estado,
          method: 'GET',
          success: function(respuesta) {
            if (respuesta == 1) {
              Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Cambio de password exitoso',
                confirmButtonText: 'Aceptar'
              });
              $('#frmPassword')[0].reset();
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo cambiar el password',
                confirmButtonText: 'Aceptar'
              });
            }
          }
        });
      }

      $(document).ready(function() {
        $('.form-check-input').on("change", function() {
          var id = $(this).attr('id');
          var estado = $(this).is(':checked') ? 1 : 0;
          cambiarEstado(id, estado);
        });
      });
    });
  </script>
@endpush