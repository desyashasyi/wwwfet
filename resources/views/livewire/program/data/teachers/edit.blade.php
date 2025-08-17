<div>
    @if($enableEditTeacherState == true)
        <x-card class="bg-gray-50" subtitle="Edit teachers" shadow separator>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/5">
                    <x-input wire:model="code" label="Code">
                        <x-slot:append>
                            <x-button wire:click="checkCode" class="ml-2"
                                      class="btn-success">
                                Check
                            </x-button>
                        </x-slot:append>
                    </x-input>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/5">
                    <x-input wire:model="univCode" label="Univ code" number/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/5">
                    <x-input wire:model="employeeId" label="Employee ID"/>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/5">
                    <x-input wire:model="frontTitle" label="Front title"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/5 sm:flex-none xl:mb-0 xl:w-1/5">
                    <x-input wire:model="rearTitle" label="Rear title"/>
                </div>

                <div class="w-full max-w-full px-3 mb-6 sm:w-2/5 sm:flex-none xl:mb-0 xl:w-2/5">
                    <x-input wire:model="name" label="name"/>
                </div>

            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/6 sm:flex-none xl:mb-0 xl:w-1/6">
                    <x-input wire:model="phone" label="Phone"/>
                </div>
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/6 sm:flex-none xl:mb-0 xl:w-2/6" email>
                    <x-input wire:model="email" label="Email"/>
                </div>
            </div>
            <br/>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 sm:w-2/6 sm:flex-none xl:mb-0 xl:w-2/6">
                    <x-button wire:click="disableEditTeacherInternal" class="btn btn-error btn-sm" icon="o-x-circle" label="Cancel" />
                    <x-button wire:click="save" class="btn btn-success btn-sm" icon="o-bookmark" label="Save"/>
                </div>
            </div>
        </x-card>
    @endif
    {{-- Success is as dangerous as failure. --}}
</div>
