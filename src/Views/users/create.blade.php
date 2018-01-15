
@extends('layouts.app')
@section('title', trans('pages.'.explode('.',request()->route()->getName())[0].'.title'))


@section('content')
    <div class="wrap-content container" id="container">
      
        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::open(['route' => 'users.store', 'class' => 'form-horizontal', 'id'=>'users-form','files' => true]) !!}
                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-2">
                                @include('users._fields')
                                @password('name'=>'password','trans'=>'users','options'=>['required' => 'required'])

                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <div class="fileinput fileinput-new text-right" data-provides="fileinput">
                                        <div class="user-image">
                                            <div class="fileinput-new thumbnail"><img src="" alt="">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            <div class="user-image-buttons">
                                            <span class="btn btn-azure btn-file btn-sm"><span class="fileinput-new"><i class="fa fa-pencil"></i></span><span class="fileinput-exists"><i class="fa fa-pencil"></i></span>
                                                <input type="file" name="image">
                                            </span>
                                                <a href="#" class="btn fileinput-exists btn-red btn-sm" data-dismiss="fileinput">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-2">
                            {!! Form::submit('Create', ['class' => 'btn btn-primary btn-wide pull-right']) !!}
                            <a href="{{ route('users.index') }}" class="btn btn-default btn-wide">Cancel</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
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