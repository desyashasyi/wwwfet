<div>
    <x-card title="Program | Data :: Activities" shadow separator>
        <x-card class="bg-gray-50" shadow separator>
            @if($subjects->isNotEmpty())
                <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12">
                    <x-table :headers="$headers" :rows="$subjects" wire:model="expanded" with-pagination>
                        @scope('cell_class', $subjects)
                        @if($subjects->activities)
                            @foreach($subjects->activities as $activity)
                                @php
                                    $badgeText = '';
                                    $popOverText = '';

                                    // Tambahkan daftar dosen (code)
                                    if ($activity->teachers->isNotEmpty()) {
                                        $teacherCodes = $activity->teachers->pluck('code')->implode(' | ');
                                        $badgeText .= "$teacherCodes";
                                    }

                                    // Tambahkan daftar mahasiswa (name)
                                    if ($activity->students->isNotEmpty()) {

                                        $studentNames = $activity->students->pluck('name')->implode(' | ');
                                        $popOverText .= "$studentNames";
                                    }
                                    $roomCount = $activity->rooms->count();
                                    $badgeText .= '  ('.$roomCount.')';

                                    // Jika tidak ada data, beri pesan default
                                    if (empty($badgeText)) {
                                        $badgeText = 'No data';
                                    }
                                @endphp

                                <div class="tooltip tooltip-left tooltip-info" data-tip="{{$popOverText}}">
                                    <!--
                                    <x-badge style="cursor: pointer; display: inline-flex;" wire:click="$dispatch('ProgramDataActivitiesEdit_EditActivity',{activityId: {{$activity->id}} })" value="{{ $badgeText }}" class="badge-md badge-primary badge-dash" />
                                    -->

                                    <x-dropdown>
                                        <x-slot:trigger>
                                            <x-badge style="cursor: pointer; display: inline-flex;"  class="badge-md badge-primary badge-dash" value="{{ $badgeText }}" />
                                        </x-slot:trigger>

                                        <x-menu-item title="View activity" wire:click="viewActivity ({{$activity->id}})" />
                                        <x-menu-item title="Show room" />
                                    </x-dropdown>

                                </div>

                            @endforeach
                        @endif
                        @endscope
                        @scope('cell_action', $subjects)
                            <x-button wire:click="addActivity({{$subjects->id}})" icon="o-plus-circle" class="btn btn-success btn-xs" label="" />
                        @endscope

                    </x-table>
                    <br/>
                    <livewire:program.data.activities.create/>
                    <livewire:program.data.activities.edit/>
                    <livewire:program.data.activities.view/>
                </div>
            @else
                <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12 text-center">
                    <br/>
                    There is no data
                </div>
            @endif
        </x-card>
    </x-card>

    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
</div>
