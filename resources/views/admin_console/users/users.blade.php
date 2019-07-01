@extends('layouts.master')

@section('title')
    Admin Console | Users
@endsection

@section('content')
    <?php //dd($menu_list) ?>

    <div class="page-title">
        <div class="title-env">
            <h1 class="title">Users</h1>
            <p class="description">Add, Update & Delete Users</p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1" >
                <li>
                    <a href="#"><i class="fa-cog"></i>Admin Console</a>
                </li>
                <li class="active">
                    <strong>Users</strong>
                </li>
            </ol>
        </div>
    </div>
    @include('error.error_msg')
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ url('/role/add_role') }}" class="btn btn-turquoise">Add User</a>
        </div>
        <div class="panel-body">
            <table id="users_datatable" class="display compact hover row-border responsive no-wrap" style="width:100%">
                <thead>
                <tr>
                    <th hidden="true">Id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td hidden="true">{{ $user->id }}</td>
                    <td>{{ $user->first_name.' '.$user->last_name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ Carbon\Carbon::parse($user->created_at)->toFormattedDateString() }}</td>
                    <td><?= $user->status==1 ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Inactive</span>' ?></td>
                    <td><a href="{{ url('users/update_user/'.$user->id) }}" class="btn btn-blue btn-sm btn-icon">Edit</a> <a href="{{ url('users/delete_user/'.$user->id) }}" onclick="return confirm_role_delete()" class="btn btn-red btn-sm btn-icon">Delete</a> <a href='{{ url("users/{$user->id}/config") }}' class="btn btn-warning btn-sm btn-icon">Config</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection


@section('scripts')
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#users_datatable').DataTable({
                responsive: true,
                "order": [[ 0, "desc" ]]
            });
        } );
        function confirm_role_delete() {
            if(confirm('Are you sure want to delete?')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection

