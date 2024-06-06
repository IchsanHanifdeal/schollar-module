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
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Lokasi</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    @if ($role == 'dosen')
                                        <th>Opsi</th>
                                    @endif
                                </tr>
                            <tbody class="text-center">
                                @if ($absensi->isEmpty())
                                    <tr>
                                        <td colspan="8" class="text-center">Data is empty</td>
                                    </tr>
                                @else
                                    @foreach ($absensi as $key => $a)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $a->user->name }}</td>
                                            <td>{{ $a->tanggal }}</td>
                                            <td>{{ $a->waktu }}</td>
                                            <td>{{ $a->lokasi }}</td>
                                            <td><img src="{{ asset('storage/absensi/' . $a->foto) }}"
                                                    style="max-width:48px; max-height:48px;"
                                                    data-src="{{ asset('storage/absensi/' . $a->foto) }}" alt="foto"
                                                    data-toggle="modal" data-target="#modalGambar"></td>
                                            <td>
                                                @php
                                                    $status = ucfirst($a->status);
                                                    $labelClass = '';

                                                    switch ($status) {
                                                        case 'Hadir':
                                                            $labelClass = 'success';
                                                            break;
                                                        case 'Izin':
                                                            $labelClass = 'primary';
                                                            break;
                                                        case 'Alpa':
                                                        case 'Sakit':
                                                            $labelClass = 'danger';
                                                            break;
                                                        default:
                                                            $labelClass = 'secondary';
                                                            break;
                                                    }
                                                @endphp

                                                <span class="badge badge-{{ $labelClass }}">{{ $status }}</span>
                                            </td>
                                            <td>
                                                @if ($a->keterangan)
                                                    {{ $a->keterangan }}
                                                @else
                                                    <span class="badge badge-secondary">Tidak ada keterangan</span>
                                                @endif
                                            </td>
                                            @if ($role == 'dosen')
                                                <td>
                                                    @if ($a->status === 'hadir')
                                                        <i class="fas fa-check-circle text-success"></i>
                                                    @elseif ($a->status === 'alpa')
                                                        <i class="fas fa-times-circle text-danger"></i>
                                                    @elseif ($a->status === 'izin (ditolak)')
                                                        <i class="fas fa-times-circle text-danger"></i>
                                                    @elseif ($a->status === 'izin (diterima)')
                                                        <i class="fas fa-check-circle text-success"></i>
                                                    @elseif ($a->status === 'sakit')
                                                        <i class="fas fa-check-circle text-success"></i>
                                                    @else
                                                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                                            data-target="#Modalterima-{{ $a->id_absensi }}">Terima</button>

                                                        {{-- Modal Terima --}}
                                                        <div class="modal fade" id="Modalterima-{{ $a->id_absensi }}"
                                                            tabindex="-1" aria-labelledby="ModalTambah"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Terima izin dari
                                                                            {{ $a->user->name }}
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah Anda yakin ingin menerima absensi dari
                                                                        dari
                                                                        <b> {{ $a->user->name }}</b>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Tutup</button>
                                                                        <form
                                                                            action="{{ route('terima_absensi', ['id_absensi' => $a->id_absensi]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('put')
                                                                            <button type="submit"
                                                                                class="btn btn-success">Ya</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        |
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                            data-target="#Modaltolak-{{ $a->id_absensi }}">Tolak</button>

                                                        <div class="modal fade" id="Modaltolak-{{ $a->id_absensi }}"
                                                            tabindex="-1" aria-labelledby="ModalTambah"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Tolak izin dari
                                                                            {{ $a->user->name }}
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">×</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah Anda yakin ingin menolak absensi dari
                                                                        <b>{{ $a->user->name }}</b>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Tutup</button>
                                                                        <form
                                                                            action="{{ route('tolak_absensi', ['id_absensi' => $a->id_absensi]) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('put')
                                                                            <button type="submit"
                                                                                class="btn btn-success">Ya</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if ($role === 'mahasiswa')
                            <div class="d-flex justify-content-end mt-2 mb-2 ml-2 mr-2">
                                <a class="btn btn-primary btn-sm" href="{{ route('tambah_absensi') }}"><i
                                        class="fas fa-plus"></i> Tambah Absensi</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalGambar" tabindex="-1" role="dialog" aria-labelledby="modalGambarLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalGambarLabel">Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalGambarImg" src="" class="img-fluid" alt="gambar">
            </div>
        </div>
    </div>
</div>

@include('lecturer.layout.footer')

<script>
    $(document).ready(function() {
        $('#modalGambar').on('show.bs.modal', function(event) {
            var imgSrc = $(event.relatedTarget).data('src');
            $('#modalGambarImg').attr('src', imgSrc);
        });
    });
</script>
