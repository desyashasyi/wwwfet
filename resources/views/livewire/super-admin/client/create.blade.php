<div>
    <div class="text-left">
        <x-card subtitle="Add Client" shadow separator>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none xl:mb-0 xl:w-1/3">
                    <x-choices
                        label="Select client level"
                        wire:model.live="client_level_searchable_id"
                        :options="$clientLevelsSearchable"
                        search-function="search"
                        debounce="300ms" {{-- Default is `250ms`--}}
                        min-chars="2" {{-- Default is `0`--}}
                        placeholder="Select client level"
                        single
                        searchable>

                        @scope('item', $clientLevels)
                        <x-list-item :item="$clientLevels">
                            <x-slot:avatar>
                                <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full"/>
                            </x-slot:avatar>
                            <x-slot:value>
                                {{$clientLevels->code}} :: {{$clientLevels->level}}
                            </x-slot:value>
                        </x-list-item>
                        @endscope

                        @scope('selection', $clientLevels)
                        {{$clientLevels->code}} :: {{$clientLevels->level}}
                        @endscope
                    </x-choices>
                </div>
            </div>
            @if($client_level_searchable_id == \App\Models\FetNet\ClientLevel::where('code', 'CLU')->first()->id)
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/4 sm:flex-none xl:mb-0 xl:w-1/4">
                        <x-input wire:model="clusterAbb" label="Cluster abbreviation"/>
                    </div>
                </div>
                <br/>
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-6 sm:w-2/4 sm:flex-none xl:mb-0 xl:w-2/4">
                        <x-input wire:model="clusterName" label="Cluster name"/>
                    </div>
                </div>
            @endif
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
                        searchable>

                        @scope('item', $universities)
                        <x-list-item :item="$universities">
                            <x-slot:avatar>
                                <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full"/>
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
                        <x-slot:append>
                            <x-button wire:click="$dispatch('superAdminUniversity_Create')" class="ml-2"
                                      class="btn-success rounded-s-none">
                                Create University
                            </x-button>
                        </x-slot:append>
                    </x-choices>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-3/4 sm:flex-none xl:mb-0 xl:w-3/4">
                    <x-choices
                        label="Select faculty"
                        wire:model.live="faculty_searchable_id"
                        :options="$facultiesSearchable"
                        search-function="search"
                        debounce="300ms" {{-- Default is `250ms`--}}
                        min-chars="2" {{-- Default is `0`--}}
                        placeholder="Select faculty"
                        single
                        searchable>

                        @scope('item', $faculties)
                        <x-list-item :item="$faculties">
                            <x-slot:avatar>
                                <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full"/>
                            </x-slot:avatar>
                            <x-slot:value>
                                {{$faculties->code}}
                            </x-slot:value>
                            <x-slot:sub-value>
                                {{$faculties->name}}
                            </x-slot:sub-value>
                        </x-list-item>
                        @endscope

                        @scope('selection', $faculty)
                        {{ $faculty->code }} | {{ $faculty->name }}
                        @endscope

                        <x-slot:append>
                            <x-button wire:click="$dispatch('superAdminFaculty_Create', { universityId: {{$university_searchable_id ?? 'null' }} })" class="ml-2"
                                      class="btn-success rounded-s-none">
                                Create Faculty
                            </x-button>
                        </x-slot:append>
                    </x-choices>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/4 sm:flex-none xl:mb-0 xl:w-1/4">
                    <x-input wire:model="username" label="Username"/>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <br/>
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/4 sm:flex-none xl:mb-0 xl:w-2/4">
                    <x-input wire:model="email" label="Email" email/>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <br/>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/4 sm:flex-none xl:mb-0 xl:w-1/4">
                    <x-input wire:model="password" label="Password" password/>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <br/>
                <div class="w-full max-w-full px-3 mb-6 sm:w-3/4 sm:flex-none xl:mb-0 xl:w-3/4">
                    <x-input wire:model="description" label="Description"/>
                </div>
            </div>
            <br/>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-2/4">
                    <x-button wire:click="$dispatch('superAdminClientIndex_enableAddClient')" class="btn btn-error btn-sm" icon="o-x-circle" label="Cancel"/>
                    <x-button wire:click="save" class="btn btn-success btn-sm" icon="o-bookmark" label="Save"/>
                </div>
            </div>
        </x-card>
    </div>
    {{-- Success is as dangerous as failure. --}}
    <livewire:super-admin.university.create/>
    <livewire:super-admin.faculty.create/>
</div>
