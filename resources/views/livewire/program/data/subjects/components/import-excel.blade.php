<div>
    @if($enableAddsubjectsState == true)
        <x-card class="bg-gray-50" subtitle="Import excel" shadow separator>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-3/5 sm:flex-none xl:mb-0 xl:w-3/5">
                    <x-file wire:model.live="file" label="File of subjects" hint="Only Excel" spinner accept=".xlsx" />
                </div>
                <div class="w-full max-w-full py-10 px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/5">
                    <x-button wire:click="enableAddsubjects" class="btn btn-error btn-sm" label="Cancel" />
                </div>
            </div>
        </x-card>
    @endif
</div>
