<div>
    <x-modal wire:model="createFacultyModal" title="Create Faculty" subtitle="Add faculty data" separator>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mb-6 sm:w-3/4 sm:flex-none xl:mb-0 xl:w-3/4">
                <x-choices
                    label="Select university"
                    wire:model.live="university_searchable_id"
                    :options="$universitiesSearchable"
                    search-function="search"
                    debounce="300ms" {{-- Default is `250ms`--}}
                    min-chars="2" {{-- Default is `0`--}}
                    placeholder="Select university"
                    single
                    searchable >

                    @scope('item', $universities)
                    <x-list-item :item="$universities">
                        <x-slot:avatar>
                            <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full" />
                        </x-slot:avatar>
                        <x-slot:value>
                            {{$universities->code}}
                        </x-slot:value>
                        <x-slot:sub-value>
                            {{$universities->name}}
                        </x-slot:sub-value>
                    </x-list-item>
                    @endscope

                    @scope('selection', $university)
                    {{ $university->code }} | {{ $university->name }}
                    @endscope
                </x-choices>
            </div>
        </div>
        <br />
        <div class="text-left">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/4 sm:flex-none xl:mb-0 xl:w-2/4">
                    <x-input wire:model="abbreviation" label="Faculty abbreviation" />
                </div>
            </div>
            <br />
            <div class="flex flex-wrap -mx-3">
                <br />
                <div class="w-full max-w-full px-3 mb-6 sm:w-3/4 sm:flex-none xl:mb-0 xl:w-3/4">
                    <x-input wire:model="name" label="Faculty name" />
                </div>
            </div>

            <br />

            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-2/4">
                    <x-button wire:click="save" class="btn btn-success btn-sm" label="Save" />
                </div>
            </div>
        </div>
    </x-modal>
</div>
