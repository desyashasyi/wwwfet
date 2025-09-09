<div>

    @if($editActivity)
        <x-card class="bg-gray-200" shadow separator>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/12 sm:flex-none xl:mb-0 xl:w-1/12">
                    @if(!is_null($activity))
                        <x-input value="{{$activity->subject->code}}" label="Code" readonly/>
                    @else
                        <x-input value="" label="Code" readonly/>
                    @endif
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/12 sm:flex-none xl:mb-0 xl:w-1/12">
                    @if(!is_null($activity))
                        <x-input value="{{$activity->subject->credit}}" label="Credit" readonly/>
                    @else
                        <x-input value="" label="Credit" readonly/>
                    @endif
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/12 sm:flex-none xl:mb-0 xl:w-1/12">
                    @if(!is_null($activity))
                        <x-input value="{{$activity->subject->semester}}" label="Semester" readonly/>
                    @else
                        <x-input value="" label="Semester" readonly/>
                    @endif
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/12 sm:flex-none xl:mb-0 xl:w-2/12">
                    @if(!is_null($activity))
                        <x-input value="{{$activity->subject->year}}" label="Curiculum Year" readonly/>
                    @else
                        <x-input value="" label="Curiculum Year" readonly/>
                    @endif
                </div>

                <div class="w-full max-w-full px-3 mb-6 sm:w-7/12 sm:flex-none xl:mb-0 xl:w-7/12">

                    @if(!is_null($activity))
                        <x-input value="{{$activity->subject->name}}" label="Name" readonly/>
                    @else
                        <x-input value="" label="Name" readonly/>
                    @endif
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-5/12 sm:flex-none xl:mb-0 xl:w-5/12">
                    <x-choices
                        label="Teachers"
                        wire:model="teachers_multi_searchable_ids"
                        :options="$teachersSearchable"
                        placeholder="Search ..."
                        search-function="teacherSelect"
                        no-result-text="Ops! Nothing here ..."
                        clearable
                        searchable>

                        @scope('item', $teacher)
                        <x-list-item :item="$teacher">
                            <x-slot:avatar>
                                <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full"/>
                            </x-slot:avatar>
                            <x-slot:value>
                                {{$teacher->code}}-{{$teacher->name}}
                            </x-slot:value>
                        </x-list-item>
                        @endscope

                        @scope('selection', $teacher)
                        {{$teacher->code}}
                        @endscope
                    </x-choices>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-5/12 sm:flex-none xl:mb-0 xl:w-5/12">
                    <x-choices
                        label="Students"
                        wire:model="students_multi_searchable_ids"
                        :options="$studentsSearchable"
                        placeholder="Search ..."
                        search-function="studentSelect"
                        no-result-text="Ops! Nothing here ..."
                        clearable
                        searchable>

                        @scope('item', $student)
                        <x-list-item :item="$student">
                            <x-slot:avatar>
                                <x-icon name="o-user" class="bg-orange-100 p-2 w-8 h8 rounded-full"/>
                            </x-slot:avatar>
                            <x-slot:value>
                                {{$student->name}}
                            </x-slot:value>
                        </x-list-item>
                        @endscope

                        @scope('selection', $student)
                        {{$student->name}}
                        @endscope
                    </x-choices>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/12 sm:flex-none xl:mb-0 xl:w-2/12">
                    <x-choices
                        label="Activity type"
                        wire:model.live="activity_searchable_id"
                        :options="$activityTypesSearchable"
                        search-function="activityTypeSelect"
                        debounce="300ms" {{-- Default is `250ms`--}}
                        min-chars="2" {{-- Default is `0`--}}
                        placeholder="Select type"
                        single
                    >
                    </x-choices>
                </div>
            </div>
            <br/>
            <div class="w-full max-w-full px-3 mb-6 sm:w-6/6 sm:flex-none xl:mb-0 xl:w-6/6">
                <x-button wire:click="update" class="btn btn-success btn-sm" icon="o-bookmark" label="Update activity"/>
            </div>
        </x-card>
    @endif
</div>
