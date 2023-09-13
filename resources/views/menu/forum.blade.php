@extends('layout')

@section('title', 'Forum')
@section('forum', 'active')
@section('content')
    <style>
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            text-align: center;
            box-shadow: 2px 2px 3px rgb(93, 93, 93);
        }
    </style>
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


    <div class="container-md flex-grow-1 container-p-y px-md-5">
        <form action="/forum" method="get" onsubmit="showLoader()">
            <div class="row mb-3">
                <div class="col-sm-10">
                    <div class="input-group input-group-merge">
                        <span id="text2" class="input-group-text"><i class='bx bx-food-menu'></i> Knowlage</span>
                        <select id="knowlage" name="knowlage" class="form-select">
                            <option value="">Semua Knowlage</option>
                            <option value=1 {{ $selectedKnowlage == 1 ? 'selected' : '' }}>Tata Tertib</option>
                            <option value=2 {{ $selectedKnowlage == 2 ? 'selected' : '' }}>Rencana Kerja</option>
                            <option value=3 {{ $selectedKnowlage == 3 ? 'selected' : '' }}>Pengalaman</option>
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary"><i class='bx bx-search-alt'></i></button>
                </div>
            </div>
        </form>
        @forelse ($forum->sortByDesc('created_at') as $f)
            <div class="card h-100 mb-3">
                <div class="card-body">
                    <table>
                        <tbody>
                            <tr>
                                <td class="pe-2">
                                    <div class="avatar">
                                        <img src="{{ $f->user->foto ? asset('storage/foto_profil/' . $f->user->foto) : asset('assets/img/elements/2.jpg') }}"
                                            alt class="w-px-40 rounded-circle" style="object-fit: cover" />
                                    </div>
                                </td>
                                <td>
                                    <h5 class="card-title">{{ $f->judul }}</h5>
                                    <h6 class="card-subtitle text-muted"><i class='bx bx-user'></i> {{ $f->user->name }}
                                        <i class='bx bx-time'></i>
                                        {{ date('D d M Y H:i', strtotime($f->created_at)) . ' WIB' }} <i
                                            class='bx bx-food-menu'></i> {{ $knowlage[$f->knowlage] }}
                                    </h6>
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
                @if ($f->type == 'gambar')
                    <img class="img-fluid" src="{{ asset('storage/file_forum/' . $f->file) }}"
                        style="max-height: 250px; object-fit:contain;" alt="Card image cap" />
                @elseif ($f->type == 'video')
                    <video src="{{ asset('storage/file_forum/' . $f->file) }}" class="object-fit-contain"
                        style="max-height: 250px" type='video/x-matroska; codecs="theora, vorbis"' autoplay controls
                        onerror="failed(event)"></video>
                @elseif ($f->type == 'document')
                    <div class="px-5">
                        <a href="{{ asset('storage/file_forum/' . $f->file) }}" target="_blank" class="no-load">Buka File
                            <i class='bx bx-link-external '></i></a>
                    </div>
                @endif
                <div class="card-body">
                    <p class="card-text">{{ $f->teks }}</p>
                    {{-- <a href="javascript:void(0);" class="card-link">Another link</a> --}}
                </div>
                <div class="card-footer border-top">
                    <a href="/detail-forum/{{ $f->id }}" class="card-link"><i class='bx bx-comment-detail'></i>
                        Komentar </a>

                </div>
            </div>

        @empty
            <div class="row">
                <div class="col text-center">
                    <h1 class="text-muted">Tidak ada data ditemukan</h1>
                </div>
            </div>
        @endforelse

    </div>

    <a href="/tambah-forum" class="btn btn-success float rounded-circle py-3">
        <i class="bx bx-plus-medical "></i>
    </a>

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
