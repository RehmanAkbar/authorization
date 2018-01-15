@extends('layouts.app')
@section('content')
<div class="container-fluid container-fullw bg-white">
    <h1 style="text-align:centre">Listing Report</h1>
       <div class="panel panel-default">
         <div class="panel-heading">
            <div class="row">
               <div class="col-md-5 report_dropdown">
                 <!--  {{ $rows->appends(Request::except('paginate'))->links('vendor.pagination.dropdownPagination',['paginate'=>$paginate])}} -->
                 <nav aria-label="..." class="pagination_area">
                    <ul class="pager" role="tablist">
                          <li class="previous" onclick="goTo(1);"><a href="#"><span aria-hidden="true">←</span> Previous</a></li>
                          <li >
                              <select name="pagination">
                                <option value="pg1">Page 1</option>
                                <option value="pg2">Page 2</option>
                                <option value="pg3">Page 3</option>
                              </select>
                          </li>
                          <li class="next" onclick="goTo(2);"><a href="#">Next <span aria-hidden="true">→</span></a></li>
                      </ul>
                  </nav>
               </div>
               <div class="col-md-5">
                 <div id="report_search">
                <div class="input-group col-md-12">
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                    <input type="text" class="form-control" placeholder="Search" />
                    
                </div>
            </div>
               </div>
               <div class="col-md-2 text-right">
                 <a class="download btn margin-bottom-5 btn-wide btn-o btn-primary" >
                   <i class="fa fa-download" aria-hidden="true"></i>
                 </a>
               </div>
            </div>
         </div>
         <div class="clear30"></div>
         @yield('report_content')
            <div class="row">
                <div class="margin-top-30"></div>
                <div class="margin-top-30">
                <div class="col-md-3">
                    <p class="text-center" style="border-bottom: 1px solid #000;margin-bottom: 0px"></p>
                    <p class="text-center">{{'Remarks'}}</p>
                </div>
            
                <div class="col-md-3 pull-right">
                    <p class="text-center" style="border-bottom: 1px solid #000;margin-bottom: 0px"></p>
                    <p class="text-center">{{'Aprroved By'}}</p>
                </div>
            
                </div>
          </div>
       </div>
</div>
@endsection