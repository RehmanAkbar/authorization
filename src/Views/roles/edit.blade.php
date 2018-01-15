@extends('layouts.app')
@section('title', trans('pages.'.explode('.',request()->route()->getName())[0].'.title'))


@section('content')
    <div class="wrap-content container" id="container">
        
        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($role, [ 'method' => 'POST','route' => ['roles.update', $role->id],'class' => 'form-horizontal', 'id'=>'roles-form' ]) !!}
                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-2">
                                @include('roles._fields')
                                <input type="hidden" name="role_id" value="{{$role->id}}" >
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 col-md-offset-2">
                            <div class="col-md-6 ">
                                <div class="panel panel-white">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Select Permissions</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div id="tree" class="tree-demo">
                                            <ul>
                                                @foreach($permissions as $permission)
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
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-2">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary btn-wide pull-right']) !!}
                            <a href="{{ route('roles.index') }}" class="btn btn-default btn-wide">Cancel</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div id="treeview"></div>
            </div>
        </div>
        <!-- end: FORM VALIDATION EXAMPLE 1 -->
    </div>
@endsection


@section('page-scripts')
    <script>

        $("#roles-form").on('submit', function(e){
            e.preventDefault();

            $form = $(this);
            var data = $form.serialize();

            var permissions = [];
            var selectedElms = $('#tree').jstree("get_selected", true);
            $.each(selectedElms, function(index, data) {

                permissions[index] = data.id;

            });
//
//            data.push({permission: permissions});
//            console.log(data);

            var request = $.ajax({
                url: "{{route('add_permissions')}}",
                method: "POST",
                data: data + '&permissions='+permissions,
                dataType: "json"
            });

            request.done(function( msg ) {
                $( "#log" ).html( msg );
            });

            request.fail(function( jqXHR, textStatus ) {
                console.log( "Request failed: " + textStatus );
            });
        })

    </script>

@endsection