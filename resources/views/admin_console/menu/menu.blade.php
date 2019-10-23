@extends('layouts.master')

@section('title')
    Admin Console | Menu
@endsection

@section('content')

    <div class="page-title">
        <div class="title-env">
            <h1 class="title">Menu</h1>
            <p class="description">Add, Update & Delete System Menu</p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1" >                <li>
                    <a href="#"><i class="fa-cog"></i>Admin Console</a>
                </li>
                <li class="active">
                    <strong>Menu</strong>
                </li>
            </ol>
        </div>
    </div>
    @include('error.error_msg')
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="javascript:;" onclick="jQuery('#add_menu').modal('show', {backdrop: 'fade'});" class="btn btn-turquoise">Add Menu</a>
        </div>
        <div class="panel-body">
            <table id="menu_datatable" class="display compact hover row-border responsive no-wrap" style="width:100%">
                <thead>
                <tr>
                    <th hidden="true">Id</th>
                    <th>Title</th>
                    <th>Url</th>
                    <th>Parent Menu</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($menu_list as $menu)
                <tr>
                    <td hidden="true">{{ $menu->id }}</td>
                    <td style="{{ !$menu->parent_menu ? 'border-left:4px solid #e67e22' : '' }};">{{ $menu->title }}</td>
                    <td>{{ $menu->menu_url ? $menu->menu_url : 'N/A' }}</td>
                    <td>{{ $menu->parent_menu ? $menu->parent_menu_title : 'N/A' }}</td>
                    <td>
                    <a href="javascript:;" onclick="jQuery('#update_menu_{{ $menu->id }}').modal('show', {backdrop: 'fade'});" class="btn btn-blue btn-sm btn-icon">Edit</a> 
                    <a href="javascript:;" class="btn btn-red btn-sm btn-icon" onclick="$(this).find('#del_form').submit();">Delete <form id="del_form" action="{{ url('menu/'.$menu->id) }}" method="POST" onsubmit="return confirm_menu_delete()">@method('DELETE')
                        @csrf</form></a>
                    @if($menu->is_active)
                    <a href="{{ url('admin-console/menu/menu_status_update/'.$menu->id.'/0') }}" title="Deactive" class="btn btn-success btn-sm btn-icon">Active</a>
                    @else
                    <a href="{{ url('admin-console/menu/menu_status_update/'.$menu->id.'/1') }}" title="Activate" class="btn btn-warning btn-sm btn-icon">Inactive</a>
                    @endif
                    </td>
                </tr>

                <div class="modal fade" id="update_menu_{{ $menu->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('menu.update', ['id'=>$menu->id]) }}" method="POST" class="validate" role="form">
                                @method('PUT')
                                @csrf
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Add Menu</h4>
                                </div>
                                
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="title">Menu Title <span style="color: red;">*</span></label>
                                        <input type="text" name="title" id="title" class="form-control" value="{{ $menu->title }}" data-validate="required" placeholder="Ex: Blog Post">
                                    </div>
                                    <div class="form-group">
                                        <label for="menu_url">Menu URL</label>
                                        <input type="text" name="menu_url" id="menu_url" value="{{ $menu->menu_url }}" class="form-control" placeholder="Ex: post/create_post">
                                    </div>
                                    <div class="form-group">
                                        <label for="parent_menu">Parent Menu</label>
                                        <select name="parent_menu" id="parent_menu" class="form-control">
                                            <option value="">Select Parent Menu</option>
                                            @foreach($menu_list as $p_menu)
                                                <option value="{{ $p_menu->id }}" {{ $p_menu->id == $menu->parent_menu ? 'selected' : '' }}>{{ $p_menu->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="menu_order">Menu Order <span style="color: red;">*</span></label>
                                        <input type="number" name="menu_order" id="menu_order" value="{{ $menu->menu_order }}" class="form-control" data-validate="number,minlength[1]" placeholder="Ex: 1" data-validate="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="menu_icon">Menu Icon</label>
                                        <input type="text" name="menu_icon" id="menu_icon" value="{{ $menu->menu_icon }}" class="form-control" placeholder="Ex: fa-book">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="2" data-validate="maxlength[150]" placeholder="Max 150 Character">{{ $menu->description }}</textarea>
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
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



    <div class="modal fade" id="add_menu">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('menu.store') }}" method="POST" class="validate" role="form" id="form1">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Add Menu</h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Menu Title <span style="color: red;">*</span></label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" data-validate="required" placeholder="Ex: Blog Post">
                        </div>
                        <div class="form-group">
                            <label for="menu_url">Menu URL</label>
                            <input type="text" name="menu_url" id="menu_url" value="{{ old('menu_url') }}" class="form-control" placeholder="Ex: post/create_post">
                        </div>
                        <div class="form-group">
                            <label for="parent_menu">Parent Menu</label>
                            <select name="parent_menu" id="parent_menu" class="form-control">
                                <option value="">Select Parent Menu</option>
                                @foreach($menu_list as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="menu_order">Menu Order <span style="color: red;">*</span></label>
                            <input type="number" name="menu_order" id="menu_order" value="{{ old('menu_order') }}" class="form-control" data-validate="number,minlength[1]" placeholder="Ex: 1" data-validate="required">
                        </div>
                        <div class="form-group">
                            <label for="menu_icon">Menu Icon</label>
                            <input type="text" name="menu_icon" id="menu_icon" value="{{ old('menu_icon') }}" class="form-control" placeholder="Ex: fa-book">
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
            $('#menu_datatable').DataTable({
                responsive: true,
                "order": [[ 0, "desc" ]]
            });
        } );
        function confirm_menu_delete() {
            if(confirm('Are you sure want to delete?')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection

