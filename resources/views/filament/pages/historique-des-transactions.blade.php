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

                    <input type="hidden" name="article" value="{{ request('article') }}">
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

            @if(request('article'))
                <x-filament::button
                    color="danger"
                    tag="button"
                    icon='heroicon-o-document-arrow-up'
                    type="button"
                    wire:click="export({{ request('article') }}, '{{ request('date') }}')"
                >
                {{ 'Exporter Excel' }}
                </x-filament::button>
            @endif
        </div>

        <!-- Menu vertical des utilisateurs -->
        <div>
            <h3 class="text-lg font-bold mb-4">Articles</h3>
            <ul class="flex bg-gray-50 border bg-white dark:bg-gray-900 dark:border-gray-700 p-1 rounded-lg" style="overflow-x: scroll; scrollbar-width: none !important;">
                @if (Illuminate\Support\Facades\Auth::user()->role === 'Admin')
                    <li>
                        <a href="?name=CalculFinal&date={{ request('date') }}"
                        class="block px-3 py-1 dark:text-gray-400 @if(request('name') === 'CalculFinal') border dark:border-gray-600 border-gray-200 rounded-lg bg-gray-200 dark:bg-gray-600 dark:text-white @endif">
                            Calcul Final
                        </a>
                    </li>
                @endif

                @foreach($this->getArticlesWithTransaction() as $article)
                    <li>
                        <a href="?article={{ $article->id }}&name={{  $article->name  }}&date={{ request('date') }}"
                           class="block px-3 py-1 dark:text-gray-400 @if(request('article') == $article->id) border dark:border-gray-600 border-gray-200 rounded-lg bg-gray-200 dark:bg-gray-600 dark:text-white @endif">
                            {{ ucfirst(Illuminate\Support\Str::limit($article->name, 9, '.')) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>


        <!-- Contenu des écritures -->
        <div class="rounded-md p-0" style="overflow-x: scroll">
            @if(request('article'))
                <h3 class="text-lg font-semibold w-full">Rapport #<span style="color: #92c7ff">{{ ucfirst(request('name')) }}</span></h3>

                <table class="table-auto rounded-lg overflow-x-scroll bg-white dark:bg-gray-900 border dark:border-gray-700 mt-2 mx-0" style="width: 100%">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="px-4 py-2 border border-black dark:border-gray-800" rowspan="2">Nom de l'agent</th>
                            <th class="px-4 py-2 border border-black dark:border-gray-800" rowspan="2">Numéro AG</th>
                            <th colspan="{{ count($this->devises) }}" class="px-4 py-2 border border-black dark:border-gray-800 text-center">Dépôt</th>
                            <th colspan="{{ count($this->devises) }}" class="px-4 py-2 border border-black dark:border-gray-800 text-center">Retrait</th>
                        </tr>
                        <tr class="">
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
                            $transacts = $this->getTransactionForTable(request('article'), request('date'));
                            $total = [
                                'depot_cdf' => 0, 'depot_usd' => 0, 'retrait_cdf' => 0,
                                'retrait_usd' => 0, 'retrait_eur' => 0, 'retrait_cfa' => 0,
                            ];
                        @endphp

                        @foreach($transacts as $row => $transact)
                            @php
                                // Additionner les montants pour le total
                                $total['depot_cdf'] += (float) $transact['depot_cdf'] ?? 0;
                                $total['depot_usd'] += (float) $transact['depot_usd'] ?? 0;
                                $total['retrait_cdf'] += (float) $transact['retrait_cdf'] ?? 0;
                                $total['retrait_usd'] += (float) $transact['retrait_usd'] ?? 0;
                            @endphp

                            <tr>
                                <td class="px-4 py-2 border dark:border-gray-700">{{ ucfirst($transact['client']) }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700">{{ $transact['numero'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }}">{{ $transact['depot_cdf'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }}">{{ $transact['depot_usd'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }}">{{ $transact['retrait_cdf'] }}</td>
                                <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }}">{{ $transact['retrait_usd'] }}</td>
                            </tr>
                        @endforeach

                        <!-- Ligne Total -->
                        <tr class="font-bold bg-gray-200 dark:bg-gray-800">
                            <td colspan="2" class="px-4 py-2 border dark:border-gray-800 text-center">Total {{ ucfirst(request('name')) }} -></td>
                            <td class="px-4 py-2 border dark:border-gray-800" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }} ">{{ $total['depot_cdf'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-800" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }} ">{{ $total['depot_usd'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-800" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }} ">{{ $total['retrait_cdf'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-800" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }} ">{{ $total['retrait_usd'] }}</td>
                        </tr>
                    </tbody>

                </table>

            @else
                @if (Illuminate\Support\Facades\Auth::user()->role === 'Admin')
                <h3 class="text-lg font-semibold w-full"><span style="color: #92c7ff">Calcul Final</span></h3>

                <table class="table-auto rounded-lg overflow-x-scroll bg-white dark:bg-gray-900 border dark:border-gray-700 mt-2 mx-0" style="width: 100%">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="px-4 py-2 border border-black dark:border-gray-800" colspan="{{ count($this->devises) }}" >Total Dépôt</th>
                            <th class="px-4 py-2 border border-black dark:border-gray-800" colspan="{{ count($this->devises) }}" >Total Retrait</th>
                        </tr>
                        <tr class="bg-gray-200 dark:bg-gray-500">
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
                            $total = $this->getCalculFinal(request('date'));
                        @endphp

                        <tr class="text-center">
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }}">{{ $total['depot_cdf'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }}">{{ $total['depot_usd'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('CDF', $this->devises) ? '': 'none' }}">{{ $total['retrait_cdf'] }}</td>
                            <td class="px-4 py-2 border dark:border-gray-700" style="display: {{ array_search('USD', $this->devises) ? '': 'none' }}">{{ $total['retrait_usd'] }}</td>
                        </tr>

                    </tbody>

                </table>
                @else
                    <div class="flex items-center justify-center mt-6 py-6">
                        <p class="text-gray-500">Sélectionnez un article pour voir son rapport.</p>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-filament::page>
