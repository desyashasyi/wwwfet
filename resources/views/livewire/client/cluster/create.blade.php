<div>
    <x-modal wire:model="createClusterModal" title="Create Cluster" subtitle="Add cluster data" separator>
        <div class="text-left">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/4 sm:flex-none xl:mb-0 xl:w-2/4">
                    <x-input wire:model="clusterCode" label="Cluster abbreviation"/>
                </div>
            </div>
            <br/>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-3/4 sm:flex-none xl:mb-0 xl:w-3/4">
                    <x-input wire:model="clusterName" label="Cluster name"/>
                </div>
            </div>
            <br/>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-2/4">
                    <x-button wire:click="save" class="btn btn-success btn-sm" label="Save"/>
                </div>
            </div>
        </div>
    </x-modal>
</div>
