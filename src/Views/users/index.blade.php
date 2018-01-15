@extends('layouts.app')
@section('title', trans('users.page-title'))
@section('css')

@endsection

@section('content')

     @pageTitle('trans'=>'users','title'=>'users','description'=>'Manage Users',
               'breadcrumb'=>[trans('users.administration'), trans('users.management'),trans('users.index.list')],
               'buttons'=> slug() == 'admin' ? [
                  ['text'=> trans('users.index.create_btn'),'url'=> route('users.create')],
              ] : []
           )
    <div class="container-fluid container-fullw bg-white">

       <form style="margin-bottom: 10px;" name="search_form" class="pull-right" method="GET" action="{{route('users.index')}}">
           <input id="search_grid" placeholder="Search In Grid"  type="text" name="string">
       </form>

       <form style="margin-bottom: 10px;" name="paginate_form" method="GET" action="{{route('users.index')}}">
           <label>Show</label>
           <select name="paginate" id="paginate">
               <option {{($paginate == 10 ? 'selected' : '')}} value="10">10</option>
               <option {{($paginate == 25 ? 'selected' : '')}} value="25">25</option>
               <option {{($paginate == 50 ? 'selected' : '')}} value="50">50</option>
               <option {{($paginate == 100 ? 'selected' : '')}} value="100">100</option>
           </select>
           <label>Entries</label>
       </form>

       <table class="table table-bordered" id="users-table">
           <thead>
           <tr>
                <th> <a href="{{route('users.index')}}?field=name&orderBy={{$orderBy}}&string={{$searchString}}&paginate={{$paginate}}" >{{ trans('users.name') }}</a></th>
	            <th> <a href="{{route('users.index')}}?field=email&orderBy={{$orderBy}}&string={{$searchString}}&paginate={{$paginate}}" >{{ trans('users.email') }}</a></th>
	
                <th>{{ trans('users.index.action') }}</th>

           </tr>
           </thead>
           <tbody>
           @foreach($users as $user)
               <tr>
                   <td>{{ $user->name }}</td>
                   <td>{{ $user->email }}</td>
                   <td>
                       <a href="{{ route('users.show', $user->id ) }}" class="btn btn-transparent btn-xs" data-toggle="tooltip" data-placement="left" title="View"><i class="fa fa-eye"></i></a>
                       <a href="{{ route('users.edit', $user->id) }}" class="btn btn-transparent btn-xs" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil"></i></a>
                       <a href="javascript:void(0)" class="btn btn-transparent btn-xs delete-users" data-id="{{ $user->id }}" data-toggle="tooltip" data-placement="left" title="Delete"><i class="fa fa-trash"></i></a>
                   </td>
               </tr>
           @endforeach
           </tbody>
       </table>
       {{ $users->appends(Request::except('page'))->links() }}

    </div>

@endsection

@section('page-plugins')

@endsection


@section('page-scripts')

    <script>
            var table_selector = '#users-table';

            $('.table').on('click', '.delete-users', function(e){
                    tr = $(this).closest('tr');

                    var itemId = $(this).attr('data-id');

                    swal({
                        title: "{{ trans('users.index.delete_box_title') }}",
                        text: "{{ trans('users.index.delete_conformation') }}",
                        icon: "warning",
                        dangerMode: true,
                        buttons: {
                            cancel: true,
                            confirm: true,
                        },
                    }).then(willDelete => {
                        if(willDelete){

                            $.ajax({
                                url:  '{{ str_replace('-1','',route('users.destroy',-1))  }}'+itemId,
                                headers: { 'X-XSRF-TOKEN' : '{{\Illuminate\Support\Facades\Crypt::encrypt(csrf_token())}}' },
                                error: function() {
                                    swal("Cancelled", "{{trans('users.index.delete_unable')}}", "error");
                                    toastr.error('{{trans('users.index.delete_unable')}}', '{{trans('users.index.error')}}');
                                },
                                success: function(response) {
                                    if(response.success == 'true'){

                                        tr.remove();
                                        swal("{{trans('users.index.delete_validation')}}", "{{trans('users.index.delete_msg')}}", "success");
                                    }else{
                                        swal("{{trans('users.index.delete_unable')}}", "", "error");

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