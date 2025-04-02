<x-filament-widgets::widget>

    <x-filament::modal >
        <x-slot name="trigger" disabled>
            <x-filament::button icon="heroicon-o-plus" color="primary">
                Nouvelle écriture
            </x-filament::button>
        </x-slot>

        <x-slot name="heading">
            Veillez choisir la nature de l'écriture
        </x-slot>

        <div class="flex justify-center items-center">
            <div class="space-y-4">

                <x-filament::button class="ml-auto"
                    wire:click="input()"
                    color="info"
                >
                    Écriture d'entrée
                </x-filament::button>

                <br>

                <x-filament::button class="ml-auto"
                    wire:click="output()"
                    color="primary"
                >
                    Écriture de sortie
                </x-filament::button>

                <br>

                <x-filament::button class="ml-auto"
                    wire:click="plural()"
                    color="primary"
                >
                    Plusieurs écriture
                </x-filament::button>

            </div>
        </div>
    </x-filament::modal>

</x-filament-widgets::widget>
