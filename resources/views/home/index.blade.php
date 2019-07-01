@extends('layouts.master')

@section('title')
Dashboard
@endsection

@section('content')

    <div class="page-title">

        <div class="title-env">
            <h1 class="title">Home</h1>
            <p class="description">Data visualization widgets for your stats</p>
        </div>

        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href="dashboard-1.html"><i class="fa-home"></i>Home</a>
                </li>
                <li class="active">

                    <strong>Charts</strong>
                </li>
            </ol>

        </div>

    </div>
    <?php
        $user = Auth::user();
        //echo $user->hasRole('admin') ? 'Yes' : 'No';
        //echo $user->hasPermissionTo('post.add_post') ? 'Yes' : 'No';
        //echo $user->can(App\Models\Permission::find(1)) ? 'Yes' : 'No';
    ?>
    
@endsection


@section('scripts')

@endsection
