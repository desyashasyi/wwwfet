<div>
    @if($enableEditSubjectsState == true)
        <x-card class="bg-gray-50" subtitle="Edit subjects" shadow separator>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/12 sm:flex-none xl:mb-0 xl:w-2/12">
                    <x-input wire:model="code" label="Code"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/12 sm:flex-none xl:mb-0 xl:w-1/12">
                    <x-input wire:model="credit" label="Credit"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-9/12 sm:flex-none xl:mb-0 xl:w-9/12">
                    <x-input wire:model="name" label="Name"/>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">

                <div class="w-full max-w-full px-3 mb-6 sm:w-1/12 sm:flex-none xl:mb-0 xl:w-1/12">
                    <x-input wire:model="semester" label="Semester"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/12 sm:flex-none xl:mb-0 xl:w-2/12">
                    <x-input wire:model="year" label="Curiculum Year"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-3/12 sm:flex-none xl:mb-0 xl:w-3/12">
                    <x-select
                        label="Specialization"
                        wire:model="specialization"
                        :options="$specializations"
                        placeholder="Select specialization"
                        placeholder-value="0" {{-- Set a value for placeholder. Default is `null` --}}
                    />
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-3/12 sm:flex-none xl:mb-0 xl:w-3/12">
                    <x-select
                        label="Course type"
                        wire:model="type"
                        :options="$types"
                        placeholder="Select course type"
                        placeholder-value="0" {{-- Set a value for placeholder. Default is `null` --}}
                    />
                </div>

            </div>
            <br/>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-6/6 sm:flex-none xl:mb-0 xl:w-6/6">
                    <x-button wire:click="enableAddsubject" class="btn btn-error btn-sm" icon="o-x-circle" label="Cancel" />
                    <x-button wire:click="save" class="btn btn-success btn-sm" icon="o-bookmark" label="Save"/>
                </div>
            </div>
        </x-card>
    @endif
    {{-- Stop trying to control. --}}
</div>
