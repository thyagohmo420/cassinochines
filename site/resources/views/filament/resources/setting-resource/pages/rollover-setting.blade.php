<x-filament-panels::page>
    <form method="post" wire:submit="save">
        {{ $this->form }}
        <button style="background:#0D0D0D" type="submit" class="mt-4 bg-primary-500 w-40 hover:bg-primary-600 rounded-lg text-white font-bold py-2 px-3">
            Salvar Informações
        </button>
    </form>
</x-filament-panels::page>
