@php
    $user = filament()->auth()->user();
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>
        <div class="gap-x-3">
            <div class="flex items-center gap-x-3">
                {{-- <x-filament-panels::avatar.user size="lg" :user="$user" /> --}}
                <div>
                    <div class="border-2 rounded-full p-1">
                        @if ($user->avatar === null || $user->avatar === '')
                            <img src="{{ asset('assets/images/avatars/01.png') }}" class="rounded-full w-20" style="height: 80px" alt="Profile">
                        @else
                            <img src="{{ asset('storage/' . $user->avatar )}}" class="rounded-full w-20" style="height: 80px" alt="Profile">
                        @endif
                    </div>
                </div>

                <div class="flex-1">
                    <h2
                        class="grid flex-1 text-base font-semibold leading-6 text-gray-950 dark:text-white"
                    >
                        {{ __('filament-panels::widgets/account-widget.welcome', ['app' => config('app.name')]) }}
                    </h2>

                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ filament()->getUserName($user) }}
                    </p>
                </div>

                <form
                    action="{{ filament()->getLogoutUrl() }}"
                    method="post"
                    class="my-auto"
                >
                    @csrf

                    <x-filament::button
                        color="gray"
                        icon="heroicon-m-arrow-left-on-rectangle"
                        icon-alias="panels::widgets.account.logout-button"
                        labeled-from="sm"
                        tag="button"
                        type="submit"
                    >
                        {{ 'Déconnexion' }}
                    </x-filament::button>
                </form>
            </div>

            <div class="mt-1 flex items-center gap-x-3">
                <p class="text-center text-gray-600 dark:text-gray-400">
                    La patience paye, le bien mal acquis ne profite jamais et le salaire du péché c'est la mort.
                <b class="dark:text-white"> Romain 6:32  <br> <span class="text-red-100">Que Dieu vous bénisse</span></b>.
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
