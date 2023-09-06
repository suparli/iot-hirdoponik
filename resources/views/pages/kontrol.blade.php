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
                            <div class="mb-4 mt-3">
                                <div id="online" style="display : none">
                                    <span class="badge badge-pill badge-success">Online</span>
                                </div>
                                <div id="offline" >
                                    <span class="badge badge-pill badge-danger">Offline</span>
                                  </div>
                            </div>
                            <form id="formKontrol">
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="pompaPh" >
                                            <label class="custom-control-label " for="pompaP">Pompa PH</label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="pompaEc">
                                            <label class="custom-control-label" for="pompaEc">Pompa EC</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="interval">Interval Logging</label>
                                        <input type="text" class="form-control" id="interval" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="baPh">Batas Atas PH</label>
                                        <input type="text" class="form-control" id="baPh" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="bbPh">Batas Bawah PH</label>
                                        <input type="text" class="form-control" id="bbPh" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="baEc">Batas Atas EC</label>
                                        <input type="text" class="form-control" id="baEc" required>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="bbEc">Batas Bawah EC</label>
                                        <input type="text" class="form-control" id="bbEc" required>
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
        
});

function sendForm(){
   
    $("#formKontrol").submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize(); // Mengambil data form dalam bentuk query string

    $.ajax({
        type: "POST",
        url: "URL_TARGET",
        data: formData,
        success: function(response) {
            console.log("Data terkirim!");
        },
        error: function() {
            console.error("Terjadi kesalahan.");
        }
    });
});
}

function isOnline(){
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '{{ route('kontrol') }}', // Gantilah dengan URL Anda
        type: 'GET',
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
                console.log('online');
                divOffline.style.display = 'none';
                divOnline.style.display = 'block';
            } else {
                console.log('offline');
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
    $.ajax({
        url: '{{ route('kontrol') }}', // Gantilah dengan URL Anda
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': csrfToken // Menambahkan token CSRF ke dalam header
        },
        success: function(data) {
            (data.pompa_ph == 1 ) ?  $("#pompaPh").prop("checked", true) : $("#pompaPh").prop("checked", false) ;
            (data.pompa_ec == 1 ) ? $("#pompaEc").prop("checked", true) : $("#pompaEc").prop("checked", false);
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
