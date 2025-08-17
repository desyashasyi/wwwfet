<div>
    {{-- Be like water. --}}
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none xl:mb-0 xl:w-1/3">
        </div>
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none xl:mb-0 xl:w-1/3">
            <br/>
        </div>
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none xl:mb-0 xl:w-1/3">
        </div>
    </div>
    <br/>
    <br/>
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none xl:mb-0 xl:w-1/3">
        </div>
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none xl:mb-0 xl:w-1/3">
            <x-input label="Name" wire:model="email" placeholder="Your name" icon="o-user" hint="Your email" inline/>
            <br/>
            <x-password wire:keydown.enter="login" label="Password" wire:model="password" icon="o-key" hint="Your password" right inline/>
        </div>
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none xl:mb-0 xl:w-1/3">
        </div>
    </div>
    <div class="flex flex-wrap -mx-3">
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none xl:mb-0 xl:w-1/3">
        </div>
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none xl:mb-0 xl:w-1/3">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full text-right px-3 mb-6 sm:w-3/3 sm:flex-none xl:mb-0 xl:w-3/3">
                    <x-button class="btn btn-primary" label="Login" icon="" wire:click="login" />
                </div>
            </div>
        </div>
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none xl:mb-0 xl:w-1/3">
        </div>
    </div>
</div>
