@php
    $devises = App\Models\Devise::all();
@endphp

<x-filament-widgets::widget>
    <x-filament::section>
        <form method="post" action="#!" class="my-auto">
            @csrf

            <div class="fs-italic card-header mb-2">
                <h6>Convertisseur de monnaie</h6>
            </div>

            <div class="text-center items-center card-body flex justify-center gap-x-3 w-100 mb-0 pb-0">
                <x-filament::input.wrapper>
                    <x-filament::input.select wire:model="status" class="border p-1">
                        @foreach($devises as $devise)
                            <option value="{{ $devise->code }}">{{ $devise->code }}</option>
                        @endforeach
                    </x-filament::input.select>
                </x-filament::input.wrapper>

                <div>
                    <div style="transform: rotateZ(90deg)" class="">
                        <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.8397 20.1642V6.54639" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M20.9173 16.0681L16.8395 20.1648L12.7617 16.0681" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M6.91102 3.83276V17.4505" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                        <path d="M2.8335 7.92894L6.91127 3.83228L10.9891 7.92894" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </div>

                <x-filament::input.wrapper>
                    <x-filament::input.select wire:model="status" class="border p-1">
                        @foreach($devises as $devise)
                            <option value="{{ $devise->code }}">{{ $devise->code }}</option>
                        @endforeach
                    </x-filament::input.select>
                </x-filament::input.wrapper>
            </div>

            <div class="align-center flex justify-between mt-2 gap-x-1">
                <x-filament::input.wrapper :valid="! $errors->has('name')">
                    <x-filament::input
                        type="numeric"
                        wire:model="name"
                    />
                </x-filament::input.wrapper>

                <x-filament::input.wrapper :valid="! $errors->has('name')">
                    <x-filament::input
                        type="text"
                        wire:model="name"
                        value="0"
                        disabled
                    />
                </x-filament::input.wrapper>

            </div>

            <div class="mt-2 flex justify-center">
                {{-- <button class="btn btn-info btn-sm">Convertir</button> --}}
                <x-filament::button
                        color="primary"
                        tag="button"
                        type="button"
                    >
                        {{ 'convertir' }}
                    </x-filament::button>
                </form>
            </div>
        </form>
    </x-filament::section>
</x-filament-widgets::widget>
