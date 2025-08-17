<div>
    <x-card title="Client | Program" shadow separator>
        @if($addData == true)
            <livewire:client.program.create/>
        @else
            <div class="text-right">
                <x-button wire:click="enableAddProgram" class="btn btn-success btn-sm" label="Add program" />
                <br/>
                <br/>
                <hr/>
                <br/>
            </div>
            @if($programs->isNotEmpty())
                <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12">
                    <x-table :headers="$headers" :rows="$programs" wire:model="expanded" with-pagination>
                        @scope('cell_user', $programs)
                        {{$programs->user->name}}
                        @endscope
                        @scope('cell_email', $programs)
                        {{$programs->user->email}}
                        @endscope
                        @scope('cell_description', $programs)
                        {{$programs->abbrev}} - {{$programs->name}}
                        @endscope
                        @scope('cell_cluster', $programs)
                        @if(!is_null($programs->cluster))
                            {{$programs->cluster->base->code}} | {{$programs->cluster->base->name}}
                        @endif
                        @endscope
                        @scope('cell_action', $programs)
                        <x-button wire:click="$dispatch('clientProgram_Create',{programId: {{$programs->id}} })" class="btn btn-success btn-sm" label="Edit" />
                        <x-button wire:click="loginAs({{$programs->id}})" class="btn btn-warning btn-sm" label="Login as" />

                        @endscope
                    </x-table>
                </div>
            @else
                There is no data
            @endif
        @endif
    </x-card>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <livewire:client.program.edit/>

</div>
