@extends('layouts.app')

@section('title', 'Logging')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/datatables/media/css/jquery.dataTables.css') }}">
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Logging</h1>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class=" mb-3">
                                <select class="custom-select custom-select-sm" id="options">
                                    <option selected value="0">Pilih Alat</option>
                                    @foreach ($devices as $device )
                                        <option value="{{$device->id}}">{{$device->name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                            <div class="table-responsive">
                                <table class="table-striped table"
                                    id="loggingTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Device Time</th>
                                            <th>Pompa PH</th>
                                            <th>Pompa EC</th>
                                            <th>PH</th>
                                            <th>EC</th>
                                            <th>TDS</th>
                                            <th>Water Level</th>
                                            <th>Temperature</th>
                                            <th>Humidity</th>
                                            <th>Water Temperature</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-body">
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    {{-- <script src="assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script> --}}
    {{-- <script src="assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>  --}}
    {{-- <script src="{{ asset('library/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset() }}"></script> --}}
    {{-- <script src="{{ asset() }}"></script> --}}
    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script>
        $(document).ready(function() {
            var table = $('#loggingTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url : "{{ route('logging') }}",
                    data : {'deviceId' : localStorage.getItem('selectedOption')},
                },
                columnDefs: [
                { 
                    orderable: false,
                    targets: [0,1,2,3,4,5,6,7,8,9,10]
                }
                ],
                order: [],
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'device_time', name: 'device_time'},
                {data: 'pompa_ph', name: 'pompa_ph'},
                {data: 'pompa_ec', name: 'pompa_ec'},
                {data: 'ph', name: 'ph'},
                {data: 'ec', name: 'ec'},
                {data: 'tds', name: 'tds'},
                {data: 'water_level', name: 'water_level'},
                {data: 'temperature', name: 'temperature'},
                {data: 'humidity', name: 'humidity'},
                {data: 'water_temp', name: 'water_temp'}
                ] 
            });

            selectDevice();

            function refreshTable() {
                table.draw();
            }

            function selectDevice(){
                const selectElement = $('#options');
                selectElement.on('change', function() {
                    const selectedValue = selectElement.val();
                    localStorage.setItem('selectedOption', selectedValue);
                    // console.log(localStorage.getItem('selectedOption'));
                    refreshTable();
                    location.reload();
                });

                // Cek apakah ada data tersimpan di Local Storage saat halaman dimuat
                const savedValue = localStorage.getItem('selectedOption');
                if (savedValue) {
                    selectElement.val(savedValue);
                }

            }

           
        });
       

        

        

    </script>
    {{-- <script src="{{ asset('js/page/modules-datatables.js') }}"></script> --}}
@endpush
