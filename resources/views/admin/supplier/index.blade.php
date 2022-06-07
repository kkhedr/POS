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
            <h3 class="card-title float-left">إضافة موردين</h3>
        </div>
        <!-- /.card-header -->
        <form method="post" action="{{Route('sup.store')}}">
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
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="إسم المورد" data-inputmask="'alias': 'ip'" data-mask >
                        </div>
                    </div>

                    <div class="col-md-4">


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" name="phone" value="{{old('phone')}}" placeholder="الموبيل " class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input type="submit" value="إضافة مورد" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
                    </div>

                    <!-- /.col -->

                </div>
                <!-- /.row -->
  
            </div>
        </form>

        <form method="post" action="/sup_paid_store">
        @csrf
        @method('post')
        @include('admin.partials._errors')
                <br><br>
                <div class="row">
                <div class="col-md-5">
                        
                        <div class="form-group">
                            <select name="sup_id" required class="form-control select2" style="width: 100%;">
                                <option value=''> إختر مورد ...</option>
                                @foreach($sups as $sup_name)
                                    <option value="{{$sup_name->id}}">{{$sup_name->name}}</option>
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
            <h3 class="card-title float-left">عرض الموردين</h3>
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

                                <th> التليفون</th>
                                <th> التاريخ</th>
                                
                                <th style="border-radius:30px 0px 0px 30px;">مؤثرات</th>
                            </tr>
                            </thead>
                            <tbody id="category_show">
                            @foreach($sups as $sup)
                                <tr>
                                    <td>{{$sup->id}}</td>
                                    <td>{{$sup->name}}</td>
                                    <td>{{$sup->phone}}</td> 
                                    <td>
                                        {{$sup->created_at}}

                                    </td>
                                    
                                    <td>

                                    <form action="{{ route('sup.destroy',$sup->id) }}" method="POST">
                                            <a class="edit_btn" href="" data-toggle="modal" data-target="#exampleModalLong{{$sup->id}}"><span class="fas fa-edit"></span></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete delete_btn"><span class="fas fa-trash"></span></button>
                                    </form>



                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalLong{{$sup->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('sup.update',$sup->id)}}" enctype="multipart/form-data">
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
                            <input type="text" name="name" value="{{$sup->name}}" class="form-control" placeholder="إسم المورد" data-inputmask="'alias': 'ip'" data-mask >
                        </div>
                    </div>

                    <div class="col-md-4">


                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" name="phone" value="{{$sup->phone}}" placeholder=" موبيل المورد" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input type="submit" value="تعديل المورد" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
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

                        {{$sups->links()}}
            </div>
        </div>


        


    </div>

    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">عرض دفعات الموردين</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

       
            <div class="col-md-12">
                    <!-- /.card-header -->
                        <table id="" style="width:100%" class="display table table-hover text-center">
                            <thead class="thead-dark">
                            <tr>
                               
                                <th style="border-radius:0px 30px 30px 0px;"> الإسم </th>
                                <th>  التليفون</th>
                                <th> الثمن الأساسى</th>
                                <th> الدفعة المدفوعة </th>
                                <th style="border-radius:30px 0px 0px 30px;"> الدفعة المتبقى</th>
                                
                                
                               
                            </tr>
                            </thead>
                            <tbody id="category_show">
                            @foreach($paids_sup as $paid_sup)
                                <tr>
                                    
                                    <td>{{$paid_sup['name']}}</td>
                                    <td>{{$paid_sup['phone']}}</td>
                                    <td>{{$paid_sup['total_price']}}</td>
                                    <td>{{$paid_sup['total_money']}}</td> 
                                    <td>{{$paid_sup['stay']}}</td> 
                                    
 
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
            </div>
        </div>


        


    </div>


    <br><br>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">عرض الدفعات بالتفاصيل</h3>
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
                                <th> التليفون</th>

                                <th> الدفعة</th>
                                <th> التاريخ</th>
                                
                                <th style="border-radius:30px 0px 0px 30px;">مؤثرات</th>
                            </tr>
                            </thead>
                            <tbody id="category_show">
                            @foreach($money as $mon)
                                <tr>
                                    <td>{{$mon['id']}}</td>
                                    <td>{{$mon['name']}}</td>
                                    <td>{{$mon['phone']}}</td>
                                    <td>{{$mon['money']}}</td> 
                                    <td>
                                        {{$mon['created_at']}}

                                    </td>
                                    
                                    <td>

                                    <form action="/sup_paid_delete/{{$mon['id']}}" method="POST">
                                            <a class="edit_btn" href="" data-toggle="modal" data-target="#exampleModalong{{$mon['id']}}"><span class="fas fa-edit"></span></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete delete_btn"><span class="fas fa-trash"></span></button>
                                    </form>



                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalong{{$mon['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="/sup_paid_update/{{$mon['id']}}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            @include('admin.partials._errors')

                                                            {{--name--}}
                                                            <div class="card-body">
                                                                <div class="form_content row">
                                                                   
                                                                    <div class="row">
                                                                    <div class="col-md-5">
                        
                        <div class="form-group">
                            <select name="sup_id" required class="form-control select2" style="width: 100%;">
                                <option value=''> إختر مورد ...</option>
                                @foreach($sups as $sup_name)
                                    <option value="{{$sup_name->id}}">{{$sup_name->name}}</option>
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


                                       
</td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
            </div>
        </div>
</div>


    

@endsection
