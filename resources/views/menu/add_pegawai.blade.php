@extends('layout')

@section('title', 'Tambah Pegawai')
@section('pegawai', 'active')

@section('content')

    <div class="card mb-4">
        <h5 class="card-header">Tammbah Pegawai</h5>
        <!-- Account -->
        <form action="/add-pegawai" id="formAccountSettings" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{ asset('assets/img/elements/2.jpg') }}" alt="user-avatar" class="d-block rounded"
                        height="100" width="100" id="uploadedAvatar" style="object-fit: contain;" />
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo <i class='bx bx-upload'></i></span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="upload" name="foto" class="account-file-input" hidden
                                accept="image/png, image/jpeg" />
                        </label>
                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button>

                        <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <ul>
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach

                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Nama</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Masukkan Nama"
                            autofocus required value="{{ old('name') }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="text" id="email" name="email"
                            placeholder="contoh@example.com" required value="{{ old('email') }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="role" class="form-label">Role</label>
                        <select type="text" class="form-select" id="role" name="role" value="ThemeSelection">
                            @foreach ($role as $r)
                                <option value="{{ $r->id }}" {{ old('role') == $r->id ? 'selected' : '' }}>
                                    {{ ucfirst($r->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <p><b class="text-warning">**</b> Password default adalah <b>"forum_diskusi"</b>.</p>
                    </div>

                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Simpan <i class='bx bx-save'></i></button>

                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /Account -->
    </div>

@section('js')

@stop
@endsection
