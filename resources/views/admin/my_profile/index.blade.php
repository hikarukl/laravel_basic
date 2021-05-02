<x-app-layout>
    <div class="page-content">

        <div class="container-fluid">
            <div class="row">
                {{-- Page title and Breadcrumb --}}
                @include("admin.share.page_information");
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body met-pro-bg">
                            <div class="met-profile">
                                <div class="row">
                                    <div class="col-lg-4 align-self-center mb-3 mb-lg-0">
                                        <div class="met-profile-main">
                                            <div class="met-profile-main-pic">
                                                <img src="{{ asset("images/users/user-4.jpg") }}" alt="" class="rounded-circle">
                                                <span class="fro-profile_main-pic-change">
                                                    <i class="fas fa-camera"></i>
                                                </span>
                                            </div>
                                            <div class="met-profile_user-detail">
                                                <h5 class="met-user-name">{{ $user->name }}</h5>
                                            </div>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-4 ml-auto">
                                        <ul class="list-unstyled personal-detail">
                                            <li class=""><i class="dripicons-phone mr-2 text-info font-18"></i> <b> phone </b> : {{ $user->phone }}</li>
                                            <li class="mt-2"><i class="dripicons-mail text-info font-18 mt-2 mr-2"></i> <b> Email </b> : {{ $user->email }}</li>
                                        </ul>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div><!--end f_profile-->
                        </div><!--end card-body-->

                        <div class="card-body">
                            <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="settings_detail_tab" data-toggle="pill" href="#settings_detail">Profile</a>
                                </li>
                            </ul>
                        </div><!--end card-body-->

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="tab-content detail-list" id="pills-tabContent">
                        @livewire('admin.my-profile-form')
                    </div><!--end tab-content-->

                </div><!--end col-->
            </div><!--end row-->
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset("plugins/dropify/js/dropify.min.js") }}"></script>
        <script src="{{ asset("pages/jquery.profile.init.js") }}"></script>
        <script src="{{ asset("plugins/filter/isotope.pkgd.min.js") }}"></script>
        <script src="{{ asset("plugins/filter/masonry.pkgd.min.js") }}"></script>
        <script src="{{ asset("plugins/filter/jquery.magnific-popup.min.js") }}"></script>
        <script src="{{ asset("pages/jquery.gallery.inity.js") }}"></script>

        <script>
          /*Livewire.on('enableTwoFactor', val => {
            console.log(val);
          })*/
        </script>
    @endpush
</x-app-layout>