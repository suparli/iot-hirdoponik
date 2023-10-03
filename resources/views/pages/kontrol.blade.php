@extends('layouts.app')

@section('title', 'Kontrol')

@push('style')
    <!-- CSS Libraries -->
    <style>
    .custom-control-label
        {
            font-weight: 600;
            color: #34395e;
            font-size: 12px;
            letter-spacing: 0.5px;
        }
    </style>
@endpush

@section('main')<div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Kontrol</h1>
                
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3">
                                    <select class="custom-select custom-select-sm mr-3" id="options">
                                        <option selected value="0">Pilih Alat</option>
                                        @foreach ($devices as $device )
                                            <option value="{{$device->id}}">{{$device->name}}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="mb-4 mt-3">
                                <div id="online" style="display : none">
                                    <span class="badge badge-pill badge-success">Online</span>
                                </div>
                                <div id="offline" >
                                    <span class="badge badge-pill badge-danger">Offline</span>
                                  </div>
                            </div>
                            
                            <form id="myForm">
                                
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="pompaPh" name="pompaPh" >
                                            <label class="custom-control-label " for="pompaPh">Pompa A<label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="pompaEc" name="pompaEc">
                                            <label class="custom-control-label" for="pompaEc">Pompa B</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="interval">Interval Logging</label>
                                        <input type="text" class="form-control" id="interval" name="interval" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="mode" name="mode">
                                            <label class="custom-control-label" for="mode">Mode Otomatis</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="baPh">Batas Atas PH</label>
                                        <input type="text" class="form-control" id="baPh" name="baPh" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="bbPh">Batas Bawah PH</label>
                                        <input type="text" class="form-control" id="bbPh" name="bbPh" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="baEc">Batas Atas EC</label>
                                        <input type="text" class="form-control" id="baEc" name="baEc" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="bbEc">Batas Bawah EC</label>
                                        <input type="text" class="form-control" id="bbEc" name="bbEc" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                  </div>
                                </div>
                            </form>
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
<script>
    
$(document).ready(function() {
    getData();
    setInterval(isOnline, 1000);
    sendForm();
    selectDevice(); 
    
});

function selectDevice(){
    const selectElement = $('#options');
    selectElement.on('change', function() {
        const selectedValue = selectElement.val();
        localStorage.setItem('selectedOption', selectedValue);
        console.log(localStorage.getItem('selectedOption'));
        getData()
    });

    // Cek apakah ada data tersimpan di Local Storage saat halaman dimuat
    const savedValue = localStorage.getItem('selectedOption');
    if (savedValue) {
        selectElement.val(savedValue);
    }

}

function sendForm(){
   
    $("#myForm").submit(function(event) {
        event.preventDefault();
        const deviceId = localStorage.getItem('selectedOption');
        var formData = $(this).serialize();
        var formData = formData+"&deviceId="+deviceId;
        // Mengambil data form dalam bentuk query string
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "POST",
            url: "{{ route('kontrol.update') }}",
            data: formData,
            headers: {
            'X-CSRF-TOKEN': csrfToken // Menambahkan token CSRF ke dalam header
            },
            success: function(response) {
                if(response=='success'){
                    alert('Data Terkirim');
                }
            },
            error: function() {
                console.error("Terjadi kesalahan.");
                alert('Terjadi kesalahan');
                
            }
        });
    });
}

function isOnline(){
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    const deviceId = localStorage.getItem('selectedOption');
    $.ajax({
        url: '{{ route('kontrol') }}', // Gantilah dengan URL Anda
        type: 'GET',
        data : {'deviceId' : deviceId},
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': csrfToken // Menambahkan token CSRF ke dalam header
        },
        success: function(data) {
            var deviceTime = new Date(data.device_time); // Waktu alat
            var currentTime = new Date(); // Waktu sekarang
            var timeDifference = (currentTime - deviceTime) / 1000; // Menghitung perbedaan waktu dalam detik
            var divOnline = document.getElementById('online');
            var divOffline = document.getElementById('offline');

            if (timeDifference < 60){
                // console.log('online');
                divOffline.style.display = 'none';
                divOnline.style.display = 'block';
            } else {
                // console.log('offline');
                divOffline.style.display = 'block';
                divOnline.style.display = 'none';
            }

            
            // Data berhasil diambil, sekarang kita dapat menampilkan data di halaman web
            
        },
        error: function(error) {
            console.log('Terjadi kesalahan:', error);
        }
    });
}

function getData(){
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    const deviceId = localStorage.getItem('selectedOption');
    $.ajax({
        url: '{{ route('kontrol') }}', // Gantilah dengan URL Anda
        type: 'GET',
        dataType: 'json',
        data : {'deviceId' : deviceId},
        headers: {
            'X-CSRF-TOKEN': csrfToken // Menambahkan token CSRF ke dalam header
        },
        success: function(data) {
            (data.pompa_ph == 1 ) ?  $("#pompaPh").prop("checked", true) : $("#pompaPh").prop("checked", false) ;
            (data.pompa_ec == 1 ) ? $("#pompaEc").prop("checked", true) : $("#pompaEc").prop("checked", false);
            (data.mode == true) ? $("#mode").prop("checked", true) : $("#mode").prop("checked", false);
            $("#interval").val(data.interval);
            $("#baPh").val(data.ba_ph);
            $("#bbPh").val(data.bb_ph);
            $("#baEc").val(data.ba_ec);
            $("#bbEc").val(data.bb_ec);
            console.log(data)
            // Data berhasil diambil, sekarang kita dapat menampilkan data di halaman web
            
        },
        error: function(error) {
            console.log('Terjadi kesalahan:', error);
            alert('Terjadi kesalahan: ', error);
        }
    });
}


</script>
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
