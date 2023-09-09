@extends('layout')
@section('title', 'Home')
@section('content')
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h3 class="card-title text-primary">Welcome {{ Auth::user()->name }}! 🎉</h3>
                                <p>Semoga Hari Anda Menyenangkan</p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('/assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4 mb-3">
                <a href="/self-edit">
                    <div class="card border-0 ">
                        <img class="card-img" src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}"
                            height="100px" alt="Card image" style="object-fit: contain; opacity:0.4; " />
                        <div class="card-img-overlay">
                            <h3 class="">Akun</h3>
                        </div>
                    </div>
                </a>
            </div>
            @can('view users')
                <div class="col-md-6 col-xl-4 mb-3">
                    <a href="/pegawai">
                        <div class="card border-0 ">
                            <img class="card-img" src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}"
                                height="100px" alt="Card image" style="object-fit: contain; opacity:0.4; " />
                            <div class="card-img-overlay">
                                <h3 class="">Pegawai</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endcan
            <div class="col-md-6 col-xl-4 mb-3">
                <a href="/forum">
                    <div class="card border-0 ">
                        <img class="card-img" src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}"
                            height="100px" alt="Card image" style="object-fit: contain; opacity:0.4; " />
                        <div class="card-img-overlay">
                            <h3 class="">Forum</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-4 mb-3">
                <a href="/get-forum?type=document">
                    <div class="card border-0 ">
                        <img class="card-img" src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}"
                            height="100px" alt="Card image" style="object-fit: contain; opacity:0.4; " />
                        <div class="card-img-overlay">
                            <h3 class="">Dokumen</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-4 mb-3">
                <a href="/get-forum?type=gambar">
                    <div class="card border-0 ">
                        <img class="card-img" src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}"
                            height="100px" alt="Card image" style="object-fit: contain; opacity:0.4; " />
                        <div class="card-img-overlay">
                            <h3 class="">Gambar</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-4 mb-3">
                <a href="/get-forum?type=video">
                    <div class="card border-0 ">
                        <img class="card-img" src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}"
                            height="100px" alt="Card image" style="object-fit: contain; opacity:0.4; " />
                        <div class="card-img-overlay">
                            <h3 class="">Video</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-4 mb-3">
                <a href="/logout">
                    <div class="card border-0 ">
                        <img class="card-img" src="{{ asset('/assets/img/illustrations/girl-doing-yoga-light.png') }}"
                            height="100px" alt="Card image" style="object-fit: contain; opacity:0.4; " />
                        <div class="card-img-overlay">
                            <h3 class="">Logout</h3>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
