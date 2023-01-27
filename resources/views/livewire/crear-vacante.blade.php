<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='crearVacante'>
    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        <x-text-input id="titulo" class="block mt-1 w-full" type="text" wire:model="titulo" :value="old('titulo')" placeholder="Titulo Vacante"/>
        {{-- <x-input-error :messages="$errors->get('titulo')" class="mt-2" /> --}}
        @error('titulo')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario Vacante')" />
        <select wire:model="salario" id="salario"class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
            <option value=""  >-- Seleccione --</option>
            @foreach ($salarios as $salario )
                <option value="{{$salario->id}}">{{$salario->salario}}</option>
            @endforeach
        </select>
        @error('salario')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select wire:model="categoria" id="categoria"class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full" required>
            <option value="" >-- Selecciona un Rol --</option>
            @foreach ($categorias as $categoria )
                <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
            @endforeach
        </select>
        @error('categoria')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" :value="old('empresa')" placeholder="Empresa"/>
        @error('empresa')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo dia para postularse')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" :value="old('ultimo_dia')" />
        @error('ultimo_dia')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripcion del puesto')" />
        <textarea wire:model="descripcion" id="descripcion" placeholder="Descripción del puesto" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-72">

        </textarea>
        @error('descripcion')
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen Vacante')" />
        <x-text-input id="imagen" class="block mt-1 w-full" type="file" wire:model="imagen" accept="image/*"/>
        <div class="my-5 w-80">
            @if ($imagen)
            <img src="{{$imagen->temporaryUrl()}}">
            @endif
        </div>
        @error('imagen')
            <livewire:mostrar-alerta :message="$message" />
        @enderror

    </div>

    <x-primary-button>
        Crear Vacante
    </x-primary-button>
</form>