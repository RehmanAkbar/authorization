@extends('layouts.app')
@section('title', trans('usertypes.page-title'))
@section('css')

@endsection

@section('content')

     @pageTitle('trans'=>'usertypes','title'=>'User Types','description'=>'Manage user types',
               'breadcrumb'=>[trans('usertypes.administration'), trans('usertypes.management') ,trans('usertypes.index.list')],
               'buttons'=> slug() == 'admin' ? [
                  ['text'=> trans('usertypes.index.create_btn'),'url'=> route('usertypes.create')],
              ] : []
           )
    <div class="container-fluid container-fullw bg-white">

       <form style="margin-bottom: 10px;" name="search_form" class="pull-right" method="GET" action="{{route('usertypes.index')}}">
           <input id="search_grid" placeholder="Search In Grid"  type="text" name="string">
       </form>

       <form style="margin-bottom: 10px;" name="paginate_form" method="GET" action="{{route('usertypes.index')}}">
           <label>Show</label>
           <select name="paginate" id="paginate">
               <option {{($paginate == 10 ? 'selected' : '')}} value="10">10</option>
               <option {{($paginate == 25 ? 'selected' : '')}} value="25">25</option>
               <option {{($paginate == 50 ? 'selected' : '')}} value="50">50</option>
               <option {{($paginate == 100 ? 'selected' : '')}} value="100">100</option>
           </select>
           <label>Entries</label>
       </form>

       <table class="table table-bordered" id="usertypes-table">
           <thead>
           <tr>
                <th> <a href="{{route('usertypes.index')}}?field=slug&orderBy={{$orderBy}}&string={{$searchString}}&paginate={{$paginate}}" >{{ trans('usertypes.slug') }}</a></th>
                <th> <a href="{{route('usertypes.index')}}?field=name&orderBy={{$orderBy}}&string={{$searchString}}&paginate={{$paginate}}" >{{ trans('usertypes.name') }}</a></th>
                <th> <a href="{{route('usertypes.index')}}?field=label&orderBy={{$orderBy}}&string={{$searchString}}&paginate={{$paginate}}" >{{ trans('usertypes.label') }}</a></th>

                <th>{{ trans('usertypes.index.action') }}</th>

           </tr>
           </thead>
           <tbody>
           @foreach($usertypes as $type)
               <tr>
                   <td>{{ $type->slug }}</td>
                   <td>{{ $type->name }}</td>
                   <td>{{ $type->label }}</td>
                   <td>
{{--                       <a href="{{ route('usertypes.show', $type->id ) }}" class="btn btn-transparent btn-xs" data-toggle="tooltip" data-placement="left" title="View"><i class="fa fa-eye"></i></a>--}}
                       <a href="{{ route('usertypes.edit', $type->id) }}" class="btn btn-transparent btn-xs" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
                       <a href="javascript:void(0)" class="btn btn-transparent btn-xs delete-usertypes" data-id="{{ $type->id }}" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fa fa-trash"></i></a>
                   </td>
               </tr>
           @endforeach
           </tbody>
       </table>
       {{ $usertypes->appends(Request::except('page'))->links() }}

    </div>

@endsection

@section('page-plugins')

@endsection


@section('page-scripts')

    <script>
            var table_selector = '#usertypes-table';

            $('.table').on('click', '.delete-usertypes', function(e){
                    tr = $(this).closest('tr');

                    var itemId = $(this).attr('data-id');

                    swal({
                        title: "{{ trans('usertypes.index.delete_box_title') }}",
                        text: "{{ trans('usertypes.index.delete_conformation') }}",
                        icon: "warning",
                        buttons: {
                            cancel: true,
                            confirm: true,
                        },
                        dangerMode: true,
                    })
                        .then(willDelete => {
                            if (willDelete) {
                                $.ajax({
                                    url: '{{ str_replace('-1','',route('usertypes.destroy',-1))  }}' + itemId,
                                    headers: {'X-XSRF-TOKEN': '{{\Illuminate\Support\Facades\Crypt::encrypt(csrf_token())}}'},
                                    error: function () {
                                        swal("Cancelled", "{{trans('usertypes.index.delete_unable')}}", "error");
                                        toastr.error('{{trans('usertypes.index.delete_unable')}}', '{{trans('usertypes.index.error')}}');
                                    },
                                    success: function (response) {
                                        if (response.success == 'true') {

                                            swal({
                                                icon: "success",
                                            });

                                        } else {
                                            swal({
                                                icon: "error",
                                            });

                                        }
                                    },

                                    type: 'DELETE'
                                });
                            }
                    });

                    e.preventDefault();
                });

        </script>

@endsection