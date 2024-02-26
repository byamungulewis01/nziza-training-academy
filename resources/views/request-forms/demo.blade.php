<x-request-layout>
    <section id="landingContact" class="section-py bg-body landing-contact">
        <div class="container" style="width: 80%">

            <h1 class="text-center mb-1 mt-5"> Free Demo for Companies and Entities</h1>
            <p class="text-center mb-4 mb-lg-5 pb-md-3">Seeking expert advices for digital transformation in your
                engineering and infrastructure projects? Complete the form below to secure a complimentary
                demonstration from our team of technology specialists.</p>
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="position-relative border p-2 h-100">
                        <img src="{{ asset('assets/img/front-pages/icons/contact-border.png') }}" alt="contact border"
                            class="contact-border-img position-absolute d-none d-md-block scaleX-n1-rtl" />
                        <img src="{{ asset('assets/img/nziza/demo.png') }}" alt="contact customer service"
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
                            <h4 class="mb-4">Demo Request</h4>

                            <form action="{{ route('storeDemo') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label fs-6" for="topic">Topic of Demo
                                            <span class="text-danger fs-6">*</span></label>
                                        <input type="text" name="topic" value="{{ old('topic') }}" class="form-control" id="topic"
                                            placeholder="Write here what you need us to demostrate to your company" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="company_name">Company Name
                                            <span class="text-danger">*</span></label>
                                        <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control" id="company_name"
                                            placeholder="Your Company Name " />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="email">Email Address<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="email" value="{{ old('email') }}" id="email" class="form-control"
                                            placeholder="email@gmail.com" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="phone">Phone
                                            Number<span class="text-danger">*</span></label>
                                        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone"
                                            placeholder="Phone Number" />
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fs-6" for="date">Suggest a Date and
                                            Time<span class="text-danger">*</span></label>
                                        <input name="suggest_date" value="{{ old('suggest_date') }}" type="text" class="form-control flatpickr-input"
                                            placeholder="YYYY-MM-DD" id="date" readonly="readonly">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fs-6" for="contact-form-message">Message</label>
                                        <textarea id="contact-form-message" name="comments" class="form-control" rows="8" placeholder="Write a message">{{ old('comments') }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Request Demo</button>
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
