@extends('admin.app')

@section('content_header')

@endsection
@section('content')

<link rel="stylesheet" href="{{ asset('dist/css/bootstrap4.min.css') }}">

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

<br><br>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">عرض المنتجات</h3>
            <a href="/product/create" class="btn btn-success float-right">إضافة منتجات</a>

        </div>
        <!-- /.card-header -->
        <div class="card-body">

        <form action="/purchase" method="get">
    <div class="row">
            @csrf
            <div class="col-md-5">
                <label for="start">من:</label>

                <input style="width: 50%" type="date" id="start" name="start_date"
                       value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>

            <div class="col-md-5">
                <label for="start">إلى:</label>

                <input style="width: 50%" type="date" id="to" name="to_date"
                       value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>

            <div class="col-md-2">

                <input class="btn btn-danger" type="submit" value="عرض">
                <br><br>
            </div>
    </div>
    </form>


        <form id="form_product_search" action="/purchase" method="get">
                        @csrf
    <div class="container">
        <div class="row">

        <div class="col-md-6">
        <div class="input-group rounded" style="margin-bottom:15px">
  <input type="text" class="form-control rounded" id="search_id" class="search_class" name="search" placeholder=" إبحث بسعر أو إسم المنتج" aria-label="Search" aria-describedby="search-addon" />
  <span class="input-group-text border-0" id="search-addon">
    <i class="fas fa-search"></i>
  </span>
</div>
        </div>

        <div class="col-md-6">
        <select name="category_search" id="category_name_search" class="form-select" aria-label="Default select example">
        <option value='' selected>إختر فئة</option>
        @foreach($catgeories as $category)
  <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
        </select>

        </div>

        </div>
</div>

</form>
            <div class="col-md-12">
                    <!-- /.card-header -->
                        <table id="" style="width:100%" class="display table table-hover text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th style="border-radius:0px 30px 30px 0px;"> رقم العملية</th>
                                <th> الأسم</th>

                                <th> سعر القطعة</th>
                                <th> اللون / مقاس</th>
                                <th> الكمية</th>
                                <th> السعر الكلى</th>
                                <th>صورة المنتج</th>
                                <th>الفئة</th>
                                <th>تاريخ الإستلام</th>
                                <th> بيانات المورد</th>
                                <th style="border-radius:30px 0px 0px 30px;">مؤثرات</th>
                            </tr>
                            </thead>
                            <tbody id="category_show">
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{$purchase->id}}</td>
                                    <td>{{$purchase->product[0]->name}}</td>
                                    <td>{{$purchase->product[0]->price_buy}}</td>
                                    @if(isset($purchase->size))
                                    <td>{{$purchase->color}} : {{$purchase->size}}</td>

                                    @else
                                    <td>{{$purchase->color}}</td>
                                    @endif

                                    <td>
                                    <form id="form_stock_edit" action="/stock_purchase_edit" method="get">
                                      @csrf
                                        <input type="number" name="stock_edit" id="stock_edit" class="stock_edit" style="width:50%" value="{{$purchase->stock}}">
                                        <input type="hidden" name="id"  value="{{$purchase->id}}">

                                    </form>
                                    </td>
                                    
                                    <td>{{$purchase->stock * $purchase->product[0]->price_buy}}</td>


                                    <td><img style="width: 100px;height: 100px" src="{{$purchase->product[0]->image_path}}"></td>
                                    <td>
                                        <label>{{$purchase->product[0]->category->name}}</label>

                                    </td>
                                    <td>
                                        {{$purchase->created_at}}

                                    </td>
                                    <td>
                                        
                                        {{$purchase->supplier[0]->name}} <br/>
                                        {{$purchase->supplier[0]->phone}}
                                        
                                        
                                        
                                        

                                    </td>
                                    <td>
                                                        

                                        <form action="/purchase/{{$purchase->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete delete_btn"><span class="fas fa-trash"></span></button>
                                        </form>
</td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
            </div>
        </div>


        {{$purchases->links()}}


    </div>


    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>

        $(document).ready(function (){

            let color_content = []
            let indexs = [];
            let index = 0;



            $(document).delegate('#search_id','keypress',function (e) {
                var code = e.keyCode || e.which;
            if(code == 13){
               var search = $(this).val();

               if(search != null){
                   $('#form_product_search').submit();
               }
            }
            });
            $(document).delegate('#stock_edit','keypress',function (e) {
                var code = e.keyCode || e.which;
            if(code == 13){
               var stock_new = $(this).val();

               if(stock_new != null){
                   $('#form_product_search').submit();
               }
            }
            });

            

            $(document).delegate('#category_name_search','change',function () {
               var category_id = $(this).val();

               if(category_id != null){
                   $('#form_product_search').submit();
               }

            });

            $(document).delegate('.color_remove_click','click',function () {
                var div_index = $(this).attr('data-index');
                    $(`#colors_conent_num${div_index}`).remove();
                    $(`#colors_amount_num${div_index}`).remove();
                    $(`#colors_size_num${div_index}`).remove();      
                    $(`#color_remove_click${div_index}`).remove();
                    $(`#colors_amount_update${div_index}`).remove();
                    $(`#colors_size_update${div_index}`).remove();
            });

            $(document).delegate('.add_size','click',function (){
                $('.add_without_size').css('display','none');
                $('.submit_op').remove();

                $('.form_content').append(`


<div class="col-md-2" id="color_remove_click${index}">
<a class="color_remove_click" data-index="${index}" style="font-size: 50px;background-color:#000000;color:white;border-radius:50%">×</a>
</div>
<div class="col-md-4" id="colors_conent_num${index}">
 <label id="product_price" for="" class="">اللون </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" name="color[]" required value="" class="form-control" >
                       
                        </div>
</div>
<div class="col-md-3" id="colors_amount_num${index}">
        <label id="product_stock" for="" class=""> الكمية</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>
                            </div>
                            <input type="number" name="stock[]" required value="" class="form-control" >
                        </div>
</div>

<div class="col-md-3" id="colors_size_num${index}">
        <label id="product_stock" for="" class=""> المقاس</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>
                            </div>
                            <input type="number" name="size[]" required value="" class="form-control" >
                        </div>
</div>

                `);

                $('.form_content').append(`

 <div class="submit_op col-md-12">
                <br><br>
                        <div class="input-group" style="display: flex;justify-content: center;align-items: center;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input  type="submit" value="إضافة المنتج" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
 </div>

             `);

                index++;
            });

            $(document).delegate('.add_without_size','click',function (){
                $('.add_size').css('display','none');
                $('.submit_op').remove();

                $('.form_content').append(`


<div class="col-md-2" id="color_remove_click${index}">
<a class="color_remove_click" data-index="${index}" style="font-size: 50px;background-color:#000000;color:white;border-radius:50%">×</a>
</div>
<div class="col-md-5" id="colors_conent_num${index}">
 <label id="product_price" for="" class="">اللون </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" name="color[]" required value="" class="form-control" >
                        </div>
</div>
<div class="col-md-5" id="colors_amount_num${index}">
        <label id="product_stock" for="" class=""> الكمية</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>
                            </div>
                            <input type="number" name="stock[]" required value="" class="form-control" >
                        </div>
</div>

                `);

                $('.form_content').append(`

 <div class="submit_op col-md-12">
                <br><br>
                        <div class="input-group" style="display: flex;justify-content: center;align-items: center;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input  type="submit" value="إضافة المنتج" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
 </div>

             `);

                index++;
            });
        });
    </script>


    {{--    <script type="text/javascript">--}}

    {{--        $.ajaxSetup({--}}
    {{--            headers: {--}}
    {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--            }--}}
    {{--        });--}}

    {{--        $.ajax({    //create an ajax request to display.php--}}
    {{--            type: "GET",--}}
    {{--            url: "../categories",--}}
    {{--            dataType: "json",   //expect html to be returned--}}
    {{--            success: function (response) {--}}
    {{--                console.log(response.data.category.data.length)--}}
    {{--                var contentFirst = "<tr>";--}}

    {{--                for(var i = 0 ; i < response.data.category.data.length ; i ++)--}}
    {{--                {--}}
    {{--                    contentFirst += ` <td> ${response.data.category.data[i].id}</td>`;--}}
    {{--                    contentFirst += ` <td> ${response.data.category.data[i].name}</td>`;--}}
    {{--                    contentFirst += ` <td> <img src="${response.data.category.data[i].image}"></td>`;--}}
    {{--                }--}}

    {{--                     contentFirst += "</tr>";--}}

    {{--                 $('#category_show').append(contentFirst);--}}
    {{--            }--}}
    {{--        });--}}


    {{--    </script>--}}



@endsection
