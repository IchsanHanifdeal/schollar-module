@include('lecturer.layout.header')

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 col-6">
                <div class="card mb-3 mt-3">
                    <div class="card-title">
                        <h4 class="mt-3 mb-3 ml-3"><i class="fas fa-table"></i> List {{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 10%">No</th>
                                    <th>Nama Tugas</th>
                                    <th>Deskripsi</th>
                                    <th>Mata Kuliah</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if ($tugas->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">Data is empty</td>
                                    </tr>
                                @else
                                    @foreach ($tugas as $key => $t)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $t->judul_tugas }}</td>
                                            <td>{{ $t->deskripsi }}</td>
                                            <td>{{ $t->matakuliah->mata_kuliah }}</td>
                                            <td>
                                                {{-- Detail Button --}}
                                                <button type="button" class="btn btn-success btn-sm mr-1"
                                                    data-toggle="modal"
                                                    data-target="#modal-detail-{{ $t->id_tugas }}"><i
                                                        class="fas fa-info"></i></button>

                                                {{-- Modal Detail --}}
                                                <div class="modal fade" id="modal-detail-{{ $t->id_tugas }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="modal-detailLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-detailLabel">
                                                                    {{ $t->judul_tugas }}</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($t->lampiran_tugas)
                                                                    <embed
                                                                        src="{{ asset('storage/lampiran_tugas/' . $t->lampiran_tugas) }}"
                                                                        type="application/pdf" width="100%"
                                                                        height="600px">
                                                                @else
                                                                    <p>Tidak ada lampiran</p>
                                                                @endif
                                                                <p class="mt-3">{{ $t->deskripsi }}</p>
                                                                <div class="card">
                                                                    <div class="modal-footer">
                                                                        <a href="{{ asset('storage/lampiran_tugas/' . $t->lampiran_tugas) }}"
                                                                            class="btn btn-primary" download><i
                                                                                class="fas fa-arrow-down"></i>
                                                                            Download</a>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Penilaian Button --}}
                                                <button type="button" class="btn btn-primary btn-sm mr-1"
                                                    data-toggle="modal"
                                                    data-target="#modal-penilaian-{{ $t->id_tugas }}">
                                                    <i class="fas fa-graduation-cap"></i>
                                                </button>

                                                {{-- Modal Penilaian --}}
                                                <div class="modal fade" id="modal-penilaian-{{ $t->id_tugas }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="modal-editLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-detailLabel">Penilaian
                                                                    Tugas</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body mt-2 mb-2">
                                                                <table class="table table-hover">
                                                                    <thead class="text-center">
                                                                        <h5 class="mt-2 mb-3"
                                                                            style="margin-bottom:10px;">Pengumpulan
                                                                            tugas {{ $t->judul_tugas }}</h5>
                                                                        <tr>
                                                                            <th>No</th>
                                                                            <th>Nama Mahasiswa</th>
                                                                            <th>File</th>
                                                                            <th>Keterangan</th>
                                                                            <th>Nilai</th>
                                                                            @if ($role === 'dosen')
                                                                                <th>Opsi</th>
                                                                            @endif
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                            $index = 1;
                                                                        @endphp
                                                                        @foreach ($nilai[$t->id_tugas] ?? [] as $n)
                                                                            <tr>
                                                                                <td>{{ $index }}</td>
                                                                                <td>{{ $n->mahasiswa->name }}</td>
                                                                                <td>
                                                                                    @if ($n->file)
                                                                                        <button class="btn btn-primary" data-toggle="modal" data-target="#lihat-tugas-{{ $n->id_nilai }}">Lihat Tugas</button>

                                                                                        <div class="modal fade" id="lihat-tugas-{{ $n->id_nilai }}" tabindex="-1" role="dialog" aria-labelledby="modal-detailLabel" aria-hidden="true">
                                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="modal-detailLabel"> {{ $n->mahasiswa->name }}</h5>
                                                                                                        <button type="button" class="close"
                                                                                                            data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">×</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        @if ($n->file)
                                                                                                            @php
                                                                                                                $fileExtension = pathinfo($n->file, PATHINFO_EXTENSION);
                                                                                                            @endphp
                                                                                                            @if (in_array($fileExtension, ['pdf']))
                                                                                                                <embed src="{{ asset('storage/lampiran_tugas/mahasiswa/' . $n->file) }}" type="application/pdf" width="100%" height="600px">
                                                                                                            @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                                                                                                <img src="{{ asset('storage/lampiran_tugas/mahasiswa/' . $n->file) }}" alt="Lampiran Tugas" style="width: 100%; height: auto;">
                                                                                                            @else
                                                                                                                <p>Tidak dapat menampilkan lampiran. Unduh lampiran <a href="{{ asset('storage/lampiran_tugas/mahasiswa/' . $n->file) }}">di sini</a>.</p>
                                                                                                            @endif
                                                                                                        @else
                                                                                                            <p>Tidak ada lampiran</p>
                                                                                                        @endif
                                                                                                    </div>                                                                                                    
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @else
                                                                                        <span
                                                                                            class="badge bg-danger">Tugas belum dikumpulkan</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ $n->keterangan }}</td>
                                                                                <td>{{ $n->nilai }}</td>
                                                                                @if ($role === 'dosen')
                                                                                    <td>
                                                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#nilai-{{ $n->id_nilai }}"><i class="fas fa-edit"></i></button>

                                                                                        <div class="modal fade" id="nilai-{{ $n->id_nilai }}" tabindex="-1" role="dialog" aria-labelledby="modal-detailLabel" aria-hidden="true">
                                                                                            <div class="modal-dialog modal-lg" role="document">
                                                                                                <div class="modal-content">
                                                                                                    <div class="modal-header">
                                                                                                        <h5 class="modal-title" id="modal-detailLabel">Nilai Tugas {{ $n->mahasiswa->name }}</h5>
                                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                            <span aria-hidden="true">×</span>
                                                                                                        </button>
                                                                                                    </div>
                                                                                                    <div class="modal-body">
                                                                                                        <form action="{{ route('update_nilai_tugas', ['id_nilai' => $n->id_nilai]) }}" method="POST">
                                                                                                            @csrf
                                                                                                            @method('PUT')
                                                                                                            <div class="form-group">
                                                                                                                <label for="nilai">Nilai</label>
                                                                                                                <input type="number" name="nilai" id="nilai" placeholder="Masukkan Nilai Tugas Mahasiswa" class="form-control" required>
                                                                                                            </div>
                                                                                                            <div class="d-flex justify-content-end mt-3">
                                                                                                                <button type="button" class="btn btn-secondary btn-sm mr-2" data-dismiss="modal">Tutup</button>
                                                                                                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
                                                                                                            </div>
                                                                                                        </form>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>                                                                                        
                                                                                    </td>
                                                                                @endif
                                                                            </tr>
                                                                            @php
                                                                                $index++;
                                                                            @endphp
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>

                                                                {{-- Input Tugas --}}
                                                                @if ($role === 'mahasiswa')
                                                                    <div class="d-flex justify-content-end">
                                                                        <button class="btn btn-primary"
                                                                            data-toggle="modal"
                                                                            data-target="#modal-input-{{ $t->id_tugas }}">Input
                                                                            Tugas</button>
                                                                    </div>
                                                                    <div class="modal fade"
                                                                        id="modal-input-{{ $t->id_tugas }}"
                                                                        tabindex="-1" role="dialog"
                                                                        aria-labelledby="modal-editLabel"
                                                                        aria-hidden="true">
                                                                        <form
                                                                            action="{{ route('store.tugas.mahasiswa', ['id_tugas' => $t->id_tugas]) }}"
                                                                            method="POST"
                                                                            enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-dialog modal-lg"
                                                                                role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title"
                                                                                            id="modal-detailLabel">
                                                                                            Input Tugas
                                                                                            {{ $t->judul_tugas }}</h5>
                                                                                        <button type="button"
                                                                                            class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">×</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="col-md-12">
                                                                                            <label
                                                                                                for="judul_tugas">Nama
                                                                                                Mahasiswa :</label>
                                                                                            <input type="text"
                                                                                                name="judul_tugas"
                                                                                                id="judul_tugas"
                                                                                                class="form-control"
                                                                                                value="{{ $name }}"
                                                                                                readonly>
                                                                                            <input type="hidden"
                                                                                                name="id_mahasiswa"
                                                                                                id="judul_tugas"
                                                                                                class="form-control"
                                                                                                value="{{ $id_mahasiswa->id_mahasiswa }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <label
                                                                                                for="judul_tugas">Nama
                                                                                                Tugas :</label>
                                                                                            <input type="text"
                                                                                                name="judul_tugas"
                                                                                                id="judul_tugas"
                                                                                                class="form-control"
                                                                                                value="{{ $t->judul_tugas }}"
                                                                                                readonly>
                                                                                            <input type="hidden"
                                                                                                name="id_tugas"
                                                                                                id="judul_tugas"
                                                                                                class="form-control"
                                                                                                value="{{ $t->id_tugas }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <label
                                                                                                for="judul_tugas">Mata
                                                                                                Kuliah :</label>
                                                                                            <input type="text"
                                                                                                name="judul_tugas"
                                                                                                id="judul_tugas"
                                                                                                class="form-control"
                                                                                                value="{{ $t->matakuliah->mata_kuliah }}"
                                                                                                readonly>
                                                                                            <input type="hidden"
                                                                                                name="id_matakuliah"
                                                                                                id="judul_tugas"
                                                                                                class="form-control"
                                                                                                value="{{ $t->matakuliah->id_matakuliah }}"
                                                                                                readonly>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <label
                                                                                                for="lampiran_tugas">Lampiran
                                                                                                Tugas :</label>
                                                                                            <input type="file"
                                                                                                name="lampiran_tugas"
                                                                                                id="file"
                                                                                                class="form-control">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="d-flex justify-content-end mt-3">
                                                                                        <button type="button"
                                                                                            class="btn btn-secondary btn-sm mr-2 ml-2"
                                                                                            data-dismiss="modal">Tutup</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn-success btn-sm"><i
                                                                                                class="fas fa-save"></i>
                                                                                            Simpan</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                                {{-- Masukkan Tugas --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                @if ($role === 'dosen')
                                                    <!-- Edit Button -->
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modal-edit-{{ $t->id_tugas }}"
                                                        class="btn btn-warning btn-sm mr-1"><i
                                                            class="fas fa-edit"></i></button>

                                                    <div class="modal fade" id="modal-edit-{{ $t->id_tugas }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="modal-editLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modal-detailLabel">
                                                                        Edit
                                                                        Tugas </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{ route('edit_tugas', $t->id_tugas) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label for="judul_tugas">Nama Tugas
                                                                                    :</label>
                                                                                <input type="text"
                                                                                    placeholder="Masukan Nama Tugas Disini"
                                                                                    name="judul_tugas"
                                                                                    id="judul_tugas"
                                                                                    class="form-control"
                                                                                    value="{{ $t->judul_tugas }}">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="mata_kuliah">Mata Kuliah
                                                                                    :</label>
                                                                                <select name="id_matakuliah"
                                                                                    class="form-control"
                                                                                    id="mata_kuliah">
                                                                                    <option value="">--- Mata
                                                                                        Kuliah ---</option>
                                                                                    @foreach ($matakuliah as $mk)
                                                                                        <option
                                                                                            value="{{ $mk->id_matakuliah }}"
                                                                                            {{ $mk->id_matakuliah == $t->id_matakuliah ? 'selected' : '' }}>
                                                                                            {{ $mk->mata_kuliah }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label for="deskripsi">Deskripsi
                                                                                    :</label>
                                                                                <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $t->deskripsi }}</textarea>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <label for="lampiran_tugas">Lampiran
                                                                                    Tugas
                                                                                    :</label>
                                                                                <input type="file"
                                                                                    name="lampiran_tugas"
                                                                                    id="file"
                                                                                    class="form-control">
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex justify-content-end mt-3">
                                                                            <button type="button"
                                                                                class="btn btn-secondary btn-sm mr-2 ml-2"
                                                                                data-dismiss="modal">Tutup</button>
                                                                            <button type="submit"
                                                                                class="btn btn-success btn-sm"><i
                                                                                    class="fas fa-save"></i>
                                                                                Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Button -->
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#modal-hapus-{{ $t->id_tugas }}"><i
                                                            class="fas fa-trash"></i></button>

                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="modal-hapus-{{ $t->id_tugas }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="modal-hapusLabel" aria-hidden="true">
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
                                                                    Apakah Anda yakin ingin menghapus tugas
                                                                    <b>{{ $t->judul_tugas }}</b>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                    <form
                                                                        action="{{ route('hapus_tugas', ['id_tugas' => $t->id_tugas]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if ($role == 'dosen')
                            <div class="d-flex justify-content-end">
                                <button type="button" data-toggle="modal" data-target="#modal-tambah"
                                    class="btn btn-primary mt-2 ml-2 mr-2" href="#"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('lecturer.layout.footer')

<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-detailLabel">Tambah Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('tambah_tugas') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="judul_tugas">Nama Tugas :</label>
                            <input type="text" placeholder="Masukan Nama Tugas Disini" name="judul_tugas"
                                id="judul_tugas" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="mata_kuliah">Mata Kuliah :</label>
                            <select name="id_matakuliah" class="form-control" id="mata_kuliah">
                                <option value="">--- Mata Kuliah ---</option>
                                @foreach ($matakuliah as $mk)
                                    <option value="{{ $mk->id_matakuliah }}">{{ $mk->mata_kuliah }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="deskripsi">Deskripsi :</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="lampiran_tugas">Lampiran Tugas :</label>
                            <input type="file" name="lampiran_tugas" id="file" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-secondary btn-sm mr-2 ml-2"
                            data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i>
                            Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
