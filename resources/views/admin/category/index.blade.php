@extends('admin.app')

@section('content_header')




@endsection
@section('content')

<br><br>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">عرض الفئات</h3>
            <a href="/category/create" class="btn btn-success float-right">إضافة فئات</a>
        </div>
        <!-- /.card-header -->
      <div class="card-body">
          <div class="col-md-12">
              <table id="data_table_show" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                      <th>رقم الفئة</th>
                      <th>إسم الفئة</th>
                      <th>صورة الفئة</th>
                      <th>المنتجات</th>
                      <th> عدد المنتجات</th>
                      <th> السعر </th>
                      <th>تعديل / مسح</th>
                  </tr>
                  </thead>
                  <tbody id="category_show">
                  @foreach($categories as $index=>$category)
                      <tr>
                          <td>{{$category->id}}</td>
                          <td>{{$category->name}}</td>
                          <td><img style="width: 100px;height: 100px" src="{{$category->image_path}}"></td>
                         
                          <td>
                              <!-- <a class="products_content btn btn-danger" data-id="{{$category->id}}" data-toggle="categorymodal" data-target="#examplecategorymodalLong{{$category->id}}" id="category_num_{{$category->id}}">المنتجات</a> -->
                          <!-- Button trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleProduct{{$category->id}}">
  المنتجات
</button>

<!-- Modal -->
<div class="modal fade" id="exampleProduct{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$category->id}}" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">عرض المنتجات </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="max-height: 77vh;overflow-y: auto;"  class="modal-body">

      <table id="" style="width:100%;color:black" class="display table table-hover text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th style="border-radius:0px 30px 30px 0px;"> الرقم</th>
                                <th> الأسم</th>
                                <th> سعر البيع</th>
                               
                                <th style="border-radius:30px 0px 0px 30px;">مؤثرات</th>
                            </tr>
                            </thead>
                            <tbody id="products_show">
                                
                                @foreach($category->products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>

                                      <!-- Modal -->
                              <div class="modal modal{{$product->id}} fade" id="exampleeditModalLong{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-xl" role="document">
                                      <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                             

                                          <form id="product_form" method="post" action="{{route('product.update',$product->id)}}" enctype="multipart/form-data">
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
                                                                                @foreach($categories as $category_once)
                                                                                    @if($category_once->id == $product->category->id)
                                                                                        <option value="{{$product->category->id}}" selected="selected"> {{$product->category->name}}</option>
                                                                                    @endif
                                                                                    @if($category_once->id != $product->category->id)
                                                                                        <option value="{{$category_once->id}}">{{$category_once->name}}</option>
                                                                                    @endif

                                                                                @endforeach

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    

                                                                    <div class="col-md-6">
                                                                        <br>
                                                                        <label id="product_price" for="" class="">سعر المنتج </label>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                            </div>
                                                                            <input type="number" name="price" value="{{$product->price}}" class="form-control" >
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <br><br>
                                                                        <div class="input-group" style="display: flex;justify-content: center;align-items: center;">
                                                                            <input id="add_color"  type="button" value="إضافة لون" class="btn btn-danger" >
                                                                        </div>
                                                                    </div>

                                                                    @foreach($product->options as $option)
                                                                        <div class="col-md-2" id="color_remove_click{{$option->id}}">
                                                                            <a class="color_remove_click" data-index="{{$option->id}}" style="font-size: 50px;background-color:white;color:black;border-radius:50%">×</a>
                                                                        </div>
                                                                        <div class="col-md-4" id="colors_conent_num{{$option->id}}">
                                                                            <label id="product_price" for="" class=""> اللون </label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                                                </div>
                                                                                <input type="text" style="width: 20.499999995%;" name="color[]" required value="{{$option->color}}" class="form-control" >
                                                                            </div>
                                                                        </div>

                                                                       
                                                                        
                                                                       <div class="colors col-md-3" id="colors_amount_num{{$option->id}}">
                                                                            <label id="product_stock" for="" class=""> تعديل الكمية</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>
                                                                                </div>
                                                                                <input type="number" name="stock[]" required value="{{$option->stock}}" class="form-control" >
                                                                                <input type="hidden" name="stock_option_ids[]" value="{{$option->id}}" required class="form-control" >

                                                                            </div>
                                                                        </div>

                                                                        <div class="colors col-md-3" id="colors_amount_update{{$option->id}}">
                                                                            <label id="product_stock" for="" class=""> تحديث </label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>
                                                                                </div>
                                                                                <input type="number" name="stock_add[]" class="form-control" >
                                                                                <input type="hidden" name="stock_add_option_ids[]" value="{{$option->id}}" required class="form-control" >


                                                                            </div>
                                                                        </div>

                                                                        
                                                                       
                                                                        
                                                                @endforeach



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

                                    <form action="{{ route('product.destroy',$product->id) }}" method="POST">
                                            <a class="edit_btn" href="" data-toggle="modal" data-target="#exampleeditModalLong{{$product->id}}"><span class="fas fa-edit"></span></a>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
      </div>
    </div>
  </div>
</div>
                              
                            </td>
                          <td>
                          {{$category->products->count()}}

                          </td>

                          <td>  
                                    
                           <h2>
                           
                           {{$price_total[$index]}}
                           <h2>
                          
                          </td>

                         
                          <td>

                              <!-- Modal -->
                              <div class="modal fade" id="exampleModalLong{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                      <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                              <form method="post" action="{{route('category.update',$category->id)}}" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('PUT')

                                                  @include('admin.partials._errors')

                                                  {{--name--}}
                                                  <div class="card-body">
                                                      <div class="row">
                                                          <div class="col-md-12">
                                                              <div class="input-group">
                                                                  <div class="input-group-prepend">
                                                                      <span class="input-group-text"><i class="fas fa-shopping-bag"></i></span>
                                                                  </div>
                                                                  <input type="text" name="name" value="{{$category->name}}" class="form-control" data-inputmask="'alias': 'ip'" data-mask >
                                                              </div>
                                                          </div>
                                                          <br><br>

                                                          <div class="col-md-12">
                                                              <!-- Upload image input-->
                                                              <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                                                  <input id="upload" type="file" name="image" onchange="" class="image form-control border-0">
                                                                  <label id="upload-label" for="upload" class="font-weight-bold  text-muted">صورة الفئة</label>
                                                                  <div class="input-group-append">
                                                                      <label for="upload" id="upload_shape" class="btn btn-success rounded-pill mr-2"> <small class="text-uppercase">صورة الفئة</small></label>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group">
                                                                  <img src="" style="display:none;width: 250px;height: 100px" class="image-preview">
                                                              </div>

                                                          </div>

                                                          <div class="col-md-4">
                                                              <div class="input-group">
                                                                  <div class="input-group-prepend">
                                                                      <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                                                  </div>
                                                                  <input type="submit" value="تعديل" class="btn btn-success">
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

                           


                              <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                  <a class="btn btn-primary" href="" data-toggle="modal" data-target="#exampleModalLong{{$category->id}}">تعديل</a>
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="delete btn btn-danger">مسح</button>
                              </form>
                      </tr>

                      
                  @endforeach


                  </tbody>
              </table>
          </div>
      </div>


    </div>

   
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" defer>

$(document).ready(function (){
           
    
    let color_content = [];
let indexs = [];
let index = 0;
    
$(document).delegate('.color_remove_click','click',function () {
                var div_index = $(this).attr('data-index');
                    $(`#colors_conent_num${div_index}`).remove();
                    $(`#colors_amount_num${div_index}`).remove();
                    $(`#color_remove_click${div_index}`).remove();
                    $(`#colors_amount_update${div_index}`).remove();
            });

            $(document).delegate('#add_color','click',function (){
                $('.submit_op').remove();
                $('#product_form .form_content').append(`
<div class="col-md-2" id="color_remove_click${index}">
<a href="#" class="color_remove_click" data-index="${index}" style="font-size: 50px;background-color:white;color:black;border-radius:50%">×</a>
</div>
<div class="col-md-5" id="colors_conent_num${index}">
 <label id="product_price" for="" class="">اللون </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="text" name="color_new[]" required value="" class="form-control" >
                        </div>
</div>


<div class="col-md-5" id="colors_amount_num${index}">
        <label id="product_stock" for="" class=""> الكمية</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-sort-amount-down"></i></span>
                            </div>
                            <input type="number" name="stock_new[]" required value="" class="form-control" >

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
                            <input  type="submit" value="تعديل المنتج" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
 </div>

             `);
            });

            if($('.colors').length){
                $('.form_content').append(`
 <div class="submit_op col-md-12">
                <br><br>
                        <div class="input-group" style="display: flex;justify-content: center;align-items: center;">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input  type="submit" value="تعديل المنتج" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
 </div>

             `);
            }
            index++;
        
   

});



</script>



@endsection
