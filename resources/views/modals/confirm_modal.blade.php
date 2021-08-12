<div class="modal overflow-y-auto {{ $modalClasses }}" id="{{ $modalId }}">
    <div class="modal__content">
        <div class="p-5 text-center">
            <div class="text-3xl mt-5">{{ $modalTitle }}</div>
            <div class="text-gray-600 mt-2">{{ $modalContent }}</div>
        </div>
        <div class="px-5 pb-8 text-center">
            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">{{ $btnCancelName }}</button>
            <button type="button" class="button w-24 bg-theme-6 text-white">{{ $btnConfirmName }}</button>
        </div>
    </div>
</div>