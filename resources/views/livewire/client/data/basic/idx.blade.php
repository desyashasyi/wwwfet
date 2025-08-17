<div>
    {{-- Be like water. --}}
    <x-card title="Admin | Basic data" shadow separator>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-2/4">
                <x-input label="Universitas" value="{{$client->university->code}} | {{$client->university->name}}" class="input-md" readonly/>
            </div>

            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-2/4">
                <x-input label="Fakultas" value="{{$client->faculty->code}} | {{$client->faculty->name}}" class="input-md" readonly/>
            </div>
        </div>
        <br/>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mb-6 sm:w-3/4 sm:flex-none xl:mb-0 xl:w-3/4">
                <x-input label="Description" value="{{$client->description}}" class="input-md">
                </x-input>
            </div>
        </div>

        <br/>

        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mb-6 sm:w-2/4 sm:flex-none xl:mb-0 xl:w-2/4">
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/6 sm:flex-none xl:mb-0 xl:w-2/6">
                    <x-input label="Days" wire:model="numberOfDays" class="input-md text-center">
                        <x-slot:prepend>
                            <x-button label="-" wire:click="daysDecrement" class="btn-primary rounded-e-none"/>
                        </x-slot:prepend>
                        <x-slot:append>
                            <x-button label="+" wire:click="daysIncrement" class="btn-primary rounded-s-none"/>
                        </x-slot:append>
                    </x-input>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/1 sm:flex-none xl:mb-0 xl:w-1/1">
                </div>
            </div>

            <div class="w-full max-w-full px-3 mb-6 sm:w-2/4 sm:flex-none xl:mb-0 xl:w-2/4">
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/6 sm:flex-none xl:mb-0 xl:w-2/6">
                    <x-input label="Hours" wire:model="numberOfHours" class="input-md text-center">
                        <x-slot:prepend >
                            <x-button label="-" wire:click="hoursDecrement" class="btn-primary rounded-e-none"/>
                        </x-slot:prepend>
                        <x-slot:append>
                            <x-button label="+" wire:click="hoursIncrement" class="btn-primary rounded-s-none"/>
                        </x-slot:append>
                    </x-input>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/1 sm:flex-none xl:mb-0 xl:w-1/1">
                </div>
            </div>
        </div>
    </x-card>
</div>
