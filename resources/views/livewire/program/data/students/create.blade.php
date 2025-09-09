<div>
    @if($addStudent == true)
        <x-card class="bg-gray-50" subtitle="Add teachers" shadow separator>

            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/12 sm:flex-none xl:mb-0 xl:w-2/12">
                    <x-input wire:model="batch" label="Batch"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/12 sm:flex-none xl:mb-0 xl:w-1/12">
                    <x-input wire:model="number_of_student" label="Number"/>
                </div>
            </div>

            <br/>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-6/6 sm:flex-none xl:mb-0 xl:w-6/6">
                    <x-button wire:click="addStudents" class="btn btn-error btn-sm" icon="o-x-circle" label="Cancel" />
                    <x-button wire:click="save" class="btn btn-success btn-sm" icon="o-bookmark" label="Save"/>
                </div>
            </div>
        </x-card>
    @endif
    {{-- Success is as dangerous as failure. --}}
</div>
