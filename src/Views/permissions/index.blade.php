@extends('layouts.app')
@section('title', trans('permissions.page-title'))
@section('css')

@endsection

@section('content')

     @pageTitle('trans'=>'permissions','title'=>'Permissions','description'=>'Manage permissions',
               'breadcrumb'=>[trans('permissions.administration'), trans('users.management'),trans('permissions.index.list')],
               'buttons'=> slug() == 'admin' ? [
                  ['text'=> trans('permissions.index.create_btn'),'url'=> route('permissions.create')],
              ] : []
           )
    <div class="container-fluid container-fullw bg-white">

       <form style="margin-bottom: 10px;" name="search_form" class="pull-right" method="GET" action="{{route('permissions.index')}}">
           <input id="search_grid" placeholder="Search In Grid"  type="text" name="string">
       </form>

       <form style="margin-bottom: 10px;" name="paginate_form" method="GET" action="{{route('permissions.index')}}">
           <label>Show</label>
           <select name="paginate" id="paginate">
               <option {{($paginate == 10 ? 'selected' : '')}} value="10">10</option>
               <option {{($paginate == 25 ? 'selected' : '')}} value="25">25</option>
               <option {{($paginate == 50 ? 'selected' : '')}} value="50">50</option>
               <option {{($paginate == 100 ? 'selected' : '')}} value="100">100</option>
           </select>
           <label>Entries</label>
       </form>

       <table class="table table-bordered" id="permissions-table">
           <thead>
           <tr>
                <th> <a href="{{route('permissions.index')}}?field=name&orderBy={{$orderBy}}&string={{$searchString}}&paginate={{$paginate}}" >{{ trans('permissions.name') }}</a></th>
	<th> <a href="{{route('permissions.index')}}?field=label&orderBy={{$orderBy}}&string={{$searchString}}&paginate={{$paginate}}" >{{ trans('permissions.label') }}</a></th>
	
                <th>{{ trans('permissions.index.action') }}</th>

           </tr>
           </thead>
           <tbody>
           @foreach($permissions as $item)
               <tr>
                   <td>{{ $item->name }}</td><td>{{ $item->label }}</td>
                   <td>
                       <a href="{{ route('permissions.show', $item->id ) }}" class="btn btn-transparent btn-xs" data-toggle="tooltip" data-placement="left" title="View"><i class="fa fa-eye"></i></a>
                       <a href="{{ route('permissions.edit', $item->id) }}" class="btn btn-transparent btn-xs" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
                       <a href="javascript:void(0)" class="btn btn-transparent btn-xs delete-permissions" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fa fa-trash"></i></a>
                   </td>
               </tr>
           @endforeach
           </tbody>
       </table>
       {{ $permissions->appends(Request::except('page'))->links() }}

    </div>

@endsection

@section('page-plugins')

@endsection


@section('page-scripts')

    <script>
            var table_selector = '#permissions-table';

            $('.table').on('click', '.delete-permissions', function(e){
                    tr = $(this).closest('tr');

                    var itemId = $(this).attr('data-id');

                    swal({
                        title: "{{ trans('permissions.index.delete_box_title') }}",
                        text: "{{ trans('permissions.index.delete_conformation') }}",
                        icon: "warning",
                        buttons: {
                            cancel: true,
                            confirm: true,
                        },
                        dangerMode: true,
                    }).then(willDelete => {

                        if(willDelete){
                            $.ajax({
                                url:  '{{ str_replace('-1','',route('permissions.destroy',-1))  }}'+itemId,
                                headers: { 'X-XSRF-TOKEN' : '{{\Illuminate\Support\Facades\Crypt::encrypt(csrf_token())}}' },
                                error: function() {
                                    swal("Cancelled", "{{trans('permissions.index.delete_unable')}}", "error");
                                },
                                success: function(response) {
                                    if(response.success == 'true'){
                                        tr.remove();
                                        swal("{{trans('permissions.index.delete_validation')}}", "{{trans('permissions.index.delete_msg')}}", "success");
                                    }else{

                                        swal("{{trans('permissions.index.delete_unable')}}", "", "error");

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