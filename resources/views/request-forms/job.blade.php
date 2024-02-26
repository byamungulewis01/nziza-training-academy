<x-request-layout>
    <section id="landingContact" class="section-py bg-body landing-contact">
        <div class="container" style="width: 80%">

            <h1 class="text-center mb-1 mt-5"> Job Vacancies</h1>
            <p class="text-center mb-4 mb-lg-5 pb-md-3">Job Vacancies in nziza</p>
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="position-relative border p-2 h-100">
                        {{-- <img src="{{ asset('assets/img/front-pages/icons/contact-border.png') }}" alt="contact border"
                            class="contact-border-img position-absolute d-none d-md-block scaleX-n1-rtl" /> --}}
                        <img src="{{ asset('assets/img/nziza/accountJob.jpg') }}" alt="contact customer service"
                            class="contact-img w-100 scaleX-n1-rtl" />
                        <div class="pt-3 px-4 pb-1">
                            <div class="row gy-3 gx-md-4">
                                <div class="col-md-8 col-lg-12 col-xl-8">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-primary rounded p-2 me-2"><i
                                                class="ti ti-mail ti-sm"></i></div>
                                        <div>
                                            <p class="mb-0">Email</p>
                                            <h5 class="mb-0">
                                                <a href="mailto:example@gmail.com"
                                                    class="text-heading">example@gmail.com</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">

                            @if (session()->has('success'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <span class="alert-icon text-success me-2">
                                    <i class="ti ti-check ti-xs"></i>
                                </span>
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <span class="alert-icon text-danger me-2">
                                    <i class="ti ti-ban ti-xs"></i>
                                </span>
                                {{ session()->get('error') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <span class="alert-icon text-danger me-2">
                                        <i class="ti ti-ban ti-xs"></i>
                                    </span>
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                            <h4 class="mb-4">Request Job</h4>

                            <form action="{{ route('storeJob') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="fname">First Name <span
                                                class="text-danger">*</span></label>
                                                <input type="hidden" name="title" value="Accountant"/>
                                        <input required type="text" name="fname" value="{{ old('fname') }}"
                                            class="form-control" id="fname" placeholder="First Name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="lname">Last Name<span
                                                class="text-danger">*</span></label>
                                        <input required type="text" id="lname" name="lname"
                                            value="{{ old('lname') }}" class="form-control" placeholder="Last Name" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="phone">Phone Number<span
                                                class="text-danger">*</span></label>
                                        <input required type="text" class="form-control" name="phone"
                                            value="{{ old('phone') }}" id="phone" placeholder="Phone Number" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="email">Email<span
                                                class="text-danger">*</span></label>
                                        <input required type="email" class="form-control"
                                            placeholder="email@gmail.com" name="email" id="email"
                                            value="{{ old('email') }}">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fs-6" for="contact-form-message">Cover Letter <span
                                            class="text-danger">*</span></label>
                                        <textarea id="contact-form-message" required name="cover_letter" class="form-control" rows="6"
                                            placeholder="Write a cover letter here"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fs-6" for="cv_url">CV <span class="text-danger">*</span> (PDF Only)</label>
                                        <input required type="file" accept=".pdf" class="form-control" name="cv_url" id="cv_url">
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-request-layout>
