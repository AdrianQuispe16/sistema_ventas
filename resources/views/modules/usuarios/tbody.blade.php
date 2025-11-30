 @foreach ($items as $item)
 <tr class="text-center">
  <td>{{ $item->email }}</td>
  <td>{{ $item->name }}</td>
  <td>{{ $item->rol}}</td>
  <td>
    <a class="btn btn-secondary btn-sm" 
      data-bs-toggle="modal" 
      data-bs-target="#modalCambiarPassword"
      onclick="agregarIdUsuario({{ $item->id }})">
      <span class="fa-stack fa-sm">
        <i class="fa fa-user fa-stack-1x"></i>
        <i class="fa fa-lock fa-stack-2x" style="font-size:12px; margin-left:12px; margin-top:12px;"></i>
      </span>
    </a>
  </td>
  <td>
      <div class="form-check form-switch d-flex justify-content-center">
        <input class="form-check-input" type="checkbox" role="switch" id="{{ $item->id }}"
         {{ $item->activo ? 'checked' : '' }}>
      </div>
  </td>
  <td>
    <a href="{{route("usuarios.edit", $item->id)}}" class="btn btn-warning btn-sm">
      <i class="fa fa-edit"></i> Editar
    </a>
  </td>
  </tr>
@endforeach