@extends('layouts.admin.app')

@section('title',__('messages.profile_settings'))

@push('css_or_js')

@endpush

@section('content')
    <!-- Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div>
                    <h1 class="page-header-title">
                        <span class="page-header-icon"><i class="tio-settings"></i></span>
                        <span>{{__('messages.settings')}}</span>    
                    </h1>
                </div>
                <div>
                    <a class="btn btn--primary" href="{{route('admin.dashboard')}}">
                        <i class="tio-home mr-1"></i> {{__('messages.dashboard')}}
                    </a>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="row">
            <div class="col-lg-3">
                <!-- Navbar -->
                <div class="navbar-vertical navbar-expand-lg mb-3 mb-lg-5 profile-sidebar-sticky">
                    <!-- Navbar Toggle -->
                    <button type="button" class="navbar-toggler btn btn-block btn-white mb-3"
                            aria-label="Toggle navigation" aria-expanded="false" aria-controls="navbarVerticalNavMenu"
                            data-toggle="collapse" data-target="#navbarVerticalNavMenu">
                <span class="d-flex justify-content-between align-items-center">
                  <span class="h5 mb-0">{{__('messages.nav_menu')}}</span>

                  <span class="navbar-toggle-default">
                    <i class="tio-menu-hamburger"></i>
                  </span>

                  <span class="navbar-toggle-toggled">
                    <i class="tio-clear"></i>
                  </span>
                </span>
                    </button>
                    <!-- End Navbar Toggle -->

                    <div id="navbarVerticalNavMenu" class="collapse navbar-collapse">
                        <!-- Navbar Nav -->
                        <ul id="navbarSettings"
                            class="js-sticky-block js-scrollspy navbar-nav navbar-nav-lg nav-tabs card card-navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active text-dark" href="javascript:" id="generalSection">
                                    <i class="tio-user-outlined nav-icon"></i> {{__('messages.basic_information')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="javascript:" id="passwordSection">
                                    <i class="tio-lock-outlined nav-icon"></i> {{__('messages.password')}}
                                </a>
                            </li>
                        </ul>
                        <!-- End Navbar Nav -->
                    </div>
                </div>
                <!-- End Navbar -->
            </div>

            <div class="col-lg-9">
                <form action="{{env('APP_MODE')!='demo'?route('admin.settings'):'javascript:'}}" method="post" enctype="multipart/form-data" id="admin-settings-form">
                @csrf
                <!-- Card -->
                    <div class="card mb-3" id="generalDiv">
                        <!-- Profile Cover -->
                        <div class="profile-cover">
                            <div class="profile-cover-img-wrapper"></div>
                        </div>
                        <!-- End Profile Cover -->

                        <!-- Avatar -->
                        <label
                            class="avatar avatar-xxl avatar-circle avatar-border-lg avatar-uploader profile-cover-avatar"
                            for="avatarUploader">
                            <img id="viewer"
                                 onerror="this.src='{{asset('/assets/admin/img/160x160/img1.jpg')}}'"
                                 class="avatar-img"
                                 src="{{asset('storage/app/public/admin')}}/{{auth('admin')->user()->image}}"
                                 alt="Image">

                            <input type="file" name="image" class="js-file-attach avatar-uploader-input"
                                   id="customFileEg1"
                                   accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            <label class="avatar-uploader-trigger" for="customFileEg1">
                                <i class="tio-edit avatar-uploader-icon shadow-soft"></i>
                            </label>
                        </label>
                        <!-- End Avatar -->
                    </div>
                    <!-- End Card -->

                    <!-- Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h2 class="card-title h4">
                                <i class="tio-info"></i> {{__('messages.basic_information')}}
                            </h2>
                        </div>

                        <!-- Body -->
                        <div class="card-body">
                            <!-- Form -->
                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="firstNameLabel" class="col-sm-3 col-form-label input-label">{{__('messages.full_name')}} <i
                                        class="tio-help-outlined text-body ml-1" data-toggle="tooltip"
                                        data-placement="top"
                                        title="Display name"></i></label>

                                <div class="col-sm-9">
                                    <div class="input-group input-group-sm-down-break">
                                        <input type="text" class="form-control h--45px" name="f_name" id="firstNameLabel"
                                               placeholder="Ex: Jhone" aria-label="{{__('messages.your_first_name')}}"
                                               value="{{auth('admin')->user()->f_name}}">
                                        <input type="text" class="form-control h--45px" name="l_name" id="lastNameLabel"
                                               placeholder="Ex: Doe" aria-label="{{__('messages.your_last_name')}}"
                                               value="{{auth('admin')->user()->l_name}}">
                                    </div>
                                </div>
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="phoneLabel" class="col-sm-3 col-form-label input-label">{{__('messages.phone')}} <span
                                        class="input-label-secondary">({{__('messages.optional')}})</span></label>

                                <div class="col-sm-9">
                                    <input type="text" class="js-masked-input form-control h--45px" name="phone" id="phoneLabel"
                                           placeholder="Ex: +x(xxx)xxx-xx-xx" aria-label="+(xxx)xx-xxx-xxxxx"
                                           value="{{auth('admin')->user()->phone}}"
                                           data-hs-mask-options='{
                                           "template": "+(880)00-000-00000"
                                         }'>
                                </div>
                            </div>
                            <!-- End Form Group -->

                            <div class="row form-group">
                                <label for="newEmailLabel" class="col-sm-3 col-form-label input-label">{{__('messages.email')}}</label>

                                <div class="col-sm-9">
                                    <input type="email" class="form-control h--45px" name="email" id="newEmailLabel"
                                           value="{{auth('admin')->user()->email}}"
                                           placeholder="Ex: jhone@company.com" aria-label="{{__('messages.enter_new_email_address')}}">
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" onclick="{{env('APP_MODE')!='demo'?"form_alert('admin-settings-form','Want to update admin info ?')":"call_demo()"}}" class="btn btn--primary">{{__('messages.save')}}</button>
                            </div>

                            <!-- End Form -->
                        </div>
                        <!-- End Body -->
                    </div>
                    <!-- End Card -->
                </form>

                <!-- Card -->
                <div id="passwordDiv" class="card mb-3">
                    <div class="card-header">
                        <h4 class="card-title"><i class="tio-lock"></i> {{__('messages.change_your_password')}}</h4>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <!-- Form -->
                        <form id="changePasswordForm" action="{{env('APP_MODE')!='demo'?route('admin.settings-password'):'javascript:'}}" method="post"
                              enctype="multipart/form-data">
                        @csrf

                        <!-- Form Group -->
                            <div class="row form-group">
                                <label for="newPassword" class="col-sm-3 col-form-label input-label">{{__('messages.new_password')}}</label>

                                <div class="col-sm-9">
                                    <input type="password" class="js-pwstrength form-control h--45px" name="password"
                                           id="newPassword" placeholder="Ex: 5+ characters required"
                                           aria-label="{{__('messages.enter_new_password')}}"
                                           data-hs-pwstrength-options='{
                                           "ui": {
                                             "container": "#changePasswordForm",
                                             "viewports": {
                                               "progress": "#passwordStrengthProgress",
                                               "verdict": "#passwordStrengthVerdict"
                                             }
                                           }
                                         }' required>

                                    <p id="passwordStrengthVerdict" class="form-text mb-2"></p>

                                    <div id="passwordStrengthProgress"></div>
                                </div>
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div class="row form-group">
                                <label for="confirmNewPasswordLabel" class="col-sm-3 col-form-label input-label">{{__('messages.confirm_password')}}</label>

                                <div class="col-sm-9">
                                    <div class="mb-3">
                                        <input type="password" class="form-control h--45px" name="confirm_password"
                                               id="confirmNewPasswordLabel" placeholder="Ex: 5+ characters required"
                                               aria-label="{{__('messages.confirm_new_password')}}" required>
                                    </div>
                                </div>
                            </div>
                            <!-- End Form Group -->

                            <div class="d-flex justify-content-end">
                                <button type="button" onclick="{{env('APP_MODE')!='demo'?"form_alert('changePasswordForm','".__('messages.want_to_update_admin_password')."')":"call_demo()"}}" class="btn btn--primary">{{__('messages.save')}}</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->

                <!-- Sticky Block End Point -->
                <div id="stickyBlockEndPoint"></div>
            </div>
        </div>
        <!-- End Row -->
    </div>
    <!-- End Content -->
@endsection

@push('script_2')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
        });
    </script>

    <script>
        $("#generalSection").click(function() {
            $("#passwordSection").removeClass("active");
            $("#generalSection").addClass("active");
            $('html, body').animate({
                scrollTop: $("#generalDiv").offset().top - 60
            }, 600);
        });

        $("#passwordSection").click(function() {
            $("#generalSection").removeClass("active");
            $("#passwordSection").addClass("active");
            $('html, body').animate({
                scrollTop: $("#passwordDiv").offset().top - 100
            }, 600);
        });
    </script>
@endpush
