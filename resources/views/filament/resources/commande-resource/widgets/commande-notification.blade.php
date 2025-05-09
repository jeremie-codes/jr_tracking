<x-filament-widgets::widget>
    <x-filament::section class="" style="height: 260px; overflow-y: hidden;">
        <x-slot name="heading">
            <div class="flex gap-x-2 justify-start">
                <x-filament::badge color="danger" class="relative">
                    <x-filament::icon
                        icon="heroicon-m-bell"
                        class="h-7 w-7  {{ count($this->getCommandes()) === 0 ? 'text-gray-500 dark:text-gray-400': '' }}"
                        style="{{ count($this->getCommandes()) === 0 ? '': 'color: orange;' }}"
                    />
                    <span class="text-xs absolute top-0">{{ count($this->getCommandes()) }}</span>
                </x-filament::badge>

                <div class="text-lg font-semibold text-gray-700 dark:text-white">
                    Notifications
                </div>
            </div>
        </x-slot>

        <style>
            @media (max-width: 780px) {
                .note {
                    width: 100%;
                }
            }
        </style>

        <div class="py-5 pt-0 md:flex flex-wrap" style=" padding-right: 5px; height: 180px; overflow-y: scroll; scrollbar-width: {{ count($this->getCommandes()) >= 3 ? '1px': 'none' }};">
            @foreach ($this->getCommandes() as $notification)
                <div class="note p-1 w-1/2">
                    <div class="p-4 bg-gray-500 dark:bg-gray-800 shadow rounded-lg w-full">
                        <div class="text-sm text-gray-700 dark:text-white">
                            @if ($notification->type === 'approvisionnement')
                                <span class="text-gray-700 dark:text-white">{{ $notification->person_id !== $notification->see_id ? $notification->person->name : $notification->user->name }}</span>
                                <span class="text-gray-700 dark:text-white">{{ $notification->person_id !== $notification->see_id ? 'veut vous approvisionner': 'à modifier votre demande' }}</span>
                            @elseif ($notification->type === 'retrait')
                                <span class="text-gray-700 dark:text-white">{{ $notification->person->name }}</span>
                                <span class="text-gray-700 dark:text-white"> veut la confirmation sur un retrait de:</span>
                            @elseif ($notification->type === 'depot')
                                <span class="text-gray-700 dark:text-white">{{ $notification->person->name }}</span>
                                <span class="text-gray-700 dark:text-white">a demandé un dépot de:</span>
                            @else
                                <span class="text-gray-700 dark:text-white">{{ $notification->person_id !== $notification->see_id ? $notification->person->name : $notification->user->name }}</span>
                                <span class="text-gray-700 dark:text-white">{{ $notification->person_id !== $notification->see_id ? 'a demandé un approvisionnement de:': 'à modifier votre demande' }}</span>
                            @endif

                            <br>

                            <span class="text-gray-700 dark:text-gray-400">Montant: <span>
                                <span class="text-gray-700 dark:text-white">{{ $notification->montant }} {{ $notification->devise->code }}</span> <br>
                                <span class="text-gray-700 dark:text-gray-400">Pour:<span>
                            <span class="text-gray-700 dark:text-white">{{ $notification->article->name }} {{ $notification->libelle }} ({{ $notification->numero}})</span> <br>
                            <span class="text-gray-400">{{ $notification->created_at->locale('fr')->diffForHumans() }}</span>
                        </div>
                        <div class="flex justify-start gap-x-3 space-x-2 mt-4">
                            <x-filament::button
                                color="success"
                                tag="button"
                                type="submit"
                                wire:click.prevent="approveCommande({{ $notification->id }})"
                            >
                                {{ $notification->type !== 'retrait' && $notification->type !== 'depot' ? 'Approuver': 'Confirmer' }}
                            </x-filament::button>

                            @if ($notification->type !== 'retrait' && $notification->type !== 'depot' && $notification->person_id !== $notification->see_id && $notification->type !== 'approvisionnement')
                                <x-filament::button
                                    color="primary"
                                    tag="button"
                                    type="submit"
                                    wire:click.prevent="modifyCommande({{ $notification->id }})"
                                >
                                    {{ 'Modifier' }}
                                </x-filament::button>
                            @endif
                            <x-filament::button
                                color="danger"
                                tag="button"
                                type="submit"
                                wire:click="cancelCommande({{ $notification->id }})"
                            >
                                {{ $notification->type !== 'retrait' && $notification->type !== 'depot' ? 'Annuler': 'Refuser' }}
                            </x-filament::button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
