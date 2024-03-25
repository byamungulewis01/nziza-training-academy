@section('title', 'monthly Goals')
<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title mb-0">Edit Goals
                </h5>
            </div>
            <div class="card-body">
                <div class="row px-0 px-sm-4">
                    <form action="{{ route('monthly_goals.update',$id) }}" method="post">
                        @method('PUT')
                        @if (session()->has('warning1'))
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <span class="alert-icon text-warning me-2">
                                    <i class="ti ti-ban ti-xs"></i>
                                </span>
                                {{ session()->get('warning1') }}
                            </div>
                        @endif
                        @csrf
                        <div class="col-12 mb-2">
                            <table id="item_table" style="width: 95%">
                                @foreach ($collection as $item)
                                <tr>
                                    <td>
                                        <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="" style="">
                                            <div class="d-flex border rounded position-relative pe-0">
                                                <div class="row w-100 p-3">
                                                    <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Service Type</p>
                                                        <select name="type[]" class="form-select mb-3" required>
                                                            <option {{  $item->type == 'training' ? 'selected' : '' }} value="training">Training Sales</option>
                                                            <option {{  $item->type == 'license' ? 'selected' : '' }} value="license">License Sales</option>
                                                        </select>
                                                        <div class="row">
                                                            <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                                <p class="mb-2 repeater-title">Numbers | Trainees</p>
                                                                <input type="number" name="quality[]" required
                                                                    class="form-control" value="{{ $item->quality }}" min="1">
                                                            </div>
                                                            <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                                <p class="mb-2 repeater-title">Estimated Revenues
                                                                    <strong>(USD)</strong>
                                                                </p>
                                                                <input type="number" name="revenue[]" required
                                                                    class="form-control mb-3" value="{{ $item->revenue }}"
                                                                    min="1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Targeting Client</p>
                                                        <input type="text" class="form-control mb-3"
                                                            name="client_name[]"
                                                            value="{{ $item->client_name }}" required>
                                                        <textarea class="form-control" required name="description[]" rows="3" placeholder="Deal Description">{{ $item->description }}</textarea>

                                                    </div>

                                                </div>
                                                <div
                                                    class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                                    <i class="ti ti-x cursor-pointer remove"
                                                        data-repeater-delete=""></i>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="button" class="btn btn-primary waves-effect waves-light me-3 add">Add List</button>
                            <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @section('css')

    @endsection

    @section('js')
        <script>
            $(document).ready(function() {

                $(document).on('click', '.add', function() {
                    var html = '';
                    var number_of_rows = $('#item_table tr').length + 1;

                    html +=
                        `<tr>
                                <td>
                                    <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="" style="">
                                        <div class="d-flex border rounded position-relative pe-0">
                                            <div class="row w-100 p-3">
                                                <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Service Type</p>
                                                    <select name="type[]" class="form-select mb-3" required>
                                                        <option value="training">Training Sales</option>
                                                        <option value="license">License Sales</option>
                                                    </select>
                                                    <div class="row">
                                                        <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                            <p class="mb-2 repeater-title">Numbers | Trainees</p>
                                                            <input type="number" name="quality[]" required class="form-control"
                                                                placeholder="1" min="1">
                                                        </div>
                                                        <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                            <p class="mb-2 repeater-title">Estimated Revenues <strong>(USD)</strong>
                                                            </p>
                                                            <input type="number" name="revenue[]" required class="form-control mb-3"
                                                                placeholder="00" min="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-md-0 mb-3">
                                                    <p class="mb-2 repeater-title">Targeting Client</p>
                                                    <input type="text" class="form-control mb-3" name="client_name[]" placeholder="Company or Client Name ..." required>
                                                    <textarea class="form-control" required name="description[]" rows="3" placeholder="Deal Description"></textarea>

                                                </div>

                                            </div>
                                            <div
                                                class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                                <i class="ti ti-x cursor-pointer remove" data-repeater-delete=""></i>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>`;
                    $('#item_table').append(html);
                });

                $(document).on('click', '.remove', function() {
                    $(this).closest('tr').remove();
                });

            });
        </script>
    @endsection
</x-app-layout>
