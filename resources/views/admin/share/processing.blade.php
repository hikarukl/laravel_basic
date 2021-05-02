<div wire:loading @if(isset($target)) wire:target="{{ $target }}" @endif class="w-100 h-100 position-fixed fixed-top bg-aliceblue opacity-50 z-1060"></div>
<button wire:loading @if(isset($target)) wire:target="{{ $target }}" @endif class="btn btn-gradient-primary position-fixed top-50 left-50 z-1060" type="button">
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    Processing...
</button>