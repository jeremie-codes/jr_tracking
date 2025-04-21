<x-filament-panels::page>

    <x-filament::modal >
        <x-slot name="trigger" disabled style="max-width: 170px; align-self:flex-end;">
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
                    wire:click="getCreateEntréesPage()"
                    color="info"
                >
                    Écriture d'entrée
                </x-filament::button>

                <br>

                <x-filament::button class="ml-auto"
                    wire:click="getCreateSortiesPage()"
                    color="info"
                >
                    Écriture de sortie
                </x-filament::button>

                <br>

                <x-filament::button class="ml-auto"
                    wire:click="getCreatePlusieursMouvementsPage()"
                    color="info"
                >
                    Plusieurs mouvement
                </x-filament::button>

            </div>
        </div>
    </x-filament::modal>

    <x-filament::tabs label="Content tabs">
        <x-filament::tabs.item
            icon="heroicon-o-arrow-down-on-square-stack"
            :active="$this->activeTab === 'tab1'"
            wire:click="setActiveTab('tab1')"
        >
            Histoirique Entrées
        </x-filament::tabs.item>

        <x-filament::tabs.item
            icon="heroicon-o-arrow-up-on-square-stack"
            :active="$this->activeTab === 'tab2'"
            wire:click="setActiveTab('tab2')"
        >
            Histoirique Sorites
        </x-filament::tabs.item>
    </x-filament::tabs>

    <!-- Contenu des onglets -->
    <div>
        {{-- <h2 class="text-lg font-bold">Historique des Entrées</h2> --}}
        {{ $this->table }}
    </div>
</x-filament-panels::page>
