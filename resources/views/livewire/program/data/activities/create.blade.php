<div>

    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mb-6 sm:w-3/5 sm:flex-none xl:mb-0 xl:w-3/5">
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
            </x-choices>
        </div>
    </div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
</div>
