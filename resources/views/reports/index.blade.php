@section('title', 'Reports')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Dairly Report
                    <a class="btn btn-dark text-white pull-left float-end" data-bs-toggle="modal"
                        data-bs-target="#addModel"><i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span
                            class="d-none d-sm-inline-block">ToDay</span></a>
                </h5>
                <!-- New User Modal -->
                <div class="modal fade" id="addModel" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                        <div class="modal-content p-3 p-md-5">
                            <div class="modal-body">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                                <div class="text-center mb-">
                                    <h3 class="mb-2"><span class="text-warning">{{ now()->format('l') }}</span>'s report</h3>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <p><strong>Opps Something went wrong</strong></p>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>* {{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <form action="{{ route('client.store') }}" class="row g-3" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="note" class="form-label fw-bold">BEFORENOON:</label>
                                            <div class="editor-beforenoon" style="height: 200px;max-height: 200px;"></div>
                                            <input type="hidden" name="notes" id="notes-input">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-4">
                                            <label for="note" class="form-label fw-medium">AFTERNOON:</label>
                                            <div class="editor-afternoon" style="height: 200px;max-height: 200px;"></div>
                                            <input type="hidden" name="notes" id="notes-input">
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                            aria-label="Close">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ New User Modal -->
            </div>
        </div>

    </div>
    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
    @endsection

    @section('js')
        <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
        <script>
            var quill = new Quill(".editor-beforenoon", {
                bounds: ".editor-beforenoon",
                placeholder: "Before noon report...",
                modules: {
                    formula: !0,
                    toolbar: [
                        ["bold", "italic", "underline", "strike"],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        [{
                            script: "super"
                        }, {
                            script: "sub"
                        }],
                        [{
                                list: "ordered"
                            },
                            {
                                list: "bullet"
                            },
                            {
                                indent: "-1"
                            },
                            {
                                indent: "+1"
                            },
                        ],
                        ["link"],
                    ],
                },
                theme: "snow",
            });


            // Listen for changes in the Quill editor
            quill.on('text-change', function() {
                // Update the hidden input field with the editor's HTML content
                document.getElementById('notes-input').value = quill.root.innerHTML;
            });
        </script>
        <script>
            var quill = new Quill(".editor-afternoon", {
                bounds: ".editor-afternoon",
                placeholder: "After noon report...",
                modules: {
                    formula: !0,
                    toolbar: [
                        ["bold", "italic", "underline", "strike"],
                        [{
                            color: []
                        }, {
                            background: []
                        }],
                        [{
                            script: "super"
                        }, {
                            script: "sub"
                        }],
                        [{
                                list: "ordered"
                            },
                            {
                                list: "bullet"
                            },
                            {
                                indent: "-1"
                            },
                            {
                                indent: "+1"
                            },
                        ],
                        ["link"],
                    ],
                },
                theme: "snow",
            });


            // Listen for changes in the Quill editor
            quill.on('text-change', function() {
                // Update the hidden input field with the editor's HTML content
                document.getElementById('notes-input').value = quill.root.innerHTML;
            });
        </script>
    @endsection
</x-app-layout>
