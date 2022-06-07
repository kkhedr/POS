@extends('admin.app')

@section('content_header')

<style>
    .styled {
        background-color: #b785cc;
  color: #000
}
</style>

@endsection
@section('content')

<br><br>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">إضافة منتجات</h3>
            <a href="/product" class="btn btn-success float-right">عرض المنتجات</a>
        </div>
        <!-- /.card-header -->
        <form method="post"  enctype="multipart/form-data">
            @csrf
            @method('post')

            @include('admin.partials._errors')

            {{--name--}}
            <div class="card-body">
            <div class="row">

<div class="col-md-6">
    <br>
    <div class="form-group">
        <label>اختر مورد  </label>
        <select name="sup_id" required class="form-control select2" style="width: 100%;">
            <option value=''> إختر مورد ...</option>
            @foreach($sups as $sup)
                <option value="{{$sup->id}}">{{$sup->name}}</option>
            @endforeach
        </select>
    </div>
</div>



<div class="col-md-6">
    <br>
    <label>الثمن المدفوع   </label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
        </div>
        <input type="number" required name="price_sup_paid" value="" placeholder=" الثمن الدفوع" class="form-control" step="0.01">
    </div>
</div>



</div>

                <div class="form_content row">
                   
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-shopping-bag"></i></span>
                            </div>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="إسم المنتج" data-inputmask="'alias': 'ip'" data-mask >
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Upload image input-->
                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                            <input id="upload" type="file" required name="image" onchange="" class="image form-control border-0">
                            <label id="upload-label" for="upload" class="font-weight-bold  text-muted">صورة المنتج</label>
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
                            <select name="category_id" required class="form-control select2" style="width: 100%;">
                                <option value=''> إختر فئة ...</option>
                                @foreach($catgeories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>

                    

                    <div class="col-md-3">
                        <br>
                        <label>سعر المنتج</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" name="price" value="" placeholder="سعر المنتج" class="form-control" step="0.01">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <br>
                        <label>سعر الشراء</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            </div>
                            <input type="number" name="price_buy" value="" placeholder="سعر الشراء" class="form-control" step="0.01">
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
                    <!-- /.col -->

                </div>
                <!-- /.row -->
            </div>
        </form>

        <!-- /.card-body -->
        <div class="card-footer">

        </div>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-color/2.1.2/jquery.color.min.js"></script>
    <script>
        let color_content = []
        let indexs = [];
        let index = 0;
        let index_content = 0;
        $(document).ready(function (){

            $(document).delegate('.color_remove_click','click',function () {
                var div_index = $(this).attr('data-index');
                $(`#colors_conent_num${div_index}`).remove();
                $(`#colors_amount_num${div_index}`).remove();
                $(`#color_remove_click${div_index}`).remove();

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

<div class="col-md-3" id="colors_amount_num${index}">
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
                            <button  class="add_product btn btn-success" > إضافة المنتج </button>
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
                            <button  class="add_product btn btn-success" > إضافة المنتج </button>
                        </div>
 </div>

             `);

             index++;
         });


        });
       

        
        $(document).delegate('.add_product','click',function(event){
            event.preventDefault();  
           
         
            $(this).delay(10000).css({
    'background-color': 'red',
  });

  $(this).html(' .... يتم إضافة المنتج');
  var form_data = $('form').serializeArray();
  
  var formData = new FormData(this.form);
console.log(formData);

 
            $.ajax({
                 url: '/product',
                 type: 'post',
                 dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                timeout: 5000,
                 success: function(data) {

                   console.log(data);
                   $('.add_product').css({
    'background-color': '#013220'});  
    $('.add_product').html(' إضافة المنتج ');

  new Noty({
            type: 'success',
            layout: 'topRight',
            text: "تم إضافة المنتج",
            timeout: 2000,
            killer: true
        }).show();
                 }
             });

  

  
       
    
        });

       


    </script>

@endsection
