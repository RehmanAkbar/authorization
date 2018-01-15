@extends('layouts.app')
@section('title', trans('pages.'.explode('.',request()->route()->getName())[0].'.title'))

@section('content')
    <div class="wrap-content container" id="container">
        
        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-2">
                                <div class="panel panel-white" id="panel1">
                                    <div class="panel-body mainDescription">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label><b>{{ trans('roles.name') }}:</b></label>
                                            </div>
                                            <div class="col-xs-9">
                                                {{ $role->name }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <label><b>{{ trans('roles.label') }}:</b></label>
                                            </div>
                                            <div class="col-xs-9">
                                                {{ $role->label }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">Role's Permissions</h4>
                                            </div>
                                            <div class="panel-body">
                                                <div id="RolePermissionsTree" class="tree-demo">
                                                    <ul>
                                                        @foreach($role['permissions'] as $permission)
                                                            <li id="{{$permission->id}}" data-id="{{$permission->id}}">
                                                                {{$permission->name}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('roles.index') }}" class="btn btn-default btn-wide pull-right">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: FORM VALIDATION EXAMPLE 1 -->
    </div>
@endsection

@section('page-scripts')
<script>

</script>
@endsection

