<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;
use App\Providers\RouteServiceProvider;

class CrearVacante extends Component
{
    use WithFileUploads;

    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;
    

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:5000',

    ];

    public function crearVacante()
    {
        $datos = $this->validate();

        $imagen = $this->imagen->store('public/vacantes');
        $nombreImagen = str_replace('public/vacantes/', '', $imagen);

        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $nombreImagen,
            'user_id' => auth()->user()->id,
        ]);

        session()->flash('mensaje', 'La vacante se publico correctamente');

        return redirect()->route('vacantes.index');
    }

    public function render()
    {

        $salarios = Salario::all();
        $categorias = Categoria::all();

        return view('livewire.crear-vacante', [
            'salarios'   => $salarios,
            'categorias' => $categorias,
        ]);
    }

    // public function save()
    // {
    //     $this->validate([
    //         'imagen' => 'image',
    //     ]);

    //     $this->imagen->store('imagenes');
    // }
}
