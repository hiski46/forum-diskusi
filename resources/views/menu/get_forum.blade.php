@extends('layout')

@section('title', 'Daftar Forum')
@section('semua-forum', 'active open')
@section($type, 'active')
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

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                    <h5>{{ $judul }}</h5>
                </div>
            </div>
            <div class="table-responsive text-nowrap px-4 pb-3">
                <table class="table" id="table-pegawai">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Konten</th>
                            @if ($type != 'forum-normal')
                                <th>File</th>
                            @endif
                            <th>Tanggal</th>
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
                                @if ($type != 'forum-normal')
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
                                @endif
                                <td>{{ date('d/m/y H:i', strtotime($f->created_at)) }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($f->type != 'normal')
                                                <a class="dropdown-item no-load"
                                                    href="{{ asset('storage/file_forum/' . $f->file) }}" download><i
                                                        class="bx bx-download me-1 "></i> Download</a>
                                            @endif
                                            <a class="dropdown-item"
                                                href="/edit-forum/{{ $f->id }}?type={{ $type }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item"
                                                href="/delete-forum/{{ $f->id }}?type={{ $type }}"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
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
