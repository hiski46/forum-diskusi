@extends('layout')

@section('title', 'Pegawai')
@section('pegawai', 'active')

@section('content')
    <div class="card ">
        <div class="row pe-4">
            <div class="col-6">
                <h5 class="card-header">Daftar Pegawai</h5>
            </div>
            <div class="col-6 text-end  my-auto">
                <a href="/add-pegawai" class="btn btn-primary"><i class='bx bx-plus-circle mb-1'></i> Tambah</a>
            </div>
        </div>
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
        @if (session()->has('errors'))
            <div class="row px-4">
                <div class="col">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ session()->get('errors') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                </div>

            </div>
        @endif
        <div class="table-responsive text-nowrap px-4 pb-3">
            <table class="table" id="table-pegawai">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($users->sortByDesc('created_at') as $user)
                        <tr>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-s pull-up" title="{{ $user->name }}">
                                        <img src="{{ $user->foto ? asset('storage/foto_profil/' . $user->foto) : asset('assets/img/elements/2.jpg') }}"
                                            alt="Avatar" class="rounded-circle" style="object-fit: cover" />
                                    </li>
                                </ul>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->getRoleNames()[0]) }}</td>
                            <td>{{ date('d M Y H:i', strtotime($user->created_at)) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="/edit-pegawai/{{ $user->id }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="/delete-pegawai/{{ $user->id }}"><i
                                                class="bx bx-trash me-1"></i>
                                            Delete</a>
                                        <a class="dropdown-item" href="/reset-password/{{ $user->id }}"><i
                                                class="bx bx-reset me-1"></i>
                                            Reset Password</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@section('js')
    <script>
        $('#table-pegawai').DataTable({
            scrollY: 340
        });
    </script>
@stop
@endsection
