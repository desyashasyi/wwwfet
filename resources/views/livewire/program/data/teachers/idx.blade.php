<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-card title="Program | Data :: Teachers" shadow separator>
        <livewire:program.data.teachers.create/>
        <livewire:program.data.teachers.edit/>
        <livewire:program.data.teachers.components.import-excel/>
        @if($buttonAddTeachers)
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-4/4 sm:flex-none xl:mb-0 xl:w-4/4 text-right">
                    <x-button wire:click="$dispatch('ProgramDataTeachersCreate_addTeachers')" class="btn btn-success btn-sm" label="Add teacher" />
                    <x-button wire:click="$dispatch('ProgramDataTeachersComponentsImportExcel_addTeachers')" class="btn btn-success btn-sm" label="Import Excel" />
                </div>
            </div>
        @endif
        @if($teachers->isNotEmpty())
            <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12">
                <x-table :headers="$headers" :rows="$teachers" wire:model="expanded" with-pagination>
                    @scope('cell_user', $teachers)
                        @if(!is_null($teachers->user))
                            {{$teachers->user->name}}
                        @endif
                    @endscope
                    @scope('cell_email', $teachers)
                        @if(!is_null($teachers->user))
                            {{$teachers->user->email}}
                        @endif
                    @endscope
                    @scope('cell_name', $teachers)
                        {{$teachers->front_title}} {{$teachers->name}}, {{$teachers->rear_title}}
                    @endscope
                    @scope('cell_description', $teachers)
                    {{$teachers->employee_id}} {{$teachers->last_name}}
                    @endscope

                    @scope('cell_action', $teachers)
                    <x-button wire:click="$dispatch('ProgramDataTeachersEdit_editTeachers',{teacherId: {{$teachers->id}} })" icon="o-pencil" class="btn btn-success btn-sm" label="Edit" />
                    {{--<x-button wire:click="loginAs({{$teachers->id}})" class="btn btn-warning btn-sm" label="Login as" />--}}
                    @endscope
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
