@extends('layouts.master')

@section('title')
    Admin Console | Role
@endsection

@section('content')
    <?php //dd($menu_list) ?>

    <div class="page-title">
        <div class="title-env">
            <h1 class="title">Role</h1>
            <p class="description">Add, Update & Delete User role</p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1" >
                <li>
                    <a href="#"><i class="fa-cog"></i>Admin Console</a>
                </li>
                <li class="active">
                    <strong>Role</strong>
                </li>
            </ol>
        </div>
    </div>
    @include('error.error_msg')
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ url('/role/add_role') }}" class="btn btn-turquoise">Add Role</a>
        </div>
        <div class="panel-body">
            <table id="role_datatable" class="display compact hover row-border responsive no-wrap" style="width:100%">
                <thead>
                <tr>
                    <th hidden="true">Id</th>
                    <th>Role Title</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                <tr>
                    <td hidden="true">{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td><a href="{{ url('role/update_role/'.$role->id) }}" class="btn btn-blue btn-sm btn-icon">Edit</a> <a href="{{ url('role/delete_role/'.$role->id) }}" onclick="return confirm_role_delete()" class="btn btn-red btn-sm btn-icon">Delete</a> <a href='{{ url("role/{$role->id}/config") }}' class="btn btn-warning btn-sm btn-icon">Config</a></td>
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
            $('#role_datatable').DataTable({
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

