@extends('layout')

@section('title', 'Forum')
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

    <div class=" position-absolute bottom-0 end-0 m-5">
        <a href="/tambah-forum" class="btn btn-success rounded-circle py-3">
            <i class="bx bx-plus-medical "></i>
        </a>
    </div>
@endsection
