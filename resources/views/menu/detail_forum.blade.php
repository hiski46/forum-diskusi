@extends('layout')

@section('title', 'Komentar Forum')
@section('forum', 'active')

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

    <div class="container-md flex-grow-1 container-p-y px-md-5">

        <div class="card h-100 mb-3">
            <div class="card-body">
                <table>
                    <tbody>
                        <tr>
                            <td class="pe-2">
                                <div class="avatar">
                                    <img src="{{ $forum->user->foto ? asset('storage/foto_profil/' . $forum->user->foto) : asset('assets/img/elements/2.jpg') }}"
                                        alt class="w-px-40 rounded-circle" style="object-fit: cover" />
                                </div>
                            </td>
                            <td>
                                <h5 class="card-title">{{ $forum->judul }}</h5>
                                <h6 class="card-subtitle text-muted"><i class='bx bx-user'></i> {{ $forum->user->name }}
                                    <i class='bx bx-time'></i>
                                    {{ date('D d M Y H:i', strtotime($forum->created_at)) . ' WIB' }}
                                </h6>
                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>
            @if ($forum->type == 'gambar')
                <img class="img-fluid" src="{{ asset('storage/file_forum/' . $forum->file) }}"
                    style="max-height: 250px; object-fit:contain;" alt="Card image cap" />
            @elseif ($forum->type == 'video')
                <video src="{{ asset('storage/file_forum/' . $forum->file) }}" class="object-fit-contain"
                    style="max-height: 250px" type='video/x-matroska; codecs="theora, vorbis"' autoplay controls
                    onerror="failed(event)"></video>
            @elseif ($forum->type == 'document')
                <div class="px-5">
                    <a href="{{ asset('storage/file_forum/' . $forum->file) }}" target="_blank">Buka File <i
                            class='bx bx-link-external'></i></a>
                </div>
            @endif
            <div class="card-body">
                <p class="card-text">{{ $forum->teks }}</p>
                {{-- <a href="javascript:void(0);" class="card-link">Another link</a> --}}
            </div>
        </div>

        <div class="card">
            <div class="card-body border-bottom">
                <form action="/send-comment/{{ $forum->id }}" method="post" onsubmit="showLoader()">
                    @csrf
                    <div class="input-group">
                        <textarea type="text" class="form-control" id="text" name="text" placeholder="Komentar" rows="1"
                            style="height: 40px" aria-label="Komentar" aria-describedby="button-addon2" required></textarea>
                        <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i
                                class='bx bx-send'></i></button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                @forelse ($forum->komentar as $komen)
                    <div class="row border-bottom pt-2">
                        <div class="col-auto">
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-s pull-up" title="{{ $komen->user->name }}">
                                    <img src="{{ $komen->user->foto ? asset('storage/foto_profil/' . $komen->user->foto) : asset('assets/img/elements/2.jpg') }}"
                                        alt="Avatar" class="rounded-circle" style="object-fit: cover" />
                                </li>
                            </ul>
                        </div>
                        <div class="col my-auto">
                            <b>{{ $komen->user->name }}</b>
                            <p>{{ $komen->text }}</p>
                        </div>
                        <div class="col-auto">
                            <i><small>{{ date('d M Y H:i', strtotime($komen->created_at)) }}</small></i>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        <h3 class="text-muted">Belum ada komentar</h3>
                    </div>
                @endforelse
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
    @stop
@endsection
