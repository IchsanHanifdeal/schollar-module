@include('lecturer.layout.header')

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 col-6">
                <div class="card mb-3 mt-3">
                    <div class="card-title">
                        <h4 class="mt-3 mb-3 ml-3"><i class="fas fa-table"></i> Tambah {{ $title }}</h4>
                    </div>
                    <form action="{{ route('store_absensi') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mt-2 mb-2">
                                    <label for="name">Nama :</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ $name }}" readonly>
                                </div>
                                @php
                                    $date = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
                                    $tanggal = $date->format('Y-m-d');
                                    $waktu = $date->format('H:i');
                                @endphp
                                <div class="col-md-6 mt-2 mb-2">
                                    <label for="tanggal">Tanggal :</label>
                                    <input type="date" id="tanggal" name="tanggal" class="form-control"
                                        value="{{ $tanggal }}" readonly>
                                </div>
                                <div class="col-md-6 mt-2 mb-2">
                                    <label for="waktu">Waktu :</label>
                                    <input type="time" id="waktu" name="waktu" class="form-control"
                                        value="{{ $waktu }}" readonly>
                                </div>
                                <div class="col-md-12 mt-2 mb-2">
                                    <label for="Lokasi">Lokasi :</label>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control"
                                        placeholder="Masukan lokasi">
                                </div>
                                <div class="col-md-6 mt-2 mb-2">
                                    <label for="Latitude" style="display: none;">Latitude :</label>
                                    <input type="hidden" id="latitude" name="latitude" class="form-control"
                                        value="">
                                </div>
                                <div class="col-md-6 mt-2 mb-2">
                                    <label for="longitude" style="display: none;">Longitude :</label>
                                    <input type="hidden" id="longitude" name="longitude" class="form-control"
                                        value="">
                                </div>
                                <div class="col-md-6 mt-2 mb-2">
                                    <label for="foto">Foto :</label>
                                    <input type="file" id="foto" name="foto" class="form-control"
                                        value="">
                                </div>
                                <div class="col-md-6 mt-2 mb-2">
                                    <label for="status">Status :</label>
                                    <select id="status" name="status" class="form-control" value="">
                                        <option value="">--- Pilih Status Kehadiran ---</option>
                                        <option value="hadir">Hadir</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="alpa">Alpa</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mt-2 mb-2">
                                    <label for="keterangan">Keterangan :</label>
                                    <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Masukan keterangan jika ada"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2 mb-2 ml-2 mr-2">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Kirim Absensi</button>
                        </div>
                    </form>
                    @include('lecturer.layout.footer')

                    <script>
                        window.addEventListener('load', function() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function(position) {
                                    document.getElementById('latitude').value = position.coords.latitude;
                                    document.getElementById('longitude').value = position.coords.longitude;
                                });
                            }
                        });
                    </script>
