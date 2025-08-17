<div>
    @if($addSpecializationState == true)
        <x-card class="bg-gray-50" subtitle="Add specialization" shadow separator>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/5">
                    <x-input wire:model="code" label="Code"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/5">
                    <x-input wire:model="abbrev" label="Abbreviation"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/5 sm:flex-none xl:mb-0 xl:w-2/5">
                    <x-input wire:model="name" label="Name"/>
                </div>
                <div class="w-full max-w-full px-3 py-10 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/5">
                    <x-button wire:click="enableAddSpecialization" class="btn btn-error btn-sm" label="Cancel" />
                    <x-button wire:click="save" class="btn btn-success btn-sm" label="Save"/>
                </div>
        </x-card>
    @endif
    {{-- Success is as dangerous as failure. --}}
</div>
