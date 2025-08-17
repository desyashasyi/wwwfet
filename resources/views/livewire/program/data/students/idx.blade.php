<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <x-card title="Program | Data :: Student" shadow separator>
        <livewire:program.data.students.create/>
        @if($buttonAddStudents)
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-4/4 sm:flex-none xl:mb-0 xl:w-4/4 text-right">
                    <x-button wire:click="$dispatch('ProgramDataStudentsCreate_addStudents')" class="btn btn-success btn-sm" label="Add student" />
                </div>
            </div>
        @endif
        @if($students->isNotEmpty())
            <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12">
                <x-table :headers="$headers" :rows="$students" wire:model="expanded" with-pagination>
                </x-table>
            </div>
        @else
            <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12 text-center">
                <br/>
                There is no data
            </div>
        @endif
    </x-card>
</div>
