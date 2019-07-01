@extends('layouts.master')

@section('title')
    Admin Console | Permissions
@endsection

@section('content')
    <?php //dd($menu_list) ?>

    <div class="page-title">
        <div class="title-env">
            <h1 class="title">Permissions</h1>
            <p class="description">Add, Update & Delete role permissions</p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1" >
                <li>
                    <a href="#"><i class="fa-cog"></i>Admin Console</a>
                </li>
                <li class="active">
                    <strong>Permission</strong>
                </li>
            </ol>
        </div>
    </div>
    @include('error.error_msg')
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{ url('/permission/create') }}" class="btn btn-turquoise">Add Permission</a>
        </div>
        <div class="panel-body">
            <table id="perm_datatable" class="display compact hover row-border responsive no-wrap" style="width:100%">
                <thead>
                <tr>
                    <th hidden="true">Id</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $perm)
                <tr>
                    <td hidden="true">{{ $perm->id }}</td>
                    <td>{{ $perm->slug }}</td>
                    <td>{{ $perm->description }}</td>
                    <td><a href='{{ url("permission/$perm->id/edit") }}' class="btn btn-blue btn-sm btn-icon">Edit</a> <a href="javascript:;" class="btn btn-red btn-sm btn-icon" onclick="$(this).find('#del_form').submit();">Delete <form id="del_form" action="{{ url('permission/'.$perm->id) }}" method="POST" onsubmit="return confirm_perm_delete()">@method('DELETE')
                        @csrf</form></a> </td>
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
            $('#perm_datatable').DataTable({
                responsive: true,
                "order": [[ 0, "desc" ]]
            });
        } );
        function confirm_perm_delete() {
            if(confirm('Are you sure want to delete?')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection

