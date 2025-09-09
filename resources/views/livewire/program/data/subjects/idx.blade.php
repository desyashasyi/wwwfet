<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-card title="Program | Data :: Subjects" shadow separator>


        @if($subjects->isNotEmpty())
            <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12">
                <x-table :headers="$headers" :rows="$subjects" wire:model="expanded" with-pagination>
                    @scope('cell_user', $subjects)
                    @endscope
                    @scope('cell_email', $subjects)
                    @endscope
                    @scope('cell_description', $subjects)
                    @endscope

                    @scope('cell_action', $subjects)
                    <x-button wire:click="$dispatch('ProgramDataSubjectsEdit_editSubjects',{subjectId: {{$subjects->id}} })" icon="o-pencil" class="btn btn-success btn-sm" label="Edit" />
                    @endscope
                </x-table>
            </div>
        @else
            <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12 text-center">
                <br/>
                There is no data
            </div>
        @endif
        <br/>
            @if($buttonAddSubjects)
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-6 sm:w-4/4 sm:flex-none xl:mb-0 xl:w-4/4 text-right">
                        <x-button wire:click="$dispatch('ProgramDataSubjectsCreate_addSubjects')"
                                  class="btn btn-success btn-sm" label="Add subject"/>

                    </div>
                </div>
            @endif
            <livewire:program.data.subjects.create/>
            <livewire:program.data.subjects.edit/>
            <livewire:program.data.subjects.components.import-excel/>
    </x-card>
</div>
