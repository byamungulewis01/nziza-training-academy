@section('title', 'Profile')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row fv-plugins-icon-container">
            <div class="col-md-6">

                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>
                    <!-- Account -->
                    <form id="formAccountSettings" method="post" action="{{ route('profile.update') }}"
                        class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ asset('assets/img/avatars/user.png') }}" alt="user-avatar"
                                    class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                                <div class="button-wrapper">
                                    <label for="upload" class="btn btn-primary me-2 mb-3 waves-effect waves-light"
                                        tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="ti ti-upload d-block d-sm-none"></i>
                                        <input type="file" name="profile" id="upload" class="account-file-input" hidden=""
                                            accept="image/png, image/jpeg, image/jpg">
                                    </label>
                                    <button type="button"
                                        class="btn btn-label-secondary account-image-reset mb-3 waves-effect">
                                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>

                                    <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0">
                        <div class="card-body">

                            <div class="row">
                                <div class="mb-3 col-md-12 fv-plugins-icon-container">
                                    <label for="name" class="form-label">Full Name</label>
                                    <x-text-input class="form-control" id="name" name="name" type="text"
                                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                    <x-input-error class="mt-2 text-danger" :messages="$errors->get('name')" />

                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">E-mail</label>

                                    <x-text-input id="email" name="email" type="email" class="form-control"
                                        :value="old('email', $user->email)" required autocomplete="username" />

                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="phone" class="form-label">Phone Number</label>

                                    <x-text-input id="phone" name="phone" type="text" class="form-control"
                                        :value="old('phone', $user->phone)" required autocomplete="phone" />

                                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />

                                </div>


                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    <div>
                                        <p class="text-sm mt-2 text-gray-800">
                                            {{ __('Your email address is unverified.') }}

                                            <button form="send-verification"
                                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{ __('Click here to re-send the verification email.') }}
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p class="mt-2 font-medium text-sm text-green-600">
                                                {{ __('A new verification link has been sent to your email address.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif

                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save
                                    changes</button>
                                <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                            </div>
                            <input type="hidden">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">

                <div class="card mb-4">
                    <h5 class="card-header">Change Password</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="card-body">
                            <form id="formAccountSettings" method="post" action="{{ route('password.update') }}"
                                class="fv-plugins-bootstrap5 row fv-plugins-framework" novalidate="novalidate">
                                @csrf
                                @method('put')

                                <div class="mb-3 col-md-12 form-password-toggle fv-plugins-icon-container">
                                    <label class="form-label" for="update_password_current_password">Current
                                        Password</label>
                                    <div class="input-group input-group-merge has-validation">

                                        <x-text-input id="update_password_current_password" name="current_password"
                                            type="password" placeholder="············" class="form-control"
                                            autocomplete="current-password" />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="ti ti-eye-off"></i></span>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-danger mt-2" />

                                </div>
                                <div class="mb-3 col-md-12 form-password-toggle fv-plugins-icon-container">
                                    <label class="form-label" for="update_password_password">New Password</label>
                                    <div class="input-group input-group-merge has-validation">

                                        <x-text-input id="update_password_password" name="password" type="password"
                                            placeholder="············" class="form-control"
                                            autocomplete="new-password" />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="ti ti-eye-off"></i></span>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="text-danger mt-2" />
                                </div>

                                <div class="mb-3 col-md-12 form-password-toggle fv-plugins-icon-container">
                                    <label class="form-label" for="update_password_password_confirmation">Confirm New
                                        Password</label>
                                    <div class="input-group input-group-merge has-validation">

                                        <x-text-input id="update_password_password_confirmation"
                                            name="password_confirmation" type="password" placeholder="············"
                                            class="form-control" autocomplete="new-password" />
                                        <span class="input-group-text cursor-pointer"><i
                                                class="ti ti-eye-off"></i></span>
                                    </div>
                                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-danger mt-2" />

                                </div>
                                <div class="col-12 mb-4">
                                    <h6>Password Requirements:</h6>
                                    <ul class="ps-3 mb-0">
                                        <li class="mb-1">Minimum 6 characters long - the more, the better</li>
                                        <li class="mb-1">At least one lowercase character</li>
                                        <li>At least one number, symbol, or whitespace character</li>
                                    </ul>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save
                                        changes</button>
                                    <button type="reset"
                                        class="btn btn-label-secondary waves-effect">Cancel</button>
                                </div>
                        </div>
                        <input type="hidden">
                        </form>
                    </div>
                    <!-- /Account -->
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
