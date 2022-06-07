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
            <h3 class="card-title float-left">إضافة مصروفات خارجية</h3>
        </div>
        <!-- /.card-header -->
        <form method="post" action="{{Route('net.store')}}">
            @csrf
            @method('post')

            @include('admin.partials._errors')

            {{--name--}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="input-group">
                            
                            <textarea name="desc" rows="4" cols="50" label="التفاصيل">
                                التفاصيل
                            {{old('desc')}}
                           </textarea>
                        </div>
                    </div>

                    <div class="col-md-4">


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" name="price" value="{{old('price')}}" placeholder=" الثمن" class="form-control" step="0.01">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input type="submit" value="إضافة مصروف" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
                    </div>

                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
        </form>

        <form method="post" action="/emp_paid_store">
        @csrf
        @method('post')
        @include('admin.partials._errors')
                <br><br>
                <div class="row">
                <div class="col-md-5">
                        
                        <div class="form-group">
                            <select name="emp_id" required class="form-control select2" style="width: 100%;">
                                <option value=''> إختر موظف ...</option>
                                @foreach($emps as $emp_name)
                                    <option value="{{$emp_name->id}}">{{$emp_name->name}}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" name="money" required value="{{old('money')}}" placeholder="دفعة الموظف " class="form-control" step="0.01">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input type="submit" value="دفع" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
                    </div>

                    <!-- /.col -->

                </div>
                <!-- /.row -->
</form>

        <!-- /.card-body -->
        <div class="card-footer">

        </div>

       
<br><br>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">عرض المصروفات</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

       
            <div class="col-md-12">
                    <!-- /.card-header -->
                        <table id="" style="width:100%" class="display table table-hover text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th style="border-radius:0px 30px 30px 0px;"> الرقم</th>
                                <th> التفاصيل</th>

                                <th> الثمن</th>
                                <th> التاريخ</th>
                                
                                <th style="border-radius:30px 0px 0px 30px;">مؤثرات</th>
                            </tr>
                            </thead>
                            <tbody id="category_show">
                            @foreach($nets as $net)
                                <tr>
                                    <td>{{$net->id}}</td>
                                    <td>{{$net->desc}}</td>
                                    <td>{{$net->price}}</td> 
                                    <td>
                                        {{$net->created_at}}

                                    </td>
                                    
                                    <td>

                                    <form action="{{ route('net.destroy',$net->id) }}" method="POST">
                                            <a class="edit_btn" href="" data-toggle="modal" data-target="#exampleModalLong{{$net->id}}"><span class="fas fa-edit"></span></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete delete_btn"><span class="fas fa-trash"></span></button>
                                    </form>



                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalLong{{$net->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('net.update',$net->id)}}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            @include('admin.partials._errors')

                                                            {{--name--}}
                                                            <div class="card-body">
                                                                <div class="form_content row">
                                                                   
                                                                    <div class="row">
                                                                    <div class="col-md-5">
                        <div class="input-group">
                            
                            <textarea name="desc" rows="4" cols="50">
                            {{$net->desc}}
                           </textarea>
                        </div>
                    </div>

                    <div class="col-md-4">


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" name="price" value="{{$net->price}}" placeholder=" الثمن" class="form-control" step="0.01">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input type="submit" value="تعديل مصروف" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
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

        <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">عرض دفعات الموظفين</h3>
        </div>
        <!-- /.card-header -->
       
        <div class="card-body">
        <form action="/net" method="get">
                        @csrf
    <div class="input-group rounded" style="margin-bottom:15px;width:50%">
    <input style="width: 50%" type="date" id="to" name="date_month"
                       value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
  <span class="input-group-text border-0" id="search-addon">
    <i class="fas fa-search"></i>
  </span>
</div>

<div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i></i></span>
                            </div>
                            <input type="submit" value=" بحث" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>

</form>
       
            <div class="col-md-12">
                    <!-- /.card-header -->
                        <table id="" style="width:100%" class="display table table-hover text-center">
                            <thead class="thead-dark">
                            <tr>
                            @if(!isset($salary_details[0]['stay']))
                                <th style="border-radius:0px 30px 30px 0px;"> الرقم</th>
                            @endif
                                <th> الإسم </th>

                                <th> الراتب الأساسى</th>
                                <th> الدفعة المأخوذة </th>
                               
                                @if(isset($salary_details[0]['stay']))
                                <th> الراتب المتبقى</th>
                                @else
                                <th>  التاريخ</th>
                                <th style="border-radius:30px 0px 0px 30px;">مؤثرات</th>
                                @endif
                                
                               
                                
                                
                                
                               
                            </tr>
                            </thead>
                            <tbody id="category_show">
                            @foreach($salary_details as $salary_detail)
                                <tr>

                                @if(!isset($salary_details[0]['stay']))
                                <td>{{$salary_detail['id']}}</td>
                                @endif
                                    <td>{{$salary_detail['name']}}</td>
                                    <td>{{$salary_detail['salary']}}</td>
                                    <td>{{$salary_detail['money']}}</td> 
                                    @if(isset($salary_detail['stay']))
                                    <td>{{$salary_detail['stay']}}</td> 
                                    @else
                                    <td>
                                        {{$salary_detail['created_at']}}

                                    </td>
                                    @endif
                                    
                                    
                                    <td>

                                    @if(!isset($salary_details[0]['stay']))

                                    <form action="/emp_paid_delete/{{$salary_detail['id']}}" method="POST">
                                            <a class="edit_btn" href="" data-toggle="modal" data-target="#exampleModalLong{{$salary_detail['id']}}"><span class="fas fa-edit"></span></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete delete_btn"><span class="fas fa-trash"></span></button>
                                    
                                    
                                        </form>

                                           <!-- Modal -->
                                           <div class="modal fade" id="exampleModalLong{{$salary_detail['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="/emp_paid_update/{{$salary_detail['id']}}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            @include('admin.partials._errors')

                                                            {{--name--}}
                                                            <div class="card-body">
                                                                <div class="form_content row">
                                                                   
                                                                    <div class="row">
                                                                    <div class="col-md-5">
                        
                        <div class="form-group">
                            <select name="emp_id" required class="form-control select2" style="width: 100%;">
                                <option value=''> إختر موظف ...</option>
                                @foreach($emps as $emp_name)
                                    <option value="{{$emp_name->id}}">{{$emp_name->name}}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" name="money" required value="{{$salary_detail['money']}}" placeholder=" دفعة الموظف " class="form-control" step="0.01">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input type="submit" value="تعديل الدفع" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
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

                                    @endif



                                     

                                       
</td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
            </div>
        </div>


        


    </div>

    

@endsection
