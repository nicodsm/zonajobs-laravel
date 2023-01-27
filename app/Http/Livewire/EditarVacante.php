<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Vacante;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class EditarVacante extends Component
{
    public $vacante_id;
    public $titulo;
    public $empresa;
    public $descripcion;
    public $imagen;
    public $salario;
    public $categoria;
    public $ultimo_dia;
    public $imagen_nueva;

    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen_nueva' => 'nullable|image|max:5000',

    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante_id = $vacante->id;
        $this->titulo = $vacante->titulo;
        $this->empresa = $vacante->empresa;
        $this->descripcion = $vacante->descripcion;
        $this->imagen = $vacante->imagen;
        $this->salario = $vacante->salario_id;
        $this->categoria = $vacante->categoria_id;
        $this->ultimo_dia = Carbon::parse($vacante->ultimo_dia)->format('Y-m-d');


    }

    public function editarVacante()
    {
        $datos = $this->validate();

        // Encontrar las vacantes a editar
        $vacante = Vacante::find($this->vacante_id);

        // Verificar si hay nueva imagen
        if($this->imagen_nueva){
            $imagen = $this->imagen_nueva->store('vacantes');
            $datos['imagen'] = str_replace('vacantes/', '', $imagen);
            Storage::delete('public/vacantes/'.$vacante->imagen);

        }


        // Asignar los valores
        $vacante->titulo = $datos['titulo'];
        $vacante->salario_id = $datos['salario'];
        $vacante->categoria_id = $datos['categoria'];
        $vacante->empresa = $datos['empresa'];
        $vacante->ultimo_dia = $datos['ultimo_dia'];
        $vacante->descripcion = $datos['descripcion'];
        $vacante->imagen = $datos['imagen'] ?? $vacante->imagen;
        // Guardar las vacantes
        $vacante->save();

        // Redireccionar
        session()->flash('mensaje', 'La vacante se actualizo Correctamente');

        return redirect()->route('vacantes.index');
    }


    public function render()
    {
        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.editar-vacante', [
            'salarios'   => $salarios,
            'categorias' => $categorias,
        ]);
    }
}
