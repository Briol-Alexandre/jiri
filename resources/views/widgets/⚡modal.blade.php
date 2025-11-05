<?php

use Livewire\Component;

new class extends Component {
    public ?string $current = null;
    public string $key = '';
    public string $model_id = '';

};
?>

<div>
    @if(!is_null($current))
        <livewire:is :component="$current" :key="$key" :model_id="$model_id"/>
    @endif
</div>
