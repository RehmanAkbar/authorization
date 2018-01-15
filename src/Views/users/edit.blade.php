@extends('layouts.app')
@section('title', trans('pages.'.explode('.',request()->route()->getName())[0].'.title'))


@section('content')
    <div class="wrap-content container" id="container">

        <!-- start: FORM VALIDATION EXAMPLE 1 -->
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::model($user, [ 'method' => 'PATCH','route' => ['users.update', $user->id],'class' => 'form-horizontal', 'id'=>'users-form' ]) !!}
                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-2">
                                @include('users._fields')


                                <div class="form-group">
                                    <label class="control-label">
                                        Gender
                                    </label>
                                    <div class="clip-radio radio-primary">
                                        <input type="radio" value="female" name="gender" {{($user->gender== 'female') ? "checked" :""}} id="us-female">
                                        <label for="us-female">
                                            Female
                                        </label>
                                        <input type="radio" value="male" name="gender" id="us-male" {{($user->gender== 'male') ? "checked" :""}} >
                                        <label for="us-male">
                                            Male
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-2">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary btn-wide pull-right']) !!}
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