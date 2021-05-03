<div class="tab-pane fade show active" id="settings_detail">
    <div class="row">
        <div class="col-lg-12 col-xl-9 mx-auto">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert alert-secondary border-0" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="general-label">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input
                                        type="text"
                                        id="name"
                                        class="form-control"
                                        placeholder="Name"
                                        wire:model.defer="name">
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">New Password</label>
                            <div class="col-sm-10">
                                <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        placeholder="Enter New Password"
                                        wire:model.defer="newPassword">
                                @error('newPassword') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-sm-10">
                                <input
                                        type="password"
                                        id="confirmPassword"
                                        class="form-control"
                                        placeholder="Confirm Password"
                                        wire:model.defer="confirmPassword">
                                @error('confirmPassword') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input
                                        type="text"
                                        id="phone"
                                        class="form-control"
                                        placeholder="Phone"
                                        wire:model.defer="phone">
                                @error('phone') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input
                                        type="email"
                                        id="email"
                                        class="form-control"
                                        placeholder="Email"
                                        wire:model.defer="email">
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Two Factor</label>
                            <div class="col-sm-4">
                                <div class="custom-control custom-switch switch-primary">
                                    <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="switchOtp"
                                            wire:click="$set('useAuthenticator', false)"
                                            @if($useOtp) checked @endif
                                            wire:model.defer="useOtp">
                                    <label class="custom-control-label" for="switchOtp">User OTP</label>
                                    <input type="hidden" value="{{ $useOtp }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="custom-control custom-switch switch-primary">
                                    <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="switchAuthenticator"
                                            wire:click="$set('useOtp', false)"
                                            @if($useAuthenticator) checked @endif
                                            wire:model.defer="useAuthenticator">
                                    <label class="custom-control-label" for="switchAuthenticator">Use Google Authenticator</label>
                                    <input type="hidden" value="{{ $useAuthenticator }}">
                                </div>
                            </div>
                        </div>

                        {{-- This block just show when enable authenticaor --}}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Authenticator Code</label>
                            <div class="col-sm-10">
                                <div class="mt-4 dark:p-4 dark:w-56 dark:bg-white" id="wrap-cotent_qr_code">
                                    @if(auth()->user()->two_factor_secret)
                                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($photo && empty($errors->count()))
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Review Avatar</label>
                                <div class="col-sm-10">
                                    <div class="met-profile">
                                        <div class="row">
                                            <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                                <div class="met-profile-main">
                                                    <div class="met-profile-main-pic">
                                                        <img src="{{ $photo->temporaryUrl() }}" alt="" class="thumb-xl rounded-circle">
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                    </div><!--end f_profile-->
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Avatar</label>
                            <div class="col-sm-10">
                                <div class="custom-file mb-3">
                                    <input wire:model="photo" type="file" class="custom-file-input" id="avatar">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                @error('photo') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-10 ml-auto">
                                <button
                                        type="button"
                                        data-toggle="modal"
                                        data-target="#updateModalProfile"
                                        class="btn btn-gradient-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!--end col-->
    </div><!--end row-->

   {{-- Modals --}}
    @include('admin.share.modal', [
        'title'   => 'Update Profile',
        'id'      => 'updateModalProfile',
        'content' => 'Are you sure to update?',
        'footer'  => "<button
            type='button'
            wire:loading.attr='disabled'
            wire:click.prevent='update'
            class='btn btn-gradient-primary'>Confirm</button>"
    ])

    @include('admin.share.processing', ['target' => 'update'])
</div><!--end settings detail-->

@push('scripts')
    <script>
      window.addEventListener('begin-update', () => {
        $('#updateModalProfile').modal('toggle');
      });

      window.addEventListener('updated-profile', e => {
        $('#wrap-cotent_qr_code').html(e.detail.qr_content);
      })
    </script>
@endpush