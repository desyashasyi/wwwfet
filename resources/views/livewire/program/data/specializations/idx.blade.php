<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-card title="Program | Data :: Specializations" shadow separator>
        <livewire:program.data.specializations.create/>
        <livewire:program.data.specializations.edit/>
        @if($buttonAddSpecializations == true)
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-4/4 sm:flex-none xl:mb-0 xl:w-4/4 text-right">
                    <x-button wire:click="$dispatch('ProgramDataSpecializationsCreate_addSpecialization')" class="btn btn-success btn-sm" label="Add specialization" />
                </div>
            </div>
        @endif
        @if($specializations->isNotEmpty())
            <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12">
                <x-table :headers="$headers" :rows="$specializations" wire:model="expanded" with-pagination>
                    @scope('cell_code', $specializations)
                    {{$specializations->code}}
                    @endscope

                    @scope('cell_description', $specializations)
                    {{$specializations->name}}
                    @endscope

                    @scope('cell_action', $specializations)
                    <x-button wire:click="$dispatch('ProgramDataSpecializations_editSpecialization',{specializationId: {{$specializations->id}} })" class="btn btn-success btn-sm" label="Edit" />
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
