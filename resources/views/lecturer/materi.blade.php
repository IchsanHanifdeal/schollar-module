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
                                    <th>Nama {{ $title }}</th>
                                    <th>Deskripsi</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if ($materi->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">Data is empty</td>
                                    </tr>
                                @else
                                    @foreach ($materi as $key => $m)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $m->judul_materi }}</td>
                                            <td>{{ $m->deskripsi }}</td>
                                            <td>
                                                {{-- Detail Button --}}
                                                <button type="button" class="btn btn-success btn-sm mr-1"
                                                    data-toggle="modal"
                                                    data-target="#modal-detail-{{ $m->id_materi }}"><i
                                                        class="fas fa-info"></i></button>

                                                {{-- Modal Detail --}}
                                                <div class="modal fade" id="modal-detail-{{ $m->id_materi }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="modal-detailLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal-detailLabel">
                                                                    {{ $m->judul_materi }}</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @if ($m->tipe_materi === 'gambar')
                                                                    <img src="{{ asset('storage/' . $m->file_materi) }}"
                                                                        alt="{{ $m->judul_materi }}" width="100%"
                                                                        height="600px">
                                                                @elseif ($m->tipe_materi === 'dokumen')
                                                                    <embed
                                                                        src="{{ asset('storage/' . $m->file_materi) }}"
                                                                        type="application/pdf" width="100%"
                                                                        height="600px">
                                                                @elseif ($m->tipe_materi === 'video')
                                                                    <video controls width="100%" height="auto">
                                                                        <source
                                                                            src="{{ 'storage/' . asset($m->file_materi) }}"
                                                                            type="video/mp4">
                                                                        Maaf, browser Anda tidak mendukung pemutaran
                                                                        video.
                                                                    </video>
                                                                @else
                                                                    <p>Maaf, tipe file tidak didukung.</p>
                                                                @endif
                                                                <p class="mt-3">{{ $m->deskripsi }}</p>
                                                                <div class="card">
                                                                    <div class="card-header mt-2 mb-2"class="mt-3">
                                                                        <strong>Komentar</strong>
                                                                    </div>
                                                                    @foreach ($komentar as $com_key => $k)
                                                                        @if ($m->id_materi == $m->id_materi)
                                                                            @php
                                                                                $user = \App\Models\User::find(
                                                                                    $k->id_user,
                                                                                );
                                                                            @endphp
                                                                            @if ($user)
                                                                                <div
                                                                                    class="d-flex justify-content-start flex-column">
                                                                                    <div class="mt-2 ml-2 text-left">
                                                                                        <label>{{ $user->name }}</label>
                                                                                    </div>
                                                                                    <div class="ml-2 mt-2 text-left">
                                                                                        <span>{{ $k->komentar }}</span>
                                                                                    </div>
                                                                                    <div class="ml-2 mt-2 text-left">
                                                                                        <span>{{ $k->updated_at }}</span>
                                                                                    </div>
                                                                                    <div
                                                                                        class="ml-auto mr-2 mt-2 text-right">
                                                                                        <button type="button"
                                                                                            class="btn btn-danger btn-sm"
                                                                                            data-toggle="modal"
                                                                                            data-target="#modal-hapus-komentar-{{ $k->id_komentar }}"><i
                                                                                                class="fas fa-trash"></i></button>
                                                                                    </div>

                                                                                    <!-- Modal Hapus Komentar-->
                                                                                    <div class="modal fade"
                                                                                        id="modal-hapus-komentar-{{ $k->id_komentar }}"
                                                                                        tabindex="-1" role="dialog"
                                                                                        aria-labelledby="modal-hapusLabel"
                                                                                        aria-hidden="true">
                                                                                        <div class="modal-dialog"
                                                                                            role="document">
                                                                                            <div class="modal-content">
                                                                                                <div
                                                                                                    class="modal-header">
                                                                                                    <h5 class="modal-title"
                                                                                                        id="modal-hapusLabel">
                                                                                                        Konfirmasi
                                                                                                        Hapus
                                                                                                        Data</h5>
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="close"
                                                                                                        data-dismiss="modal"
                                                                                                        aria-label="Close">
                                                                                                        <span
                                                                                                            aria-hidden="true">×</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    Apakah Anda
                                                                                                    yakin
                                                                                                    ingin menghapus
                                                                                                    komentar
                                                                                                    <b>{{ $k->komentar }}</b>?
                                                                                                </div>
                                                                                                <div
                                                                                                    class="modal-footer">
                                                                                                    <button
                                                                                                        type="button"
                                                                                                        class="btn btn-secondary"
                                                                                                        data-dismiss="modal">Tutup</button>
                                                                                                    <form
                                                                                                        action="{{ route('hapus_komentar', ['id_komentar' => $k->id_komentar]) }}"
                                                                                                        method="POST">
                                                                                                        @csrf
                                                                                                        @method('DELETE')
                                                                                                        <button
                                                                                                            type="submit"
                                                                                                            class="btn btn-danger">Hapus</button>
                                                                                                    </form>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                            @endif
                                                                        @else
                                                                            <p>Komentar Tidak ada!</p>
                                                                        @endif
                                                                    @endforeach
                                                                    <form
                                                                        action="{{ route('tambah_komentar', $m->id_materi) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="card-body mt-3 mb-3">
                                                                            <div class="row">
                                                                                <input type="text" name="id_user"
                                                                                    id="id_user" class="form-control"
                                                                                    value="{{ $id_user_log }}"
                                                                                    style="display: none;">
                                                                                <input type="text" name="id_materi"
                                                                                    id="id_materi"
                                                                                    class="form-control"
                                                                                    value="{{ $m->id_materi }}"
                                                                                    style="display: none;">
                                                                                <div class="col-md-12">
                                                                                    <label for="komentar">Tulis
                                                                                        Komentar
                                                                                        :</label>
                                                                                    <textarea name="komentar" id="komentar" class="form-control"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-footer">
                                                                            <div class="d-flex justify-content-end">
                                                                                <button type="submit"
                                                                                    class="btn btn-success sm ml-3 mr-2 mb-2 mt-3"><i
                                                                                        class="fas fa-plus"></i>
                                                                                    Tambahkan Komentar</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{ asset('storage/' . $m->file_materi) }}"
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

                                                @if ($role == 'dosen')
                                                    <!-- Edit Button -->
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modal-edit-{{ $m->id_materi }}"
                                                        class="btn btn-warning btn-sm mr-1"><i
                                                            class="fas fa-edit"></i></button>

                                                    {{-- Modal Edit --}}
                                                    <div class="modal fade" id="modal-edit-{{ $m->id_materi }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="modal-tambahLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modal-detailLabel">
                                                                        Edit
                                                                        materi</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('edit_materi', $m->id_materi) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <label for="Nama">Nama
                                                                                        materi
                                                                                        :</label>
                                                                                    <input type="text"
                                                                                        name="judul_materi"
                                                                                        id="judul_materi"
                                                                                        class="form-control"
                                                                                        value={{ $m->judul_materi }}>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <label for="deskripsi">Deskripsi
                                                                                        :</label>
                                                                                    <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $m->deskripsi }}</textarea>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="tipe_materi">Jenis
                                                                                        File
                                                                                        :</label>
                                                                                    <select name="tipe_materi"
                                                                                        class="form-control"
                                                                                        id="tipe_materi">
                                                                                        <option value="gambar"
                                                                                            {{ $m->tipe_materi == 'gambar' ? 'selected' : '' }}>
                                                                                            Gambar</option>
                                                                                        <option value="dokumen"
                                                                                            {{ $m->tipe_materi == 'dokumen' ? 'selected' : '' }}>
                                                                                            Dokumen</option>
                                                                                        <option value="video"
                                                                                            {{ $m->tipe_materi == 'video' ? 'selected' : '' }}>
                                                                                            Video</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="file_materi">File
                                                                                        :</label>
                                                                                    <input type="file"
                                                                                        name="file_materi"
                                                                                        id="file"
                                                                                        class="form-control"
                                                                                        value="{{ $m->file_materi }}">
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
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Delete Button -->
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#modal-hapus-{{ $m->id_materi }}"><i
                                                            class="fas fa-trash"></i></button>

                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="modal-hapus-{{ $m->id_materi }}"
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
                                                                    Apakah Anda yakin ingin menghapus materi
                                                                    <b>{{ $m->judul_materi }}</b>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                    <form
                                                                        action="{{ route('hapus_materi', ['id_materi' => $m->id_materi]) }}"
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

{{-- Modal Tambah --}}
<div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="modal-tambahLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-detailLabel">Tambah Materi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" action="{{ route('tambah_materi') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="judul_materi">Judul Materi :</label>
                                <input type="text" name="judul_materi" id="judul_materi" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="deskripsi">Deskripsi :</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="tipe_materi">Jenis File :</label>
                                <select name="tipe_materi" class="form-control" id="tipe_materi">
                                    <option value="gambar">Gambar</option>
                                    <option value="dokumen">Dokumen</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="file_materi">File :</label>
                                <input type="file" name="file_materi" id="file" class="form-control">
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
</div>

<script>
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                var percentComplete = e.loaded / e.total * 100;
                document.getElementById('progressWrapper').style.display = 'block';
                document.getElementById('fileUploadProgress').value = percentComplete;
                document.getElementById('percentage').textContent = percentComplete.toFixed(2) + '%';
            }
        }, false);

        xhr.addEventListener('readystatechange', function(e) {
            if (xhr.readyState == 4 && xhr.status == 200) {
                toastr('Data Saved!', 'success');
                window.location.href = "{{ route('pembelajaran') }}";
            } else if (xhr.readyState == 4 && xhr.status != 200) {
                toastr('Upload failed', 'error');
            }
        });

        xhr.open('POST', '{{ route('tambah_materi') }}', true);
        xhr.send(formData);
    });
</script>
@include('lecturer.layout.footer')
