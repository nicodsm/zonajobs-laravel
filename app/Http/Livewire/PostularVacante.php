<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;

    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf',
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }


    public function postularme()
    {

        $request = $this->validate();

        // Almacenar el cv en storage

        $cv = $this->cv->store('cv');
        $request['cv'] = str_replace('cv/', '', $cv);


        // Crear vacante

        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv'      => $request['cv'],

        ]);

        // Crear notificacion y enviar email

        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo, auth()->user()->id));

        // mensaje de vacante creada ok

        session()->flash('mensaje', 'Se envio correctamente tu informacion');

        return redirect()->back();
    }
    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
