<form method="POST" class="w-100" action="{{ route('otp.send') }}">
    <div class="row">
        <div class="col-4">
            <div class="form-group row">
                <x-jet-label class="col-sm-2 col-form-label text-right">Đáy 1</x-jet-label>
                <div class="flex items-center">
                    <x-jet-input class="form-control" type="text" wire:model.lazy="bottomOne" value="" placeholder="Bottom 1"></x-jet-input>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="form-group row">
                <x-jet-label class="col-sm-2 col-form-label text-right">Đỉnh 1</x-jet-label>
                <div class="flex items-center">
                    <x-jet-input class="form-control" type="text" wire:model.lazy="topOne" value="" placeholder="Top 1"></x-jet-input>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="form-group row">
                <x-jet-label class="col-sm-2 col-form-label text-right">Đáy 2</x-jet-label>
                <div class="flex items-center">
                    <x-jet-input class="form-control" type="text" wire:model.lazy="bottomTwo" value="" placeholder="Bottom 2"></x-jet-input>
                </div>
            </div>
        </div>

        <div class="col-12 text-center">
            <x-jet-button class="btn btn-gradient-primary" wire:click="calculateCoin" type="button">Calculate</x-jet-button>
        </div>
    </div>
</form>
