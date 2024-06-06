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
                                    <th>Nama Mahasiswa</th>
                                    <th>Nilai UTS</th>
                                    <th>Nilai UAS</th>
                                    @if ($role === 'dosen')
                                        <th>Opsi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if ($rekapnilai->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">Data is empty</td>
                                    </tr>
                                @else
                                    @foreach ($rekapnilai as $key => $rn)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $rn->mahasiswa->name }}</td>
                                            <td>{{ $rn->nilai_uts }}</td>
                                            <td>{{ $rn->nilai_uas }}</td>
                                            {{-- <td>{{ $rata_nilai }}</td> --}}
                                            @if ($role === 'dosen')
                                                <td>
                                                    <button type="button" data-toggle="modal"
                                                        data-target="#modal-edit-{{ $rn->id_rekap_nilai }}"
                                                        class="btn btn-warning btn-sm mr-1"><i
                                                            class="fas fa-edit"></i></button>

                                                    <div class="modal fade" id="modal-edit-{{ $rn->id_rekap_nilai }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="modal-tambahLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <form
                                                                    action="{{ route('update.rekapnilai', ['id_rekap_nilai' => $rn->id_rekap_nilai]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modal-detailLabel">
                                                                            Edit
                                                                            {{ $title }}</h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <select name="id_mahasiswa" id="id_mahasiswa"
                                                                            class="form-control mt-3 mb-3">
                                                                            <option value="">--- Pilih Mahasiswa
                                                                                ---
                                                                            </option>
                                                                            @foreach ($mahasiswa as $key => $m)
                                                                                <option value="{{ $m->id_mahasiswa }}"
                                                                                    {{ $rn->id_mahasiswa == $m->id_mahasiswa ? 'selected' : '' }}>
                                                                                    {{ $m->nim }} -
                                                                                    {{ $m->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <input type="integer" name="nilai_uts"
                                                                                    class="form-control mt-3 mb-3"
                                                                                    placeholder="Masukan Nilai UTS"
                                                                                    value="{{ $rn->nilai_uts }}">
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <input type="integer" name="nilai_uas"
                                                                                    class="form-control mt-3 mb-3"
                                                                                    placeholder="Masukan Nilai UAS"
                                                                                    value="{{ $rn->nilai_uas }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <div class="d-flex justify-content-end">
                                                                            <button type="button"
                                                                                class="btn btn-secondary mr-2"
                                                                                data-dismiss="modal">Tutup</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary"><i
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
                                                        data-target="#modal-hapus-{{ $rn->id_rekap_nilai }}"><i
                                                            class="fas fa-trash"></i></button>

                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="modal-hapus-{{ $rn->id_rekap_nilai }}"
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
                                                                    Apakah Anda yakin ingin menghapus
                                                                    {{ $title }}
                                                                    <b>{{ $rn->mahasiswa->name }}</b>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Tutup</button>
                                                                    <form
                                                                        action="{{ route('delete.rekapnilai', ['id_rekap_nilai' => $rn->id_rekap_nilai]) }}"
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
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if ($role === 'dosen')
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-tambah-nilai"><i class="fas fa-plus"></i> Tambah Rekap
                                    Nilai</button>

                                <div class="modal fade" id="modal-tambah-nilai" tabindex="-1" role="dialog"
                                    aria-labelledby="modal-detailLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <form action="{{ route('store.rekapnilai') }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal-detailLabel"> Tambah Rekap Nilai
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <select name="id_mahasiswa" id="id_mahasiswa"
                                                        class="form-control mt-3 mb-3">
                                                        <option value="">--- Pilih Mahasiswa ---</option>
                                                        @foreach ($mahasiswa as $key => $m)
                                                            <option value="{{ $m->id_mahasiswa }}">
                                                                {{ $m->nim }} -
                                                                {{ $m->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="integer" name="nilai_uts"
                                                                class="form-control mt-3 mb-3"
                                                                placeholder="Masukan Nilai UTS">
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="integer" name="nilai_uas"
                                                                class="form-control mt-3 mb-3"
                                                                placeholder="Masukan Nilai UAS">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="d-flex justify-content-end">
                                                        <button type="button" class="btn btn-secondary mr-2"
                                                            data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary"><i
                                                                class="fas fa-save"></i> Simpan</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('lecturer.layout.footer')
