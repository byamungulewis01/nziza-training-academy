@section('title', 'Quotations')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Quotations </h5>

            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables table border-top">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Position</th>
                            <th>Trainings</th>
                            <th>Licences</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($quotes as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->company_name }}</td>
                                <td>{{ $item->position }}</td>

                                <td>
                                    @php
                                        $trainings = explode('_', $item->trainings);
                                    @endphp
                                    @foreach ($trainings as $training)
                                        {{ \App\Models\Course::find($training)->name }} <br>
                                        <hr>
                                    @endforeach

                                </td>
                                <td>
                                    @php
                                        $licences = explode('_', $item->licence);
                                    @endphp
                                    @foreach ($licences as $licence)
                                        {{ @\App\Models\Licence::find($licence)->name }} <br>
                                        <hr>
                                    @endforeach
                                </td>
                                <td>{{ $item->comments }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @section('css')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    @endsection

    @section('js')
        <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>


        <script>
            $(document).ready(function() {
                $('.datatables').DataTable({});
            });
        </script>
    @endsection
</x-app-layout>
