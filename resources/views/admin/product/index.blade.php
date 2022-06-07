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

        <form action="/product" method="get">
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


        <form id="form_product_search" action="/product" method="get">
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
                                <th style="border-radius:0px 30px 30px 0px;"> الرقم</th>
                                <th> الأسم</th>

                                <th> سعر البيع</th>
                                <th> سعر الشراء</th>
                                <th> التفاصيل</th>
                                <th>صورة المنتج</th>
                                <th>الفئة</th>
                                <th>تاريخ الإنشاء</th>
                                <th> المورد</th>
                                <th style="border-radius:30px 0px 0px 30px;">مؤثرات</th>
                            </tr>
                            </thead>
                            <tbody id="category_show">
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->price_buy}}</td>
                                    <td style="width:20%">
                                     <!-- Modal -->
                                     <div class="modal fade" id="exampleModalColor{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalColorTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalColorTitle"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <ol style="list-style-type: decimal; ">
                                        @foreach($product->options as $option)
                                            <li>
                                                <span>{{$option->color}}</span>
                                                <strong>/</strong>

                                                @if($option->size != null)
                                                    <span>المقاس:</span>{{$option->size}}
                                                    <strong>/</strong>
                                                @endif

                                                <span>الكمية:</span> {{$option->stock}}
                                            </li>
                                        @endforeach
                                        </ol>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> إغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalColor{{$product->id}}">الألوان</a>


                                    </td>

                                    <td><img style="width: 100px;height: 100px" src="{{$product->image_path}}"></td>
                                    <td>
                                        <label>{{$product->category->name}}</label>

                                    </td>
                                    <td>
                                        {{$product->created_at}}

                                    </td>
                                    <td>
                                        @if(isset($product->supplier[0]))
                                        {{$product->supplier[0]->name}}
                                        @endif
                                        

                                    </td>
                                    <td>



                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalLong{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            @include('admin.partials._errors')

                                                            {{--name--}}
                                                            <div class="card-body">
                                                                <div class="form_content row">
                                                                    <div class="col-md-6">
                                                                        <label id="product_name" for="" class="">إسم المنتج</label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-shopping-bag"></i></span>
                                                                            </div>
                                                                            <input type="text" name="name" value="{{$product->name}}" class="form-control" data-inputmask="'alias': 'ip'" data-mask >
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-6">
                                                                        <!-- Upload image input-->
                                                                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                                            <input id="upload" type="file" name="image" onchange="" class="image form-control border-0">
                                                                            <label id="upload-label" for="upload" class="font-weight-bold  text-muted"></label>
                                                                            <div class="input-group-append">
                                                                                <label for="upload" id="upload_shape" class="btn btn-success rounded-pill mr-2"> <small class="text-uppercase">صورة المنتج</small></label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <img src="" style="display:none;width: 250px;height: 100px" class="image-preview">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <br>
                                                                        <div class="form-group">
                                                                            <label>ماذا تكون فئته</label>
                                                                            <select name="category_id" class="form-control select2" style="width: 100%;">
                                                                                @foreach($catgeories as $category)
                                                                                    @if($category->id == $product->category->id)
                                                                                        <option value="{{$product->category->id}}" selected="selected"> {{$product->category->name}}</option>
                                                                                    @endif
                                                                                    @if($category->id != $product->category->id)
                                                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                                                    @endif

                                                                                @endforeach

                                                                            </select>
                                                                        </div>
                                                                    </div>



                                                                    <div class="col-md-3">
                                                                        <br>
                                                                        <label id="product_price" for="" class="">سعر المنتج </label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                            </div>
                                                                            <input type="number" name="price" value="{{$product->price}}" class="form-control" >
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                        <br>
                        <label>سعر الشراء</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" required name="price_buy" value="{{$product->price_buy}}" placeholder="سعر الشراء" class="form-control" step="0.01">
                        </div>
                    </div>

                                                                    <div class="col-md-6">
                                                                        <br><br>
                                                                        <div class="input-group" style="display: flex;justify-content: center;align-items: center;">
                                                                            <input id="add_size"  type="button" value="مقاس" class="add_size btn btn-danger" >
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <br><br>
                                                                        <div class="input-group" style="display: flex;justify-content: center;align-items: center;">
                                                                            <input id="add_without_size"  type="button" value="بدون مقاس" class="add_without_size btn btn-danger" >
                                                                        </div>
                                                                    </div>

                                                                    @foreach($product->options as $option)
                                                                        <div class="col-md-2" id="color_remove_click{{$option->id}}">
                                                                            <a href="#" class="color_remove_click" data-index="{{$option->id}}" style="font-size: 50px;background-color:white;color:black;border-radius:50%">×</a>
                                                                        </div>

                                                                        @if($option->size == null)
                                                                            <div class="col-md-5" id="colors_conent_num{{$option->id}}">
                                                                                <label id="product_price" for="" class=""> اللون </label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                                    </div>
                                                                                    <input type="text" style="width: 20.499999995%;" name="color_old[]" required value="{{$option->color}}" class="form-control" >
                                                                                    <input type="hidden" name="color_old_hidden[]" value="{{$option->id}}" required class="form-control" >

                                                                                </div>
                                                                            </div>

                                                                            <div class="colors col-md-5" id="colors_amount_num{{$option->id}}">
                                                                                <label id="product_stock" for="" class=""> تعديل الكمية</label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>
                                                                                    </div>
                                                                                    <input type="number" name="stock_old[]" required value="{{$option->stock}}" class="form-control" >
                                                                                    <input type="hidden" name="stock_option_ids[]" value="{{$option->id}}" required class="form-control" >

                                                                                </div>
                                                                            </div>

                                                                        @else
                                                                            <div class="col-md-4" id="colors_conent_num{{$option->id}}">
                                                                                <label id="product_price" for="" class=""> اللون </label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                                    </div>
                                                                                    <input type="text" style="width: 20.499999995%;" name="color_old[]" required value="{{$option->color}}" class="form-control" >
                                                                                    <input type="hidden" name="color_old_hidden[]" value="{{$option->id}}" required class="form-control" >

                                                                                </div>
                                                                            </div>

                                                                            <div class="colors col-md-3" id="colors_amount_num{{$option->id}}">
                                                                                <label id="product_stock" for="" class=""> تعديل الكمية</label>
                                                                                <div class="input-group">
                                                                                    <div class="input-group-prepend">
                                                                                        <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>
                                                                                    </div>
                                                                                    <input type="number" name="stock_old[]" required value="{{$option->stock}}" class="form-control" >
                                                                                    <input type="hidden" name="stock_option_ids[]" value="{{$option->id}}" required class="form-control" >

                                                                                </div>
                                                                            </div>
                                                                        @endif

                                                                        @if($option->size != null)

                                                                        <div class="colors col-md-3" id="colors_size_update{{$option->id}}">
                                                                            <label id="product_stock" for="" class=""> المقاس </label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>
                                                                                </div>
                                                                                <input type="number" name="size_old[]" required value="{{$option->size}}" class="form-control" >
                                                                                <input type="hidden" name="size_add_option_ids[]" value="{{$option->id}}" required class="form-control" >


                                                                            </div>
                                                                        </div>
                                                                        @endif

{{--                                                                        <div class="colors col-md-3" id="colors_amount_update{{$option->id}}">--}}
{{--                                                                            <label id="product_stock" for="" class=""> تحديث </label>--}}
{{--                                                                            <div class="input-group">--}}
{{--                                                                                <div class="input-group-prepend">--}}
{{--                                                                                    <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>--}}
{{--                                                                                </div>--}}
{{--                                                                                <input type="number" name="stock_add[]" class="form-control" >--}}
{{--                                                                                <input type="hidden" name="stock_add_option_ids[]" value="{{$option->id}}" required class="form-control" >--}}


{{--                                                                            </div>--}}
{{--                                                                        </div>--}}




                                                                @endforeach



                                                                    <!-- /.col -->
                                                                    <div class="submit_op col-md-12">
                <br><br>
                        <div class="input-group" style="display: flex;justify-content: center;align-items: center;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input  type="submit" value="تعديل المنتج" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
 </div>
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


                                        <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                                            <a class="edit_btn" href="" data-toggle="modal" data-target="#exampleModalLong{{$product->id}}"><span class="fas fa-edit"></span></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete delete_btn"><span class="fas fa-trash"></span></button>
                                        </form>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
            </div>
        </div>


        {{$products->links()}}


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
