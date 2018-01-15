@extends('layouts.app')
@section('title', trans('roles.page-title'))
@section('css')

@endsection

@section('content')

     @pageTitle('trans'=>'roles','title'=>'roles','description'=>'Manage Roles',
               'breadcrumb'=>[trans('roles.administration'), trans('users.management'),trans('roles.index.list')],
               'buttons'=> slug() == 'admin' ? [
                  ['text'=> trans('roles.index.create_btn'),'url'=> route('roles.create')],
              ] : []
           )
    <div class="container-fluid container-fullw bg-white">

       <form style="margin-bottom: 10px;" name="search_form" class="pull-right" method="GET" action="{{route('roles.index')}}">
           <input id="search_grid" placeholder="Search In Grid"  type="text" name="string">
       </form>

       <form style="margin-bottom: 10px;" name="paginate_form" method="GET" action="{{route('roles.index')}}">
           <label>Show</label>
           <select name="paginate" id="paginate">
               <option {{($paginate == 10 ? 'selected' : '')}} value="10">10</option>
               <option {{($paginate == 25 ? 'selected' : '')}} value="25">25</option>
               <option {{($paginate == 50 ? 'selected' : '')}} value="50">50</option>
               <option {{($paginate == 100 ? 'selected' : '')}} value="100">100</option>
           </select>
           <label>Entries</label>
       </form>

       <table class="table table-bordered" id="roles-table">
           <thead>
           <tr>
                <th> <a href="{{route('roles.index')}}?field=name&orderBy={{$orderBy}}&string={{$searchString}}&paginate={{$paginate}}" >{{ trans('roles.name') }}</a></th>
                <th> <a href="{{route('roles.index')}}?field=label&orderBy={{$orderBy}}&string={{$searchString}}&paginate={{$paginate}}" >{{ trans('roles.label') }}</a></th>
	
                <th>{{ trans('roles.index.action') }}</th>

           </tr>
           </thead>
           <tbody>
           @foreach($roles as $item)
               <tr>
                   <td>{{ $item->name }}</td><td>{{ $item->label }}</td>
                   <td>
                       <a href="{{ route('roles.show', $item->id ) }}" class="btn btn-transparent btn-xs" data-toggle="tooltip" data-placement="left" title="View"><i class="fa fa-eye"></i></a>
                       <a href="{{ route('roles.edit', $item->id) }}" class="btn btn-transparent btn-xs" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
                       <a href="javascript:void(0)" class="btn btn-transparent btn-xs delete-roles" data-id="{{ $item->id }}" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fa fa-trash"></i></a>
                   </td>
               </tr>
           @endforeach
           </tbody>
       </table>
       {{ $roles->appends(Request::except('page'))->links() }}

    </div>

@endsection

@section('page-plugins')

@endsection


@section('page-scripts')

    <script>
            var table_selector = '#roles-table';

            $('.table').on('click', '.delete-roles', function(e){
                    tr = $(this).closest('tr');

                    var itemId = $(this).attr('data-id');

                    swal({
                        title: "{{ trans('roles.index.delete_box_title') }}",
                        text: "{{ trans('roles.index.delete_conformation') }}",
                        icon: "warning",
                        dangerMode: true,
                        buttons: {
                            cancel: true,
                            confirm: true,
                        },
                    }).then(willDelete => {
                        if(willDelete){
                            $.ajax({
                                url:  '{{ str_replace('-1','',route('roles.destroy',-1))  }}'+itemId,
                                headers: { 'X-XSRF-TOKEN' : '{{\Illuminate\Support\Facades\Crypt::encrypt(csrf_token())}}' },
                                error: function() {
                                    swal("Cancelled", "{{trans('roles.index.delete_unable')}}", "error");
                                },
                                success: function(response) {
                                    if(response.success == 'true'){
                                        tr.remove();
                                        swal("{{trans('roles.index.delete_validation')}}", "{{trans('roles.index.delete_msg')}}", "success");
                                    }else{

                                        swal("{{trans('roles.index.delete_unable')}}", "", "error");

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