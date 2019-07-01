@extends('layouts.master')

@section('title')
    Admin Console | Role Config
@endsection

@section('content')

<?php //dd($role_data->menus);  ?>

<div class="page-title">
    <div class="title-env">
        <h1 class="title">Role</h1>
        <p class="description">Role wise user, menu, permission manage</p>
    </div>
    <div class="breadcrumb-env">
        <ol class="breadcrumb bc-1" >
            <li>
                <a href="#"><i class="fa-cog"></i>Admin Console</a>
            </li>
            <li>
                <a href="{{ url('/role') }}">Role</a>
            </li>
            <li class="active">
                <strong>Role Config</strong>
            </li>
        </ol>
    </div>
</div>
@include('error.error_msg')
<div class="panel panel-default">
    <div class="panel-heading">

        <div class="panel-options">
            <a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span>
            </a>
            <a href="#" data-toggle="remove">
                &times;
            </a>
        </div>
        <div class="action_panel">
            <h4>Role Info:</h4>
        </div>

    </div>
    <div class="panel-body">
        <form action="{{ url('/role/update_role/'.$role_data->id) }}" method="POST" role="form" role="form" id="form1" class="validate">
            @csrf
            <div class="form-group">
                <label for="">Role Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $role_data->name }}" required>
            </div>
            <div class="form-group">
                <label for="">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $role_data->slug }}" required>
            </div>
            <div class="form-group">
                <input type="submit" name="save_group_form" id="save_group_form" value="Save Role Info" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">

        <div class="panel-options">
            <a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span>
            </a>
            <a href="#" data-toggle="remove">
                &times;
            </a>
        </div>
        <div class="action_panel">
            <h4>Role Menu:</h4>
        </div>
    </div>
    <div class="panel-body">
        <div class="menu-data">
            <form role="form" class="form-horizontal" action='{{ url("/role/{$role_data->id}/update_role_menu/") }}'' method="POST">
                @csrf
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="tagsinput-1"></label>

                    <div class="col-sm-9">

                        <script type="text/javascript">
                            jQuery(document).ready(function($)
                            {
                                $("#group_menu_list").multiSelect({
                                    afterInit: function()
                                    {
                                        // Add alternative scrollbar to list
                                        this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar();
                                    },
                                    dblClick: function()
                                    {
                                        // Update scrollbar size
                                        this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar('update');
                                    }
                                });
                            });
                        </script>
                        <select class="form-control" multiple="multiple" id="group_menu_list" name="group_menu_list[]">
                            @foreach($menu_list as $menu)
                                <option value="{{ $menu->id }}" style="{{ !$menu->parent_menu ? 'border-left: 2px solid #e67e22' : '' }};" 
                                    {{ $menu->role_id ? 'selected' : '' }}>{{ $menu->title }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="save_group_menu" id="save_group_menu" value="Save Role Menu" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">

        <div class="panel-options">
            <a href="#" data-toggle="panel">
                <span class="collapse-icon">&ndash;</span>
                <span class="expand-icon">+</span>
            </a>
            <a href="#" data-toggle="remove">
                &times;
            </a>
        </div>
        <div class="action_panel">
            <h4>Role Permissions:</h4>
        </div>
    </div>
    <div class="panel-body">
        <div class="menu-data">
            <form role="form" class="form-horizontal" action='{{ url("/role/{$role_data->id}/update_role_permission/") }}'' method="POST">
                @csrf
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="tagsinput-1"></label>

                    <div class="col-sm-9">

                        <script type="text/javascript">
                            jQuery(document).ready(function($)
                            {
                                $("#group_permission_list").multiSelect({
                                    afterInit: function()
                                    {
                                        // Add alternative scrollbar to list
                                        this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar();
                                    },
                                    dblClick: function()
                                    {
                                        // Update scrollbar size
                                        this.$selectableContainer.add(this.$selectionContainer).find('.ms-list').perfectScrollbar('update');
                                    }
                                });
                            });
                        </script>
                        <select class="form-control" multiple="multiple" id="group_permission_list" name="group_permission_list[]">
                            @foreach($perm_list as $perm)
                                <option value="{{ $perm->id }}" {{ $perm->role_id ? 'selected' : '' }}>{{ $perm->slug }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="save_group_menu" id="save_group_menu" value="Save Role Permission" class="btn btn-primary">
                </div>

            </form>
        </div>
    </div>
</div>

@endsection


@section('scripts')
    <script type="text/javascript">
        
    </script>
@endsection

