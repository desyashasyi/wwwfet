<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    <x-card title="Program | Data :: Student" shadow separator>

        @if($students->isNotEmpty())
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/6 sm:flex-none xl:mb-0 xl:w-1/12">
                    <b>Batch</b>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-2/12">
                    <b>Name</b>
                </div>

                <div class="w-full max-w-full px-3 mb-6 sm:w-2/5 sm:flex-none xl:mb-0 xl:w-4/12">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/2">
                            <b>Group</b>

                        </div>
                        <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/2">
                            <b>Sub Group</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/6 sm:flex-none xl:mb-0 xl:w-7/12">
                    <hr/>
                </div>
            </div>
            @foreach($students as $student)
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/6 sm:flex-none xl:mb-0 xl:w-1/12">
                        {{$student->batch}}
                    </div>
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-2/12">
                        @if($student->name)
                            {{$student->name}} ({{$student->number_of_student}})
                            <x-button wire:click="addGroup({{$student->id}})" icon="o-plus-circle" class="btn-circle btn-xs btn-ghost" />
                        @endif
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 sm:w-2/5 sm:flex-none xl:mb-0 xl:w-4/12">
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full max-w-full px-3 mb-6 sm:w-2/2 sm:flex-none xl:mb-0 xl:w-2/2">
                                @if(!is_null($student->group))
                                    <div class="flex flex-wrap -mx-3">
                                        <div class="w-full max-w-full px-3 mb-6 sm:w-2/2 sm:flex-none xl:mb-0 xl:w-2/2">
                                            @foreach($student->group as $group)
                                                <div class="flex flex-wrap -mx-3">
                                                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2">
                                                        @if($group)
                                                            {{$group->name}} ({{$group->number_of_student}})
                                                            <x-button wire:click="addSubGroup({{$group->id}})" icon="o-plus-circle" class="btn-circle btn-xs btn-ghost" />
                                                            <br/>
                                                        @endif
                                                    </div>
                                                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2">
                                                        @if(!is_null($group->sub))
                                                            @foreach($group->sub as $subgroup)
                                                                {{$subgroup->name}} ({{$subgroup->number_of_student}})
                                                                <br/>
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12 text-center">
                <br/>
                There is no data
            </div>
        @endif
        @if($buttonAddStudents)
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-4/4 sm:flex-none xl:mb-0 xl:w-4/4 text-right">
                    <x-button wire:click="$dispatch('ProgramDataStudentsCreate_addStudents')" class="btn btn-success btn-sm" label="Add student" />
                </div>
           </div>
       @endif
         <livewire:program.data.students.create/>
        <livewire:program.data.students.components.group-create/>
        <livewire:program.data.students.components.group-edit/>
        <livewire:program.data.students.components.sub-group-create/>
        <livewire:program.data.students.components.sub-group-edit/>
    </x-card>
</div>
