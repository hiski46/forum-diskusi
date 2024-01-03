@extends('layout')

@section('title', 'Forum')
@section('approve', 'active')

@section('content')
    @if (session()->has('success'))
        <div class="row px-4">
            <div class="col">
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    @php
        $knowlage = [1 => 'Tata Tertib', 2 => 'Rencana Kerja', 3 => 'Pengalaman'];
    @endphp

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                    <h5>Need Approve Forum</h5>
                </div>
            </div>
            <div class="table-responsive  px-4 pb-3">
                <table class="table" id="table-pegawai">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Konten</th>
                            <th>Knowlage</th>
                            <th>File</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($forum as $f)
                            <tr>
                                <td>
                                    {{ $f->judul }}
                                </td>
                                <td>{{ $f->teks ?? '-' }}</td>
                                <td>{{ $knowlage[$f->knowlage] }}</td>
                                <td class="">
                                    @if ($f->type == 'gambar')
                                        <img class="img-fluid" src="{{ asset('storage/file_forum/' . $f->file) }}"
                                            style="width: 100px;: 250px; object-fit:contain;" alt="Card image cap" />
                                    @elseif ($f->type == 'video')
                                        <video src="{{ asset('storage/file_forum/' . $f->file) }}"
                                            class="object-fit-contain" style="width: 100px;: 250px"
                                            type='video/x-matroska; codecs="theora, vorbis"' autoplay controls
                                            onerror="failed(event)"></video>
                                    @elseif ($f->type == 'document')
                                        <div class="">
                                            <a href="{{ asset('storage/file_forum/' . $f->file) }}" target="_blank"
                                                class="no-load">Buka File <i class='bx bx-link-external '></i></a>
                                        </div>
                                    @elseif ($f->type == 'normal')
                                        -
                                    @endif
                                </td>

                                <td>{{ date('d/m/y H:i', strtotime($f->created_at)) }}</td>
                                <td>
                                    @if ($f->approve_at)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif ($f->reject_at)
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge rounded-pill bg-secondary">Processing</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group"
                                        aria-label="Basic mixed styles example">
                                        <a href="/approve/{{ $f->id }}" type="button"
                                            class="btn btn-success">Approve</a>
                                        <a href="/reject/{{ $f->id }}" type="button"
                                            class="btn btn-danger">Reject</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@section('js')
    <script>
        function failed(e) {
            // video playback failed - show a message saying why
            switch (e.target.error.code) {
                case e.target.error.MEDIA_ERR_ABORTED:
                    console.log('You aborted the video playback.');
                    break;
                case e.target.error.MEDIA_ERR_NETWORK:
                    console.log('A network error caused the video download to fail part-way.');
                    break;
                case e.target.error.MEDIA_ERR_DECODE:
                    console.log(
                        'The video playback was aborted due to a corruption problem or because the video used features your browser did not support.'
                    );
                    break;
                case e.target.error.MEDIA_ERR_SRC_NOT_SUPPORTED:
                    console.log(
                        'The video could not be loaded, either because the server or network failed or because the format is not supported.'
                    );
                    break;
                default:
                    console.log('An unknown error occurred.');
                    break;
            }
        }
    </script>
    <script>
        $('#table-pegawai').DataTable({
            scrollY: 340
        });
    </script>
@stop
@endsection
