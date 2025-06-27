<x-filament-panels::page>
    <form wire:submit="submit">
        {{ $this->form }}

        <br>
        <x-filament::button style="background:#0D0D0D" type="submit" form="submit">
            Atualizar dados
        </x-filament::button>
    </form>
</x-filament-panels::page>
