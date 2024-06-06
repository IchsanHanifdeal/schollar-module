@include('lecturer.layout.header')

<div class="col-md-4">
    <div class="card">
        <div class="card-header text-bold text-center">
            <span>Profile</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <label for="nip">NIP :</label>
                    <input type="text" name="nip" id="nip" class="form-control" value="{{ $dosen->nip }}"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label for="nama">Nama :</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ session('name') }}" readonly>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="jeniskelamin">Jenis Kelamin :</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" readonly>
                        <option value="L" {{ $dosen->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $dosen->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="tempatlahir">Tempat Lahir :</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $dosen->tempat_lahir }}" readonly>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="Tanggal Lahir">Tanggal Lahir :</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $dosen->tanggal_lahir }}" readonly>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="Alamat">Alamat :</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $dosen->alamat }}" readonly>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="No Handphone">No Handphone :</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $dosen->no_hp }}"
                        readonly>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="Email">Email :</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ session('email') }}" readonly>
                </div>
                <div class="col-md-6 mt-2">
                    <label for="Email">Username :</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ session('username') }}" readonly>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end" style="font-family: 'Times New Roman', Times, serif">
            <a href="{{ route('edit.lecturer', $dosen->id_dosen) }}" class="btn btn-warning btn-sm"><i
                    class="fas fa-edit"></i> Edit Profile</a>
        </div>
    </div>
</div>
@include('lecturer.layout.footer')
