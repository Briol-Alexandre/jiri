<?php

use App\Models\Jiri;
use Livewire\Component;

new class extends Component {

    public Jiri $jiri;

    public function mount(string $model_id)
    {
        $this->jiri = Jiri::findOrFail($model_id);
    }

    public function delete(): void
    {
        $this->jiri->delete();
        $this->dispatch('jiris_list_changed');
        $this->dispatch('close_modal');
    }
};
?>

<div class="absolute top-0 right-0">
    <button wire:click="delete()">
        Êtes-vous sûr ?
    </button>
</div>
