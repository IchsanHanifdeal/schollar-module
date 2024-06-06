@include('lecturer.layout.header')
<div class="content">
    <div class="container-fluid d-flex justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-bold text-center">
                    <span>{{ $title }}</span>
                </div>
                <form action="{{ route('update.lecturer',['id_dosen' => $dosen->id_dosen ]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nip">NIP :</label>
                                <input type="text" name="nip" id="nip" class="form-control" value="{{ $dosen->nip }}">
                            </div>
                            <div class="col-md-6">
                                <label for="nama">Nama :</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $dosen->name }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="jeniskelamin">Jenis Kelamin :</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                    <option value="L" {{ $dosen->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $dosen->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="tempatlahir">Tempat Lahir :</label>
                                <input type="text" name="tempat_lahir" id="name" class="form-control" value="{{ $dosen->alamat }}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="Tanggal Lahir">Tanggal Lahir :</label>
                                <input type="date" name="tanggal_lahir" id="name" class="form-control" value="{{ $dosen->tanggal_lahir }}">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="Alamat">Alamat :</label>
                                <textarea type="text" name="alamat" id="name" class="form-control" rows="4">{{ $dosen->tempat_lahir }}</textarea>

                            </div>
                            <div class="col-md-12 mt-2">
                                <label for="No Handphone">No Handphone :</label>
                                <input type="text" name="no_hp" id="name" class="form-control" value="{{ $dosen->no_hp }}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="Email">Email :</label>
                                <input type="text" name="email" id="name" class="form-control" value="{{ $dosen->email }}">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="Email">Username :</label>
                                <input type="text" name="username" id="name" class="form-control" value="{{ $dosen->username }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <a class="btn btn-secondary mr-2" href="{{ route('dashboard')}}"><i class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('lecturer.layout.footer')
