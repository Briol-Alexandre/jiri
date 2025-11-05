<?php

use App\Models\Jiri;
use Livewire\Component;

new class extends Component {

    public Jiri $jiri;

    public function mount(string $id)
    {
        $this->jiri = Jiri::findOrFail($id);
    }

    public function delete()
    {
        $this->jiri->delete();
    }
};
?>

<div>
    <button wire:click="delete()">
        Êtes-vous sûr ?
    </button>
</div>
