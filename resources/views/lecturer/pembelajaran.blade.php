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
                        <div class="table-responsive">

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
                                    @if ($silabus->isEmpty())
                                        <tr>
                                            <td colspan="6" class="text-center">Data is empty</td>
                                        </tr>
                                    @else
                                        @foreach ($silabus as $key => $s)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $s->nama_silabus }}</td>
                                                <td>{{ $s->deskripsi }}</td>
                                                <td>
                                                    {{-- Detail Button --}}
                                                    <button type="button" class="btn btn-success btn-sm mr-1"
                                                        data-toggle="modal"
                                                        data-target="#modal-detail-{{ $s->id_silabus }}"><i
                                                            class="fas fa-info"></i></button>
    
                                                    {{-- Modal Detail --}}
                                                    <div class="modal fade" id="modal-detail-{{ $s->id_silabus }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="modal-detailLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modal-detailLabel">
                                                                        {{ $s->nama_silabus }}</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @if ($s->tipe_file === 'gambar')
                                                                        <img src="{{ asset('storage/' . $s->file_silabus) }}"
                                                                            alt="{{ $s->nama_silabus }}" width="100%"
                                                                            height="600px">
                                                                    @elseif ($s->tipe_file === 'dokumen')
                                                                        <embed
                                                                            src="{{ asset('storage/' . $s->file_silabus) }}"
                                                                            type="application/pdf" width="100%"
                                                                            height="600px">
                                                                    @elseif ($s->tipe_file === 'video')
                                                                        <video controls width="100%" height="auto">
                                                                            <source
                                                                                src="{{ asset('storage/' . $s->file_silabus) }}"
                                                                                type="video/mp4">
                                                                            Maaf, browser Anda tidak mendukung pemutaran
                                                                            video.
                                                                        </video>
                                                                    @else
                                                                        <p>Maaf, tipe file tidak didukung.</p>
                                                                    @endif
                                                                    <p class="mt-3">{{ $s->deskripsi }}</p>
                                                                    <div class="card">
                                                                        <div class="card-header mt-2 mb-2"class="mt-3">
                                                                            <strong>Komentar</strong>
                                                                        </div>
                                                                        @foreach ($komentar as $com_key => $k)
                                                                            @if ($k->id_silabus == $s->id_silabus)
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
                                                                                                            Konfirmasi Hapus
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
                                                                                                        Apakah Anda yakin
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
                                                                        <form action="{{ route('tambah_komentar_pembelajarn', ['id_silabus' => $s->id_silabus]) }}" method="POST">
                                                                            @csrf
                                                                            <div class="card-body mt-3 mb-3">
                                                                                <div class="row">
                                                                                    <input type="hidden" name="id_user" id="id_user" class="form-control" value="{{ $id_user }}">
                                                                                    <input type="hidden" name="id_silabus" id="id_silabus" class="form-control" value="{{ $s->id_silabus }}">
                                                                                    <div class="col-md-12">
                                                                                        <label for="komentar">Tulis Komentar:</label>
                                                                                        <textarea name="komentar" id="komentar" class="form-control" required></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <div class="d-flex justify-content-end">
                                                                                    <button type="submit" class="btn btn-success sm ml-3 mr-2 mb-2 mt-3">
                                                                                        <i class="fas fa-plus"></i> Tambahkan Komentar
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="{{ asset('storage/' . $s->file_silabus) }}"
                                                                            class="btn btn-primary" download><i
                                                                                class="fas fa-arrow-down"></i> Download</a>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                    <!-- Edit Button -->
                                                    @if ($role === 'dosen')
                                                        <button type="button" data-toggle="modal"
                                                            data-target="#modal-edit-{{ $s->id_silabus }}"
                                                            class="btn btn-warning btn-sm mr-1"><i
                                                                class="fas fa-edit"></i></button>
                                                    @endif
    
                                                    {{-- Modal Edit --}}
                                                    <div class="modal fade" id="modal-edit-{{ $s->id_silabus }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="modal-tambahLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modal-detailLabel">Edit
                                                                        Silabus</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('update_silabus', $s->id_silabus) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <label for="Nama">Nama Silabus
                                                                                        :</label>
                                                                                    <input type="text"
                                                                                        name="nama_silabus"
                                                                                        id="nama_silabus"
                                                                                        class="form-control"
                                                                                        value={{ $s->nama_silabus }}>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <label for="deskripsi">Deskripsi
                                                                                        :</label>
                                                                                    <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $s->deskripsi }}</textarea>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="tipe_file">Jenis File
                                                                                        :</label>
                                                                                    <select name="tipe_file"
                                                                                        class="form-control"
                                                                                        id="tipe_file">
                                                                                        <option value="gambar"
                                                                                            {{ $s->tipe_file == 'gambar' ? 'selected' : '' }}>
                                                                                            Gambar</option>
                                                                                        <option value="dokumen"
                                                                                            {{ $s->tipe_file == 'dokumen' ? 'selected' : '' }}>
                                                                                            Dokumen</option>
                                                                                        <option value="video"
                                                                                            {{ $s->tipe_file == 'video' ? 'selected' : '' }}>
                                                                                            Video</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label for="file_silabus">File
                                                                                        :</label>
                                                                                    <input type="file"
                                                                                        name="file_silabus" id="file"
                                                                                        class="form-control"
                                                                                        value="{{ $s->file_silabus }}">
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
                                                    </div>
    
                                                    <!-- Delete Button -->
                                                    @if ($role === 'dosen')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#modal-hapus-{{ $s->id_silabus }}"><i
                                                                class="fas fa-trash"></i></button>
                                                    @endif
                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="modal-hapus-{{ $s->id_silabus }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="modal-hapusLabel"
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
                                                                    Apakah Anda yakin ingin menghapus silabus
                                                                    <b>{{ $s->nama_silabus }}</b>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                    <form
                                                                        action="{{ route('hapus_silabus', ['id_silabus' => $s->id_silabus]) }}"
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
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        @if ($role === 'dosen')
                            <div class="d-flex justify-content-end">
                                <button type="button" data-toggle="modal" data-target="#modal-tambah"
                                    class="btn btn-primary mt-2 ml-2 mr-2" href="#"><i
                                        class="fas fa-plus"></i></button>
                        @endif
                    </div>
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
                <h5 class="modal-title" id="modal-detailLabel">Tambah Silabus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('store_silabus') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="Nama">Nama Silabus :</label>
                                <input type="text" name="nama_silabus" id="nama_silabus" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="deskripsi">Deskripsi :</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="tipe_file">Jenis File :</label>
                                <select name="tipe_file" class="form-control" id="tipe_file">
                                    <option value="gambar">Gambar</option>
                                    <option value="dokumen">Dokumen</option>
                                    <option value="video">Video</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="file_silabus">File :</label>
                                <input type="file" name="file_silabus" id="file" class="form-control">
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
</div>
