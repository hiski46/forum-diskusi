@extends('layout')

@section('title', 'Add Forum')
@section('forum', 'active')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forums/</span> Add Forums</h4>
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Add New Forum</h5>
                </div>
                <div class="card-body">
                    @if (session()->has('errors'))
                        <div class="row px-4">
                            <div class="col">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    @endif
                    <form action="/tambah-forum" method="POST" enctype="multipart/form-data" onsubmit="showLoader()">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="judul">Judul</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="judul2" class="input-group-text"><i class="bx bx-tag-alt"></i></span>
                                    <input type="text" class="form-control" id="judul" name="judul"
                                        placeholder="Judul" aria-label="Judul" aria-describedby="judul2" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="teks">Kontent</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="text2" class="input-group-text"><i
                                            class="bx bx-comment-detail"></i></span>
                                    <textarea id="teks" name="teks" class="form-control" placeholder="Masukkan konten disini"
                                        aria-label="Masukkan konten disini" aria-describedby="text2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 form-label" for="knowlage">Knowlage</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="text2" class="input-group-text"><i class='bx bx-food-menu'></i></span>
                                    <select id="knowlage" name="knowlage" class="form-select">
                                        <option value=1>Tata Tertib</option>
                                        <option value=2>Rencana Kerja</option>
                                        <option value=3>Pengalaman</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="judul">File</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="judul2" class="input-group-text"><i class="bx bx-file"></i></span>
                                    <input type="file" class="form-control" id="file" name="file"
                                        placeholder="Judul" aria-label="Judul" aria-describedby="judul2" />
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan <i class="bx bx-save"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
