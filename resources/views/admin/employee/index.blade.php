@extends('admin.app')

@section('content_header')


<style>
.edit_btn{
    background-color: #006400;
  color: white;
  padding: 2px 4px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
.edit_btn:hover{
    color: white;
}
.delete_btn{
    background-color: #8B0000;
  color: white;
  padding: 2px 4px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}
table th{
    font-size :14px;
}



</style>


@endsection
@section('content')


<link rel="stylesheet" href="{{ asset('dist/css/bootstrap4.min.css') }}">

    <br><br>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">إضافة موظفين</h3>
        </div>
        <!-- /.card-header -->
        <form method="post" action="{{Route('emp.store')}}">
            @csrf
            @method('post')

            @include('admin.partials._errors')

            {{--name--}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-shopping-bag"></i></span>
                            </div>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="إسم الموظف" data-inputmask="'alias': 'ip'" data-mask >
                        </div>
                    </div>

                    <div class="col-md-4">


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" name="salary" value="{{old('salary')}}" placeholder="راتب الموظف" class="form-control" step="0.01">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input type="submit" value="إضافة موظف" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
                    </div>

                    <!-- /.col -->

                </div>
                <!-- /.row -->
  
            </div>
        </form>

      

        <!-- /.card-body -->
        <div class="card-footer">

        </div>

       
<br><br>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">عرض الموظفين</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

       
            <div class="col-md-12">
                    <!-- /.card-header -->
                        <table id="" style="width:100%" class="display table table-hover text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th style="border-radius:0px 30px 30px 0px;"> الرقم</th>
                                <th> الأسم</th>

                                <th> المرتب</th>
                                <th> التاريخ</th>
                                
                                <th style="border-radius:30px 0px 0px 30px;">مؤثرات</th>
                            </tr>
                            </thead>
                            <tbody id="category_show">
                            @foreach($emps as $emp)
                                <tr>
                                    <td>{{$emp->id}}</td>
                                    <td>{{$emp->name}}</td>
                                    <td>{{$emp->salary}}</td> 
                                    <td>
                                        {{$emp->created_at}}

                                    </td>
                                    
                                    <td>

                                    <form action="{{ route('emp.destroy',$emp->id) }}" method="POST">
                                            <a class="edit_btn" href="" data-toggle="modal" data-target="#exampleModalLong{{$emp->id}}"><span class="fas fa-edit"></span></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete delete_btn"><span class="fas fa-trash"></span></button>
                                    </form>



                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalLong{{$emp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('emp.update',$emp->id)}}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            @include('admin.partials._errors')

                                                            {{--name--}}
                                                            <div class="card-body">
                                                                <div class="form_content row">
                                                                   
                                                                    <div class="row">
                    <div class="col-md-5">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-shopping-bag"></i></span>
                            </div>
                            <input type="text" name="name" value="{{$emp->name}}" class="form-control" placeholder="إسم الموظف" data-inputmask="'alias': 'ip'" data-mask >
                        </div>
                    </div>

                    <div class="col-md-4">


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" name="salary" value="{{$emp->salary}}" placeholder="راتب الموظف" class="form-control" step="0.01">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input type="submit" value="تعديل موظف" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
                    </div>
                                                                  
                       

                                                                                                    


                                                                    <!-- /.col -->

                                                                </div>
                                                                <!-- /.row -->
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> إغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                       
</td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
            </div>
        </div>


        


    </div>

    

@endsection
