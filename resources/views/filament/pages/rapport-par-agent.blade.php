<x-filament::page>
    <div class="p-0 space-y-2" style="width: 100%; font-size: 14px">

        <div class="flex items-center gap-x-4">
            <form method="GET" class="flex items-center gap-x-4">
                <label for="date">Choisissez la Date : </label>
                <x-filament::input.wrapper>
                    <x-filament::input
                        type="date"
                        name="date"
                        id="date"
                        value="{{ request('date') }}"
                    />

                    <input type="hidden" name="user" value="{{ request('user') }}">
                </x-filament::input.wrapper>

                    <x-filament::button
                        color="primary"
                        tag="button"
                        icon='heroicon-o-funnel'
                        type="submit"
                    >
                    {{ 'Filtrer' }}
                </x-filament::button>
            </form>

            @if(request('user'))
                <x-filament::button
                    color="danger"
                    tag="button"
                    icon='heroicon-o-document-arrow-up'
                    type="button"
                    wire:click="export({{ request('user') }}, '{{ request('date') }}')"
                >
                {{ 'Exporter Excel' }}
                </x-filament::button>
            @endif
        </div>

        <!-- Menu vertical des utilisateurs -->
        <div>
            <h3 class="text-lg font-bold mb-4">Utilisateurs</h3>
            <ul class="flex bg-gray-50 border bg-white dark:bg-gray-900 dark:border-gray-700 p-1 rounded-lg" style="overflow-x: scroll; scrollbar-width: none !important;">
                @foreach($this->getUsersWithEcritures() as $user)
                    <li>
                        <a href="?user={{ $user->id }}&name={{  $user->name  }}&date={{ request('date') }}"
                           class="block px-3 py-1 dark:text-gray-400 @if(request('user') == $user->id) border dark:border-gray-600 border-gray-200 rounded-lg bg-gray-200 dark:bg-gray-600 dark:text-white @endif">
                            {{ Illuminate\Support\Str::limit($user->name, 8, '..') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>


        <!-- Contenu des écritures -->
        <div class="rounded-md p-0" style="overflow-x: scroll">
            @if(request('user'))
                <h3 class="text-lg font-semibold w-full">Rapport de #{{ request('name') }}</h3>

                <table class="table-auto rounded-lg overflow-x-scroll bg-white dark:bg-gray-900 border dark:border-gray-700 mt-2 mx-0" style="width: 100%">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="px-4 py-2 border border-black dark:border-gray-800">Libelle</th>
                            <th colspan="4" class="px-4 py-2 border border-black dark:border-gray-800 text-center">Entrée</th>
                            <th colspan="4" class="px-4 py-2 border border-black dark:border-gray-800 text-center">Sortie</th>
                            <th colspan="4" class="px-4 py-2 border border-black dark:border-gray-800 text-center">Balance</th>
                        </tr>
                        <tr class="">
                            <th class="px-4 py-2 border dark:border-gray-700"></th>
                            @foreach($this->devises as $devise)
                                <th class="px-4 py-2 border dark:border-gray-700">{{ $devise }}</th>
                            @endforeach
                            @foreach($this->devises as $devise)
                                <th class="px-4 py-2 border dark:border-gray-700">{{ $devise }}</th>
                            @endforeach
                            @foreach($this->devises as $devise)
                                <th class="px-4 py-2 border dark:border-gray-700">{{ $devise }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $ecritures = $this->getEcrituresForTable(request('user'), request('date'));
                            $total = [
                                'entree_cdf' => 0, 'entree_usd' => 0, 'entree_eur' => 0, 'entree_cfa' => 0,
                                'sortie_cdf' => 0, 'sortie_usd' => 0, 'sortie_eur' => 0, 'sortie_cfa' => 0,
                            ];
                        @endphp

                        @foreach($ecritures as $row => $ecriture)
                            @php
                                // Additionner les montants pour le total
                                $total['entree_cdf'] += (float) $ecriture['entree_cdf'] ?? 0;
                                $total['entree_usd'] += (float) $ecriture['entree_usd'] ?? 0;
                                $total['entree_eur'] += (float) $ecriture['entree_eur'] ?? 0;
                                $total['entree_cfa'] += (float) $ecriture['entree_cfa'] ?? 0;
                                $total['sortie_cdf'] += (float) $ecriture['sortie_cdf'] ?? 0;
                                $total['sortie_usd'] += (float) $ecriture['sortie_usd'] ?? 0;
                                $total['sortie_eur'] += (float) $ecriture['sortie_eur'] ?? 0;
                                $total['sortie_cfa'] += (float) $ecriture['sortie_cfa'] ?? 0;
                            @endphp

                            <tr>
                                <td class="px-4 py-2 border dark:border-gray-700">{{ ucfirst($ecriture['type']) }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }}">{{ $ecriture['entree_cdf'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }}">{{ $ecriture['entree_usd'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('EUR', $this->devises) ? '': 'none' }}">{{ $ecriture['entree_eur'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CFA', $this->devises) ? '': 'none' }}">{{ $ecriture['entree_cfa'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }}">{{ $ecriture['sortie_cdf'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }}">{{ $ecriture['sortie_usd'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('EUR', $this->devises) ? '': 'none' }}">{{ $ecriture['sortie_eur'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CFA', $this->devises) ? '': 'none' }}">{{ $ecriture['sortie_cfa'] }}</td>
                                @if ($row === 0)
                                    <td rowspan="{{ count($ecritures) }}" class="px-4 py-2 border dark:border-gray-700"
                                        style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                                        </svg>
                                    </td>
                                    <td rowspan="{{ count($ecritures) }}" class="px-4 py-2 border dark:border-gray-700"
                                        style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                                        </svg>
                                    </td>
                                    <td rowspan="{{ count($ecritures) }}" class="px-4 py-2 border dark:border-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                                        </svg>
                                    </td>
                                    <td rowspan="{{ count($ecritures) }}" class="px-4 py-2 border dark:border-gray-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                                        </svg>
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                        <!-- Ligne Total -->
                        <tr class="font-bold bg-gray-200 dark:bg-gray-700">
                            <td class="px-4 py-2 border dark:border-gray-700">Total</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }} ">{{ $total['entree_cdf'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }} ">{{ $total['entree_usd'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('EUR', $this->devises) ? '': 'none' }} ">{{ $total['entree_eur'] }}</td>
                            <td class="px-4 py-2 border border-r-2 dark:border-gray-700" style="display: {{ array_search('CFA', $this->devises) ? '': 'none' }} ">{{ $total['entree_cfa'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }} ">{{ $total['sortie_cdf'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }} ">{{ $total['sortie_usd'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('EUR', $this->devises) ? '': 'none' }} ">{{ $total['sortie_eur'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CFA', $this->devises) ? '': 'none' }} ">{{ $total['sortie_cfa'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }} ">{{ $total['entree_cdf'] - $total['sortie_cdf'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }} ">{{ $total['entree_usd'] - $total['sortie_usd'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('EUR', $this->devises) ? '': 'none' }} ">{{ $total['entree_eur'] - $total['sortie_eur'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CFA', $this->devises) ? '': 'none' }} ">{{ $total['entree_cfa'] - $total['sortie_cfa'] }}</td>
                        </tr>
                    </tbody>

                </table>

            @else
                <div class="flex items-center justify-center mt-6 py-6">
                    <p class="text-gray-500">Sélectionnez un utilisateur pour voir son rapport.</p>
                </div>
            @endif
        </div>
    </div>
</x-filament::page>

