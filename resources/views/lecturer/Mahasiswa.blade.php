@include('lecturer.layout.header')

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-10 col-6">
                <div class="card mb-3 mt-3">
                    <div class="card-title">
                        <h4 class="mt-3 mb-3 ml-3"><i class="fas fa-table"></i> List {{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Nim</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat/Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>No Handphone</th>
                                    <th>Email</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if ($mahasiswa->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">Data is empty</td>
                                    </tr>
                                @else
                                    @foreach ($mahasiswa as $key => $m)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $m->nim }}</td>
                                            <td>{{ $m->name }}</td>
                                            <td>{{ $m->jurusan->nama_jurusan }}</td>
                                            <td>
                                                @if ($m->jenis_kelamin === 'L')
                                                    Laki-laki
                                                @elseif($m->jenis_kelamin === 'P')
                                                    Perempuan
                                                @else
                                                    Jenis Kelamin Tidak Diketahui
                                                @endif
                                            </td>
                                            <td>{{ $m->tempat_lahir }}/{{ $m->tanggal_lahir }}</td>
                                            <td>{{ $m->alamat }}</td>
                                            <td>{{ $m->no_hp }}</td>
                                            <td>{{ $m->email }}</td>
                                            <td class="button-container">
                                                <button type="button" data-toggle="modal"
                                                    data-target="#modal-edit-{{ $m->id_mahasiswa }}"
                                                    class="btn btn-warning btn-sm mr-1"><i
                                                        class="fas fa-edit"></i></button>
                                                <div class="modal fade" id="modal-edit-{{ $m->id_mahasiswa }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="modal-editLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-editLabel">
                                                                    {{ $m->name }}</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form
                                                                    action="{{ route('update_mahasiswa', $m->id_mahasiswa) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-md-6 mt-3 mb-2"
                                                                            style="display: none;">
                                                                            <label for="id_user">User Identity
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                id="id_user" name="id_user"
                                                                                value="{{ $m->id_user }}">
                                                                        </div>
                                                                        <div class="col-md-6 mt-3 mb-2">
                                                                            <label for="nim">NIM :</label>
                                                                            <input type="text" class="form-control"
                                                                                id="nim" name="nim"
                                                                                value="{{ $m->nim }}">
                                                                        </div>
                                                                        <div class="col-md-6 mt-3 mb-2">
                                                                            <label for="name">Nama :</label>
                                                                            <input type="text" class="form-control"
                                                                                id="name" name="name"
                                                                                value="{{ $m->name }}">
                                                                        </div>
                                                                        <div class="col-md-12 mt-3 mb-2">
                                                                            <label for="jurusan">Jurusan :</label>
                                                                            <select class="form-control" id="jurusan"
                                                                                name="id_jurusan">
                                                                                <option value="">Pilih Jurusan
                                                                                </option>
                                                                                @foreach ($daftar_jurusan as $jurusan)
                                                                                    <option
                                                                                        value="{{ $jurusan->id_jurusan }}"
                                                                                        {{ $selectedJurusan == $jurusan->id_jurusan ? 'selected' : '' }}>
                                                                                        {{ $jurusan->nama_jurusan }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-12 mt-3 mb-2">
                                                                            <label for="jenis_kelamin">Jenis Kelamin
                                                                                :</label>
                                                                            <select class="form-control"
                                                                                id="jenis_kelamin" name="jenis_kelamin">
                                                                                <option value="">Pilih Jenis
                                                                                    Kelamin
                                                                                </option>
                                                                                <option value="L"
                                                                                    {{ $m->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                                                    Laki-laki</option>
                                                                                <option value="P"
                                                                                    {{ $m->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                                                    Perempuan</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6 mt-3 mb-2">
                                                                            <label for="tempat_lahir">Tempat Lahir
                                                                                :</label>
                                                                            <input type="text" class="form-control"
                                                                                id="tempat_lahir" name="tempat_lahir"
                                                                                value="{{ $m->tempat_lahir }}">
                                                                        </div>
                                                                        <div class="col-md-6 mt-3 mb-2">
                                                                            <label for="tanggal_lahir">Tanggal Lahir
                                                                                :</label>
                                                                            <input type="date" class="form-control"
                                                                                id="tanggal_lahir" name="tanggal_lahir"
                                                                                value="{{ $m->tanggal_lahir }}">
                                                                        </div>
                                                                        <div class="col-md-12 mt-3 mb-2">
                                                                            <label for="alamat">Alamat :</label>
                                                                            <textarea class="form-control" id="alamat" name="alamat" rows="4">{{ $m->alamat }}</textarea>
                                                                        </div>
                                                                        <div class="col-md-4 mt-3 mb-2">
                                                                            <label for="no_hp">No Handphone
                                                                                :</label>
                                                                            <input type="number" class="form-control"
                                                                                id="no_hp" name="no_hp"
                                                                                value="{{ $m->no_hp }}">
                                                                        </div>
                                                                        <div class="col-md-4 mt-3 mb-2">
                                                                            <label for="email">Email :</label>
                                                                            <input type="email" class="form-control"
                                                                                id="email" name="email"
                                                                                value="{{ $m->email }}">
                                                                        </div>
                                                                        <div class="col-md-4 mt-3 mb-2">
                                                                            <label for="username">Username :</label>
                                                                            <input type="text" class="form-control"
                                                                                id="username" name="username"
                                                                                value="{{ $m->username }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-dismiss="modal">Tutup</button>
                                                                        <button type="submit"
                                                                            class="btn btn-success"><i
                                                                                class="fas fa-save"></i>
                                                                            Simpan</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" data-toggle="modal"
                                                    data-target="#modal-hapus-{{ $m->id_mahasiswa }}"
                                                    class="btn btn-danger btn-sm mr-1"><i
                                                        class="fas fa-trash"></i></button>
                                                <div class="modal fade" id="modal-hapus-{{ $m->id_mahasiswa }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="modal-editLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-hapusLabel">
                                                                    Konfirmasi
                                                                    Hapus Data</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus mahasiswa
                                                                <b>{{ $m->name }}</b>?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Tutup</button>
                                                                <form
                                                                    action="{{ route('hapus_mahasiswa', ['id_mahasiswa' => $m->id_mahasiswa]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('lecturer.layout.footer')
