@extends('layouts.user-layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pb-4">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">

                    <div class="col-sm-6">
                        <h4>Profile</h4>
                    </div>


                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"> User Profile</li>
                        </ol>
                    </div>

                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <!-- Profile Image -->
        <div class="d-flex ">
            <div class="card card-primary card-outline w-25 m-auto">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{asset(auth()->user()->profileImageFile)}}" alt="User profile picture">


                    </div>

                    <h3 class="profile-username text-center">{{ auth()->user()->name }}</h3>

                    <p class="text-muted text-center">{{ auth()->user()->role }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">

                            <b>Name</b> <a class="float-right">{{ auth()->user()->name }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Email</b> <a class="float-right">{{ auth()->user()->email }}</a>
                        </li>
@role('user')
                        <li class="list-group-item">
                            <b>Subscription Starting Date</b> <a class="float-right">{{ auth()->user()->subscription_start }}</a>
                        </li>

                        <li class="list-group-item">
                            <b>Subscription Ending Date</b> <a class="float-right">{{ auth()->user()->subscription_end }}</a>
                        </li>
@endrole
                    </ul>

                                   <a href="{{ route('user.edit_my_profile') }}"
                        class="btn btn-primary btn-block"><b>Edit</b></a>


                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
