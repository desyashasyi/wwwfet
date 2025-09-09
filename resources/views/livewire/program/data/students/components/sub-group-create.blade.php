<div>
    @if($addSubGroup)
        <x-card class="bg-gray-50" subtitle="Add group" shadow separator>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/12 sm:flex-none xl:mb-0 xl:w-2/12">
                    <x-choices
                        label="Batch"
                        wire:model.live="batch_searchable_id"
                        :options="$batchSearchable"
                        search-function="search"
                        debounce="300ms" {{-- Default is `250ms`--}}
                        min-chars="2" {{-- Default is `0`--}}
                        placeholder="Select batch"
                        single
                        searchable
                        clearable
                        readonly
                    >

                        @scope('item', $batch)
                        <x-list-item :item="$batch">
                            <x-slot:avatar>
                                <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full"/>
                            </x-slot:avatar>
                            <x-slot:value>
                                {{$batch->batch}}
                            </x-slot:value>
                        </x-list-item>
                        @endscope

                        @scope('selection', $batch)
                        {{$batch->batch}}
                        @endscope
                    </x-choices>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/12 sm:flex-none xl:mb-0 xl:w-2/12">
                    @if(!is_null($batch_searchable_id))
                        <x-input value="{{$batch->name}} ({{$batch->number_of_student}})" label="Name" readonly/>
                    @else
                        <x-input value="" label="Name" readonly/>
                    @endif
                </div>
                @if(!is_null($batch_searchable_id))
                    <div class="w-full max-w-full px-3 mb-6 sm:w-3/12 sm:flex-none xl:mb-0 xl:w-3/12">
                        <x-choices
                            label="Student group"
                            wire:model.live="group_searchable_id"
                            :options="$groupSearchable"
                            search-function="search"
                            debounce="300ms" {{-- Default is `250ms`--}}
                            min-chars="2" {{-- Default is `0`--}}
                            placeholder="Select group"
                            single
                            searchable
                            clearable
                            readonly
                        >

                            @scope('item', $groups)
                            <x-list-item :item="$groups">
                                <x-slot:avatar>
                                    <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full"/>
                                </x-slot:avatar>
                                <x-slot:value>
                                    {{$groups->name}} ({{$groups->number_of_student}})
                                </x-slot:value>
                            </x-list-item>
                            @endscope

                            @scope('selection', $groups)
                            {{$groups->name}} ({{$groups->number_of_student}})
                            @endscope
                        </x-choices>
                    </div>
                @else
                    <div class="w-full max-w-full px-3 mb-6 sm:w-3/12 sm:flex-none xl:mb-0 xl:w-3/12">
                        <x-choices
                            label="Student group"
                            wire:model.live="group_searchable_id"
                            :options="$groupSearchable"
                            search-function="search"
                            debounce="300ms" {{-- Default is `250ms`--}}
                            min-chars="2" {{-- Default is `0`--}}
                            placeholder="Select group"
                            single
                            searchable
                            clearable>

                            @scope('item', $groups)
                            <x-list-item :item="$groups">
                                <x-slot:avatar>
                                    <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full"/>
                                </x-slot:avatar>
                                <x-slot:value>
                                    {{$groups->name}} ({{$groups->number_of_student}})
                                </x-slot:value>
                            </x-list-item>
                            @endscope

                            @scope('selection', $groups)
                            {{$groups->name}} ({{$groups->number_of_student}})
                            @endscope
                        </x-choices>
                    </div>
                @endif
            </div>
            <br/>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-7/12 sm:flex-none xl:mb-0 xl:w-7/12">
                    <hr/>
                </div>
            </div>
            <br/>
            <div class="flex flex-wrap -mx-3">

                <div class="w-full max-w-full px-3 mb-6 sm:w-3/12 sm:flex-none xl:mb-0 xl:w-3/12">
                    <x-input wire:model="name" label="Name of student sub-group"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/12 sm:flex-none xl:mb-0 xl:w-1/12">
                    <x-input wire:model="number_of_student" label="Number"/>
                </div>
            </div>
            <br/>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-6/6 sm:flex-none xl:mb-0 xl:w-6/6">
                    <x-button wire:click="cancelAddSubGroup" class="btn btn-error btn-sm" icon="o-x-circle" label="Cancel" />
                    <x-button wire:click="save" class="btn btn-success btn-sm" icon="o-bookmark" label="Save"/>
                </div>
            </div>
        </x-card>
    @endif
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
</div>
