<div>
    {{-- In work, do what you enjoy. --}}
    @if($buttonAddSemester)
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mb-6 sm:w-4/4 sm:flex-none xl:mb-0 xl:w-4/4 text-right">
                <x-button wire:click="addSemester" class="btn btn-success btn-sm" label="Add semester" />
            </div>
        </div>
    @else
        <x-card class="bg-gray-50" subtitle="Add teachers" shadow separator>

            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/12 sm:flex-none xl:mb-0 xl:w-2/12">
                    <x-input wire:model="year" label="Year"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/12 sm:flex-none xl:mb-0 xl:w-1/12">
                    <x-input wire:model="semester" label="Semester"/>
                </div>
            </div>

            <br/>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-6/6 sm:flex-none xl:mb-0 xl:w-6/6">
                    <x-button wire:click="addSemester" class="btn btn-error btn-sm" icon="o-x-circle" label="Cancel" />
                    <x-button wire:click="save" class="btn btn-success btn-sm" icon="o-bookmark" label="Save"/>
                </div>
            </div>
        </x-card>
    @endif

    @if($semesters->isNotEmpty())
        <div class="w-full max-w-full px-3 mb-6 sm:w-4/12 sm:flex-none xl:mb-0 xl:w-4/12">
            <x-table :headers="$headers" :rows="$semesters" wire:model="expanded" with-pagination>
                @scope('cell_action', $semesters)
                <x-button wire:click="$dispatch('ProgramDataSubjectsEdit_editSubjects',{subjectId: {{$semesters->id}} })" icon="o-pencil" class="btn btn-success btn-sm" label="Edit" />
                @endscope
            </x-table>
        </div>
    @else
        <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12 text-center">
            <br/>
            There is no semesters data
        </div>
    @endif
</div>
