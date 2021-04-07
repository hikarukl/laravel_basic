<form method="POST" class="w-full" action="{{ route('otp.send') }}">
    <div class="grid grid-cols-3">
        <div class="col-span-1">
            <div class="flex items-center">
                <x-jet-label>Bottom 1</x-jet-label>
                <x-jet-input class="ml-2" type="text" wire:model.lazy="bottomOne" value="" placeholder="Bottom 1"></x-jet-input>
            </div>
        </div>
        <div class="col-span-1">
            <div class="flex items-center">
                <x-jet-label>Top 1</x-jet-label>
                <x-jet-input class="ml-2" type="text" wire:model.lazy="topOne" value="" placeholder="Bottom 1"></x-jet-input>
            </div>
        </div>
        <div class="col-span-1">
            <div class="flex items-center">
                <x-jet-label>Bottom 2</x-jet-label>
                <x-jet-input class="ml-2" type="text" wire:model.lazy="bottomTwo" value="" placeholder="Bottom 2"></x-jet-input>
            </div>
        </div>
    </div>

    <div class="grid mt-5 justify-center">
        <div class="col-span-1">
            <x-jet-button wire:click="calculateCoin" type="button">Calculate</x-jet-button>
        </div>
    </div>
</form>