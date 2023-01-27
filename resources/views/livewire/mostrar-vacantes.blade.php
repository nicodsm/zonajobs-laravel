<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @forelse ($vacantes as $vacante )
            <div class="p-6 bg-white border-b border-gray-200 text-gray-900 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">{{$vacante->titulo}}</a>
                    <p class="text-sm text-gray-600 font-bold">{{$vacante->empresa}}</p>
                    <p class="text-sm text-gray-500">Ultimo día: {{$vacante->ultimo_dia->format('d-m-Y')}}</p>
                </div>
                <div class="flex flex-col items-strech gap-3  mt-5 md:mt-0">
                    <a href="{{ route('candidatos.index', $vacante) }}" class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        {{$vacante->candidatos->count()}}
                        Candidatos
                    
                    </a>
                    <a href="{{route('vacantes.edit', $vacante->id)}}" class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">Editar</a>
                    <button 
                        wire:click="$emit('mostrarAlerta', {{ $vacante->id }})"
                        class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                        Eliminar
                    </button>

                </div>
            </div>
        @empty
            <div class="p-3 text-center text-sm text-gray-600">No hay vacantes para mostrar</div>
        @endforelse
    </div>
    <div class="mt-10">
        {{$vacantes->links()}}
    </div>
</div>

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('mostrarAlerta', vacanteId => {
            Swal.fire({
                title: '¿Eliminar Vacante?',
                text: "Una vacante eliminada no se puede recuperar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('eliminarVacante', vacanteId)

                    Swal.fire(
                    'Vacante Eliminada!',
                    'Tu vacante fue eliminada',
                    'success'
                    )
                }
            })
        })
    </script>
    {{-- <script>
        Swal.fire({
            title: '¿Eliminar Vacante?',
            text: "Una vacante eliminada no se puede recuperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
            'Vacante Eliminada!',
            'Tu vacante fue elimianda',
            'success'
            )
        }
        })
    </script> --}}
@endpush

