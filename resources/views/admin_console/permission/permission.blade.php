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
            <a href="javascript:;" onclick="jQuery('#add_permission').modal('show', {backdrop: 'fade'});" class="btn btn-turquoise">Add Permission</a>
        </div>
        <div class="panel-body">
            <table id="perm_datatable" class="display compact hover row-border responsive no-wrap" style="width:100%">
                <thead>
                <tr>
                    <th hidden="true">Id</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $perm)
                <tr>
                    <td hidden="true">{{ $perm->id }}</td>
                    <td>{{ $perm->name }}</td>
                    <td>{{ $perm->slug }}</td>
                    <td>{{ $perm->description }}</td>
                    <td><a href="javascript:;" onclick="jQuery('#update_permission_{{ $perm->id }}').modal('show', {backdrop: 'fade'});" class="btn btn-blue btn-sm btn-icon">Edit</a> <a href="javascript:;" class="btn btn-red btn-sm btn-icon" onclick="$(this).find('#del_form').submit();">Delete <form id="del_form" action="{{ url('permission/'.$perm->id) }}" method="POST" onsubmit="return confirm_perm_delete()">@method('DELETE')
                        @csrf</form></a> </td>
                </tr>

                <div class="modal fade" id="update_permission_{{ $perm->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ url('permission/'.$perm->id) }}" method="POST" class="validate" role="form">
                                @method('PUT')
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Update Permission</h4>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="title">Permission Name <span style="color: red;">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $perm->name }}" data-validate="required" placeholder="Ex: add new blog">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="2" data-validate="maxlength[150]" placeholder="Max 150 Character">{{ $perm->description }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>                    
                            </form>
                            
                        </div>
                    </div>
                </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="add_permission">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ url('permission') }}" method="POST" class="validate" role="form" id="form1">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">New Permission</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Permission Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" data-validate="required" placeholder="Ex: add new blog">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="2" data-validate="maxlength[150]" placeholder="Max 150 Character">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Save</button>
                    </div>                    
                </form>
                
            </div>
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

