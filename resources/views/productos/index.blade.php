<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="row bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="col-md-12">
                    <div class="">
                        <a type="submit" class="btn btn-success m-3" href="{{ route('productos.create') }}">Crear</a>
                    </div>
                </div>

                <div class="col-md-12 ">
                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>DESCRIPCION</th>
                                <th>IMAGEN</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->nombre }}</td>
                                    <td>{{ $producto->descripcion }}</td>
                                    <td>
                                        <img src="/imagen/{{ $producto->imagen }}" alt="">
                                    </td>
                                    <td>
                                        {{-- Edit --}}
                                        <a class="btn btn-info"
                                            href="{{ route('productos.edit', ['producto' => $producto->id]) }}">Edit</a>

                                        {{-- Edit --}}
                                        <form class="formEliminar"
                                            action="{{ route('productos.destroy', ['producto' => $producto->id]) }}"
                                            method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                {!! $productos->links() !!}
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    (function() {
        'use strict'
        //debemos crear la close formELiminar dentro del form del boton borrar
        //recordar que cada registro a eliminor esto contenido en un form
        var forms - document.querySelectorAll('.formEliminar')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventlistener('submit', function(event) {
                    event.preventDefault()
                    event.stopPropagation()

                    Swal.fire({
                        title: '¿Desea elimnar el registro?',
                        text: "Este sera elimnado permanentemente",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                            Swal.fire(
                                'Elimiando!',
                                'El registro se ha elimando con exito.',
                                'success'
                            )
                        }
                    })

                }, false)
            })
    })()
</script>
