<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <x-card title="SuperAdmin | University" shadow separator>

        {{--
        @if($addData == false)

            <div class="text-right">
                <x-button wire:click="enableAddUniversity" class="btn btn-success btn-sm" label="Add university" />
                <br/>
                <br/>
                <hr/>
                <br/>
            </div>
        @else
            <livewire:super-admin.university.create/>
        @endif
        --}}
        @if($universities->isNotEmpty())
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12">
                    <x-table :headers="$headers" :rows="$universities" wire:model="expanded" with-pagination>

                    </x-table>
                </div>
            </div>
        @else
            There is no data
        @endif
    </x-card>
</div>
