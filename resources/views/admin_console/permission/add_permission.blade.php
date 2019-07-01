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
                <li>
                    <a href="{{ url('/permission') }}">Permission</a>
                </li>
                <li class="active">
                    <strong>Add New Permission</strong>
                </li>
            </ol>
        </div>
    </div>
    @include('error.error_msg')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Add New Permission</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ url('/permission') }}" method="POST" role="form" id="form1" class="validate">
                        @csrf
                        <div class="form-group">
                            <label for="slug">Slug <span style="color: red;">*</span></label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" data-validate="required" placeholder="Ex: Slug" require>
                        </div>                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="2" data-validate="maxlength[150]" placeholder="Max 150 Character">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="" id="" value="Save Permission" class="btn btn-blue pull-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>
@endsection

