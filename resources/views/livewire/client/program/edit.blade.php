<div>
    <x-modal wire:model="editProgramModal" title="Edit Program" subtitle="Edit program data" separator>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mb-6 sm:w-3/3 sm:flex-none xl:mb-0 xl:w-3/3">
                <x-choices
                    label="Select cluser"
                    wire:model.live="cluster_searchable_id"
                    :options="$clusterSearchable"
                    search-function="search"
                    debounce="300ms" {{-- Default is `250ms`--}}
                    min-chars="2" {{-- Default is `0`--}}
                    placeholder="Select cluster"
                    single
                    searchable>
                    @scope('item', $clusters)
                    <x-list-item :item="$clusters">
                        <x-slot:avatar>
                            <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full"/>
                        </x-slot:avatar>
                        <x-slot:value>
                            {{$clusters->code}} :: {{$clusters->name}}
                        </x-slot:value>
                    </x-list-item>
                    @endscope
                    <x-slot:append>
                        <x-button wire:click="$dispatch('clientCluster_Create')" class="ml-2"
                                  class="btn-success rounded-s-none">
                            Create Cluster
                        </x-button>
                    </x-slot:append>
                </x-choices>
            </div>
        </div>
        <br/>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mb-6 sm:w-2/6 sm:flex-none xl:mb-0 xl:w-2/6">
                <x-input wire:model="code" label="Code"/>
            </div>
            <div class="w-full max-w-full px-3 mb-6 sm:w-2/6 sm:flex-none xl:mb-0 xl:w-2/6">
                <x-input wire:model="abbrev" label="abbreviation" readonly/>
            </div>
        </div>
        <br/>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mb-6 sm:w-4/4 sm:flex-none xl:mb-0 xl:w-4/4">
                <x-input wire:model="name" label="Name"/>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mb-6 sm:w-3/4 sm:flex-none xl:mb-0 xl:w-3/4">
                <x-input wire:model="email" label="Email" email/>
            </div>
        </div>
        <br/>
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2">
                <x-button wire:click="update" class="btn btn-success btn-sm" label="Update"/>
            </div>
        </div>
    </x-modal>
    <livewire:client.cluster.create/>
</div>
