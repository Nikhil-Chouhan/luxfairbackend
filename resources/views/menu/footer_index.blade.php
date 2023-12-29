@extends('layouts.main') 
@section('title', 'Manage Footer Menus')
@section('content')
    <!-- push external head elements to head -->     

    <div class="container-fluid">
    	<div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-list bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Manage Footer Menus')}}</h5> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{url('admin/dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Manage Footer Menus')}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12">
                
                <div class="separator mb-20"></div>

                <div class="row layout-wrap" id="layout-wrap">
                    <div class="card p-3">
                        <div class="card-header"><h3>{{ __('Manage Menus')}}</h3></div>
                        <div class="card-body">
                        <div class="row">
                  <div class="col-md-6">
                     <h5 class="mb-4 text-center bg-success text-white ">Add New Menu</h5>
                     <form accept="{{ route('menus.store')}}" method="post">
                        @csrf
                        
                        <input type="hidden" name="type" value="footer">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Title</label>
                                 <input type="text" name="title" class="form-control">   
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Link</label>
                                 <input type="text" name="link" class="form-control">   
                              </div>
                           </div>
                        </div> 
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label>Parent</label>
                                 <select class="form-control select2" name="parent_id">
                                    <option selected value="">Select Parent Menu</option>
                                    @foreach($allMenus as $key => $value)
                                       <option value="{{ $key }}">{{ $value}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <button class="btn btn-success">Save</button>
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-6">
                     <h5 class="text-center mb-4 bg-info text-white">Menu List</h5>
                      <ul id="tree1">
                         @foreach($menus as $menu)
                            <li>
                                {{ $menu->title }} 
                                @if(count($menu->childs) == 0)
                                <i class="ik ik-trash-2 f-16 text-red" onclick="deleteMenu({{$menu->id}})"></i>
                                @endif
                                @if(count($menu->childs))
                                    <i class="ik ik-arrow-down-circle"></i>
                                    @include('menu.manageChild',['childs' => $menu->childs])
                                @endif
                            </li>
                         @endforeach
                        </ul>
                  </div>
               </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div> 

    

   <!-- push external js -->
   @push('script') 

    <!--server side  table script-->
    <script src="{{ asset('js/custom/manufacturers.js') }}"></script>
    <script src="{{ asset('js/treeview.js') }}"></script>
    <script>
        function deleteMenu(id){
            if(confirm('Are you sure to delete this menu?')){
                $.ajax({
                    url: "{{ url('admin/menus-delete') }}/"+id,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(response){
                        if(response.success == true){
                            location.reload();
                        }
                    }
                });
            }
        }
    </script>
    @endpush
@endsection