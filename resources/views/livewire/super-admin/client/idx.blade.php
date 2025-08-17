<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-card title="SuperAdmin | Client List" shadow separator>
        @if($addData == false)
            <div class="text-right">
                <x-button wire:click="enableAddClient" class="btn btn-success btn-sm" label="Add client" />
                <br/>
                <br/>
                <hr/>
                <br/>
            </div>
            @if($clients->isNotEmpty())
                <div class="w-full max-w-full px-3 mb-6 sm:w-12/12 sm:flex-none xl:mb-0 xl:w-12/12">
                    <x-table :headers="$headers" :rows="$clients" wire:model="expanded" with-pagination>
                        @scope('cell_user', $clients)
                        {{$clients->user->name}}
                        @endscope
                        @scope('cell_email', $clients)
                        {{$clients->user->email}}
                        @endscope
                        @scope('cell_level', $clients)
                        {{$clients->level->code}} | {{$clients->level->level}}
                        @endscope
                        @scope('cell_cluster', $clients)
                        {{$clients->clusterAbb}} | {{$clients->clusterName}}
                        @endscope
                        @scope('cell_action', $clients)
                        <x-button wire:click="editClient({{$clients->id}})" class="btn btn-success btn-sm" label="Edit" />
                        <x-button wire:click="loginAs({{$clients->id}})" class="btn btn-warning btn-sm" label="Login as" />

                        @endscope
                    </x-table>
                </div>
            @else
                There is no data
            @endif
        @else
            <livewire:super-admin.client.create/>
        @endif
    </x-card>
</div>
