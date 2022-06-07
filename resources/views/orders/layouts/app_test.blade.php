<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ladies Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('user/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('user/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('user/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('user/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('user/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('user/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('user/css/style.css')}}" type="text/css">

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('plugins/noty/noty.css') }}">
    <script src="{{ asset('plugins/noty/noty.min.js') }}"></script>

    <!--====== App ======-->
    <link rel="stylesheet" href="{{asset('cart/css/app.css')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .featured .featured__item_content {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333333;
            width: 100px;
        }

        .featured .featured__item_content li a {
            color: white;
            text-align: center;
            text-decoration: none;
        }

        .featured .featured__item_content .product a:hover {
            background-color: #111111;
        }

    </style>

</head>

<style>
    .loader {
        width: 100px;
        height: 100px;
        position: absolute;
        top:0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        z-index: 9999;
    }
</style>
<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<!-- Humberger Begin -->
<div class="humberger__ظmenu__overlay"></div>
<div class="humberger__menu__wrapper">

    <div class="humberger__menu__widget">

        <div class="header__top__right__auth">
            <a href="#"><i class="fa fa-user"></i> Login</a>
        </div>
    </div>

    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>

</div>
<!-- Humberger End -->

<!-- Header Section Begin -->



<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li>
                        <a href="/"><img style="border-radius: 50%;width:35px;height:35px" src="{{asset('logo/logo.jpeg')}}" alt=""></a>
                            </li>
                            <li>
                            <div class="modal fade" id="exampleModalOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalOrderTitle" aria-hidden="true">
                                            <div style="overflow-y: initial;" class="modal-dialog modal-xl" role="document">
                                                <div style=" background-color: rgb(9,4,8);color: #ffffff" class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalOrderTitle"></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div style="max-height: 77vh;overflow-y: auto;" class="modal-body">

                        <table dir="rtl" id="" class="table-responsive table table-hover text-center">
                        <thead class="thead-dark">
                        <tr>
                            <th style="border-radius:0px 30px 30px 0px;" scope="col">رقم الأوردر</th>
                            <th>رقم المنتج</th>
                            <th>إسم المنتج</th>
                            <th>ألوان المنتج</th>
                            <th>الكمية</th>
                            <th>الكمية المتبقية</th>
                            <th>السعر</th>
                            <th>سعر البيع </th>
                            <th> التاريخ </th>
                            <th style="border-radius:30px 0px 0px 30px;" scope="col">إسترجاع</th>
                        </tr>
                        </thead>
                        <tbody id="orders_show">


                        </tbody>
                    </table>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> إغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a href="#" class="btn_modal_check btn btn-danger">الأوردرات اليومية</a>


                            </li>
                        </ul>
                    </div>

                </div>

                

                <div class="col-lg-3 col-md-3">

                <div class="hero__search__phone">
                            <!-- <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text" >
                            <h5 style="color:white">+65 11.188.888</h5>
                            </div> -->
              </div>
                </div>


                <div class="col-lg-3 col-md-3">
                    <div class="header__top__right">

                        <div class="header__top__right__social">

                        </div>
                        <div class="header__top__right__auth">
                            <a href="/login" target="_blank"><i class="fa fa-user"></i> تسجيل الدخول</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="top_body">

        <div class="container">
            <!-- <div class="row">
            <div class="col-lg-3">
            <input type="submit" id="btn_create_order" class="btn btn-dark " value="تأكيد الأوردر">

          </div>
            </div> -->


  <!-- Hero Section Begin -->
  <section class="hero" >
        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <!-- Featured Section Begin -->
                    <section class="featured spad" style="padding: 10px">
                        <div class="container">

                        <div style="margin-bottom : 0" class="hero__search">

                        <div class="hero__search__form">
                            <form id="form_search" action="/" method="get">
                                @csrf


            <input id="value_search"  type="hidden" name="value_search" >
            <input id="key_search"  type="hidden" name="key_search" >


                                <ul>
<li  style="display:inline-block">
<input id="product_name_search" data-search_key = "1" type="text" name="product_name" placeholder="إسم المنتج">

</li>
<li  style="display:inline-block">
<input id="category_name_search" data-search_key = "2" type="text" name="category_name" placeholder="إسم الفئة">

</li>
<li style="display:inline-block">
<input id="price_search" data-search_key = "3" type="number" name="price" placeholder="سعر المنتج">

</li>
                                </ul>

                            </form>
                        </div>

                    </div>

                            <div class="row featured__filter" style="height:100%">
                                @foreach($products as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mix" style="padding: 10px">
                                        <div class="product_item card" id="product_item_{{$product->id}}">
                                            <input name="discount" data-discount_old="{{$product->discount}}" id="dicount_input_{{$product->id}}" class="dicount_input" type ="hidden" placeholder = "ضع خصم على المنتج" />
                                            <div class="product_img card-header">
                                                <span class="remove_cart" id="remove_cart_{{$product->id}}" style="font-size: 20px;color: white;float: right;display: none"><a href="#" data-product_id="{{$product->id}}">×</a></span>
                                                <img class="img-thumbnail" style="width: 300px;height: 80px" src="{{$product->image_path}}">
                                            </div>
                                            <div class="card-body" style="width: 100%; padding: 0rem">
                                                <div class="row row--flex" style="display: flex;flex-wrap: wrap;">
                                                        <div class="col-md-12 text-center">
                                                            <strong style="color: #0D0A0A">{{$product->name}} - </strong>
                                                            <strong style="color: #0D0A0A">{{$product->price.'جنيه '}}</strong>
                                                        </div>
                                                </div>

                                            </div>
                                            <div class="card-footer" style=" padding: 0rem;color: #0D0A0A">
                                                <div class="option_btn_parent row" id="option_btn_{{$product->id}}" style="margin-top: 1px;color: #0D0A0A">
                                                    <div class="col-md-12">
                                                        <div class="option_btn" style="width: 100%"><a style="width: 100%" class="option_btn btn btn-danger">الألوان</a></div>
                                                    </div>
                                                </div>
                                                <div class="options_content" id="option_content_{{$product->id}}" >
                                                    <input type="hidden" name="colors_price" id="colors_price" value="{{$product->price}}">
                                                    <div class="row" style="margin-top: 1px;color: #0D0A0A">
                                                        @foreach($product->options as $option)
                                                        @if($option->size == null)
                                                            <div class="col-md-6">
                                                                <input type="number" id="colors_amounts_{{$product->id}}[]" value="" placeholder="الكمية" style="width: 73px;border: 1px solid red;background-color: #dccece;" name="colors_amounts[]">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong style="font-size: 13px;" class="float-right">{{$option->color}}</strong>
                                                                <input type="hidden" name="colors_names[]" id="colors_names_{{$product->id}}[]" value="{{$option->id}}">
                                                            </div>
                                                            @else
                                                            <div class="col-md-4">
                                                                <input type="number" id="colors_amounts_{{$product->id}}[]" value="" placeholder="الكمية" style="width: 73px;border: 1px solid red;background-color: #dccece;" name="colors_amounts[]">
                                                            </div>
                                                            <div class="col-md-4">
                                                            <strong style="font-size: 12px;" class="float-right">{{$option->size}}</strong>

                                                        </div>
                                                            <div class="col-md-4">
                                                                <strong style="font-size: 13px;" class="float-right">{{$option->color}}</strong>
                                                                <input type="hidden" name="colors_names[]" id="colors_names_{{$product->id}}[]" value="{{$option->id}}">
                                                            </div>

                                                            
                                                            @endif
                        
                                                        @endforeach
                                                    </div>

                                                    <div class="row" style="margin-top: 1px;color: #0D0A0A">
                                                        <div class="col-md-12">
                                                            <div class="product_btn" style="width: 100%" data-product_id="{{$product->id}}" data-product_name="{{$product->name}}"><a style="width: 100%" class=" btn btn-danger">إضافة إلى السلة</a></div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div> {{$products->links('pagination::default')}}</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Featured Section End -->

                </div>
                <div class="col-lg-4">
                    <div style="width: 368px;" class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>المنتجات المباعة</span>
                        </div>
                        <!-- <ul>
                            @foreach($categories as $catgeory)
                                <li><a href="/?category_id={{$catgeory->id}}">{{$catgeory->name}}</a></li>
                            @endforeach

                        </ul> -->


                        <form id="submit_order">

                                   <div class="text-center" style="background-color: #0D0A0A;color: #8e0814;width: 100%" id="order_num"></div>

                                   <!--====== Mini Product Container ======-->
                                   <div class="mini-product-container gl-scroll u-s-m-b-15">
                                   
                                   <div class="container">
                                           <div class="row">
                                               <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                                   <div class="table-responsive">
                                                       <table class="table-p">
                                                           <thead>
                                                           <th style="font-size : 17px;">تفاصيل </th>

                                                           <th style="font-size : 17px;">الكمية</th>


                                                           <th style="font-size : 17px;">سعر المنتج</th>
                                                           </thead>
                                                           <tbody id="table_body" class="table_content">



                                                           </tbody>
                                                       </table>

                                                   </div>
                                               </div>
                                               <ul style="margin-top:10px;background-color: #8e0814;border:none;text-decoration:none;list-style-type: style none;width:100%;text-align:center">

                                                   <li style="display:inline-block">
                                                           <input name="discount_value" style="border-radius:50px;width:180px;text-align:center" id="discount_input_value" class="discount_input_value" type ="number" placeholder = "الخصم" step="0.01"/>

                                                           </li>


                                                   <li style="display:inline-block">
                                                               <h4 style="color:white">السعر الكلى : <strong style="font-size:25px" class="total_price_order"></strong></h2>
                                                           </li>
                                                           <input name="total_price_value_total" style="border-radius:50px;width:180px;text-align:center" id="total_price_value_total" class="total_price_value_total" type ="hidden" />


                                                           <li style="display:inline">
                                                   <input name="phone" placeholder="الموبيل" style="border-radius:50px;width:180px;text-align:center" id="phone" class="phone" type ="number" />

                                                           </li>

                                                           <li class="cust_name" id="cust_name" style="display:inline">
                                                   <input name="name" placeholder="إسم العميل" style="border-radius:50px;width:100%;text-align:center" id="cust_name_input" class="cust_name_input" type ="text" />

                                                           </li>

                                                     </ul>

                                                     <ul style="margin-top:10px;background-color: #FFC0CB;border:none;text-decoration:none;list-style-type: style none;width:100%;text-align:center;color:black">
                                                    <li style="display:inline-block; width:50%">  <input checked id="order_type" class="order_type" type="radio" name="order_type" value="0">
  <label for="cash">كاش</label>
 
                                                    <li style="display:inline-block;  width:50%">
                                                    <input type="radio" id="order_type" class="order_type"  name="order_type" value="1">
  <label for="online">أونلاين</label</li>
                                                    </li>

                                                    <li style="display:inline">
                                                   <input name="address" placeholder="عنوان العميل" style="border-radius:50px;width:100%;text-align:center" id="address_input" class="address_input" type ="text" />

                                                           </li>
                                                </ul>



                                               <div class="col-md-12">
                                               <div class="">
                                                       <input type="submit" id="btn_create_order" class="btn_create_order_table btn btn-dark " value="تأكيد الأوردر">

                                                   </div>
                                               </div>
                                           </div>

                                   </div>
                                   <!--====== End - Mini Product Container ======-->
                                   <!--====== Mini Product Statistics ======-->
</div>


                       </form>
</div>









                </div>

            </div>


        </div>



    </section>
    <!-- Hero Section End -->

        </div>

    </div>
</header>
<!-- Header Section End -->

  <!-- Footer Section Begin -->

    <!-- Footer Section End -->

<!-- Js Plugins -->
<script src="{{asset('user/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('user/js/bootstrap.min.js')}}"></script>
<script src="{{asset('user/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('user/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('user/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('user/js/mixitup.min.js')}}"></script>
<script src="{{asset('user/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('user/js/main.js')}}"></script>
<script src="{{asset('cart/js/app.js')}}"></script>


<script type="text/javascript">

    $(document).ready(function(){

        $('.cust_name_input').css('display','none');
        $('.address_input').css('display','none');

        $(".btn_create_order_table").css('display','none');
        $(".top_body #btn_create_order").css('display','none');
        $('.mini-product-container').css('display','none');
        $(".dicount_input").css('display','none');

        $('#submit_order #discount_input_value').on('keyup',function(){
        var discount = $(this).val();
        var total_price_old = parseFloat($('#submit_order #total_price_value_total').val());
        var new_price_total_after_discount = total_price_old - discount;
        $('.total_price_order').text(new_price_total_after_discount);
      });



      $(document).delegate('table .remove_cart_table','click',function (){
           var currentdiv=$(this).closest('td');
           let product_id = currentdiv.find('.remove_cart_table a').attr('data-product_id');

           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({    //create an ajax request to display.php
                type: "DELETE",
                url: "/"+product_id,
                dataType: "json",   //expect html to be returned
                success: function (response) {
                    
                   var old_price = $('#submit_order #total_price_value_total').val()
                var new_price = 0;
                new_price = old_price - response[2];
                var discount_value = $('#submit_order #discount_input_value').val();
                if(discount_value == 0 || discount_value > 0 ||  discount_value < 0){
                    new_price = new_price - discount_value;
                }
                $('#submit_order #total_price_value_total').val(new_price);
                $('.total_price_order').text(new_price);



                    if(response[1] == 1){
                        prices_values = [];
                        $('#order_num').empty();
                        $(".top_body #btn_create_order").css('display','none');
                        $(".btn_create_order_table").css('display','none');
                        $('.mini-product-container').css('display','none');
                        $(".dicount_input").css('display','none');

                        new Noty({
                            type: 'error',
                            layout: 'center',
                            theme    : 'nest',
                            text: "تم إلغاء الأوردر ",
                            timeout: 2000,
                            killer: true
                        }).show();

                    }
                    $('#product_num_'+product_id).remove();
                    $('#remove_cart_'+product_id).css('display','none');
                    $('#product_item_'+product_id).css('background-color','');
                    $("#dicount_input_"+product_id).css('display','none');

                    $('#option_btn_'+product_id).css('display','block');
                    $('#option_content_'+product_id).css('display','none');
                }
            });

        });


        $(document).delegate('.remove_cart','click',function (){
           var currentdiv=$(this).closest('.card-header');
           let product_id = currentdiv.find('.remove_cart a').attr('data-product_id');


           $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({    //create an ajax request to display.php
                type: "DELETE",
                url: "/"+product_id,
                dataType: "json",   //expect html to be returned
                success: function (response) {
                    
                   var old_price = $('#submit_order #total_price_value_total').val()
                var new_price = 0;
                new_price = old_price - response[2];
                var discount_value = $('#submit_order #discount_input_value').val();
                if(discount_value == 0 || discount_value > 0 ||  discount_value < 0){
                    new_price = new_price - discount_value;
                }
                $('#submit_order #total_price_value_total').val(new_price);
                $('.total_price_order').text(new_price);



                    if(response[1] == 1){
                        prices_values = [];
                        $('#order_num').empty();
                        $(".top_body #btn_create_order").css('display','none');
                        $(".btn_create_order_table").css('display','none');
                        $('.mini-product-container').css('display','none');
                        $(".dicount_input").css('display','none');

                        new Noty({
                            type: 'error',
                            layout: 'center',
                            theme    : 'nest',
                            text: "تم إلغاء الأوردر ",
                            timeout: 2000,
                            killer: true
                        }).show();

                    }
                    $('#product_num_'+product_id).remove();
                    $('#remove_cart_'+product_id).css('display','none');
                    $('#product_item_'+product_id).css('background-color','');
                    $("#dicount_input_"+product_id).css('display','none');

                    $('#option_btn_'+product_id).css('display','block');
                    $('#option_content_'+product_id).css('display','none');
                }
            });

        });



        $('.options_content').css('display','none');

        $('.option_btn').on('click',function (){
            var currentdiv=$(this).closest('.card-footer');
            currentdiv.find('.options_content').css('display','block');

            var currentdiv=$(this).closest('.product_item');
            currentdiv.find('.dicount_input').css('display','block');
        });

        $.ajax({
            url: '/check_order',
            type: 'get',
            dataType: 'json',
            success: function(data) {
                if(data == 1)
                {
                    $(".btn_create_order_table").css('display','block');
                    $(".top_body #btn_create_order").css('display','block');
                }

            }
        });

        // $('.top_body #btn_create_order').click( function(e) {
        //     e.preventDefault();
        //     var form_data = $('#submit_order').serializeArray();
        //     $.ajax({
        //         url: '/create_order',
        //         type: 'post',
        //         dataType: 'json',
        //         data: form_data,
        //         success: function(data) {
        //             $('tr').remove();
        //             $('#order_num').empty();
        //             $('.mini-cart').css('display','none');
        //             $("#btn_create_order").css('display','none');
        //             $(".top_body #btn_create_order").css('display','none');
        //
        //             new Noty({
        //                 type: 'information',
        //                 layout: 'topCenter',
        //                 theme    : 'nest',
        //                 text: "تم إنشاء الأوردر بنجاح شكرا لك",
        //                 timeout: 2000,
        //                 killer: true
        //             }).show();
        //         }
        //     });
        // });




        var prices_values = [];



        $('.btn_create_order_table , .top_body #btn_create_order').click( function(e) {
            e.preventDefault();
            var form_data = $('#submit_order').serializeArray();
            
            console.log(form_data);
             $.ajax({
                 url: '/create_order',
                 type: 'post',
                 dataType: 'json',
                data: form_data,
                 success: function(data) {
                    $('.mini-product-container tr').remove();
                     $('#order_num').empty();
                     $('.mini-product-container').css('display','none');
                     $(".btn_create_order_table").css('display','none');
                     $(".top_body #btn_create_order").css('display','none');

                     $('.remove_cart').css('display','none');
                     $('.dicount_input').css('display','none');
                    $('.product_item').css('background-color','');

                    $('.option_btn_parent').css('display','block');
                    $('.options_content').css('display','none');
                    prices_values = [];
                     new Noty({
                         type: 'information',
                         layout: 'topCenter',
                         theme    : 'nest',
                         text: "تم إنشاء الأوردر بنجاح شكرا لك",
                         timeout: 2000,
                         killer: true
                     }).show();
                 }
             });
        });


        $('#shopping_cart').click(function(){
            if($('.mini-cart').is(':visible')){
                $('.mini-cart').css('display','none');
            }else{
                $('.mini-cart').css('display','block');
            }

        });



        $('.total-item-round').css('display','none');


        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            function get_Noty(){
    var n = new Noty({
                text: "لا يجب الخصم يعدى المبلغ المحدد له",
                type: "error",
                layout: 'center',
                killer: true,
                buttons: [
                    Noty.button("موافق", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });
            n.show();
}


        $(document).delegate('.featured__filter .card-footer .options_content div .product_btn','click',function(){
            var product_id = $(this).attr('data-product_id');
            var option_parent = $(this).closest('.card-footer').find('.options_content');
            var options_id = option_parent.find("input[name='colors_names[]']")
                .map(function(){return $(this).val();}).get();
            var amounts = option_parent.find("input[name='colors_amounts[]']")
                .map(function(){return $(this).val();}).get();
            var product_price =option_parent.find('#colors_price').val();

            var indexes_removed = [];
           var indexes_not_removed = [];
           console.log(options_id);
            var amounts = amounts.filter(function (el,index) {
            if(el == ''){
                indexes_removed.push(index);
                options_id[index] = '';
            }
            return el != '';
            });

            var options_id = options_id.filter(function (el,index) {

            return el != '';
            });

            console.log(options_id);
            console.log(amounts);

            if (amounts.length === 0) {
                var n = new Noty({
                text: "يجب إختيار على الأقل لون واحد فقط",
                type: "error",
                layout: 'center',
                killer: true,
                buttons: [
                    Noty.button("موافق", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });
               return n.show();
               }

            $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var new_price = 0;

            $.each(amounts,function(index,amount){
                new_price = new_price + (product_price * amount);
            });

            prices_values.push(new_price);
            $.ajax({    //create an ajax request to display.php
                type: "POST",
                url: "/",
                data: {
                    product_id : product_id,
                    options_id : options_id,
                    amounts : amounts,
                    product_price : product_price
                },
                dataType: "json",   //expect html to be returned
                success: function (response) {
                    $('#remove_cart_'+product_id).css('display','block');
                    $('#product_item_'+product_id).css('background-color','red');
                    $('#dicount_input_'+product_id).css('display','none');
                    $('#option_btn_'+product_id).css('display','none');
                    $('#option_content_'+product_id).css('display','none');
                    $('.mini-product-container').css('display','block');

                    if(Number.isInteger(response[1]))
                    {
                        if($("#order_num strong").length)
                        {

                        }else{
                            $('#order_num').append(`
<input type="hidden" name="order_id" id="order_id" value="${response[1]}">
                    <strong>أوردر رقم ${response[1]}</strong>
                    `);
                        }

                    }

                    var option_content = '';
                    var option_amount = '';
                    var option_price = '';
                    product_color_amount_price = '';
                    jQuery.each(response[0].options,function(i , option){
                        // option_content +=`<div class='col-md-4'>`
                        option_content += ``;
                        option_content +=`<label>${option[0]}</label>`;
                        product_color_amount_price +=option[0]+':';
                        product_color_amount_price +=option[1]+',';
                        option_content += '';
                        // option_content +=`</div>`
                        let price_total = option[1] * option[2];
                        option_amount +=`
                           <div id="amount_content">
                        <label id="product_price" for="" class=""></label>
                        <div class="input-group">
                            <input style="display: inline;" name="amount_value[]" class="amount amount_value_alone input-counter__text input-counter--text-primary-style" type="number"  value="${option[1]}">
                            <input name="color_name_hidd" class="color_name_alone" type="hidden" value="${option[0]}">
                            <input name="product_id_hidd" class="product_id_alone" type="hidden" value="${response[3]}">

                        </div>
                    </div>
                          `;

                        option_price +=`
                          <div id="price_content">
                        <label id="product_price" for="" class=""></label>
                        <div class="input-group">
                            <div>
                                <input style="display: inline;" name="price_value[]" class="price input-counter__text input-counter--text-primary-style_price" value="${price_total}" disabled type="number" step="0.01">
                            </div>
                        </div>

                    </div>
                          `;
                    });
                    // option_content +=`</row></container>`
                    $('.table_content').append(`

                     <tr id="product_num_${response[3]}">
                     <input type="hidden" name="product_ids[]" value="${response[3]}">
<input type="hidden" name="product_color_amount_price[]" value="${product_color_amount_price}">

                                                                    <td>
                                                                        <div class="table-p__box">
                                                                            <div class="table-p__img-wrap">
                                                                            <span class="remove_cart_table" id="remove_cart_${response[3]}" style="color: white;background: none;position: absolute;right: 6px;font-size: 20px;top: -6px;"><a href="#" data-product_id="${response[3]}">×</a></span>

                                                                            <label class="text-center" style="color: #8e0814;background-color: #0D0A0A;width: 100%;margin-bottom: 0px">${response[0].product.price}</label>

                                                                               <img class="u-img-fluid" src="${response[0].product.image_path}" alt=""></div>
                                                                            <div class="table-p__info">


                                                                                  ${option_content}

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                   <td>
                                                                   ${option_amount}
                                                                    </td>
                                                                    <td>
                                                                    ${option_price}
                                                                    </td>


                                                                </tr>

                     `);

                     var price_total_order = 0;

                     $.each(prices_values,function(index,price){
                        price_total_order = price_total_order + price;
                     });

                     $('.total_price_order').text(price_total_order+'جنيه');
                     $('#submit_order #total_price_value_total').val(price_total_order);

                    new Noty({
                        type: 'information',
                        layout: 'center',
                        theme    : 'nest',
                        text: "تم إضافة المنتج إلى السلة ",
                        timeout: 2000,
                        killer: true
                    }).show();

                    $(".btn_create_order_table").css('display','block');
                    $(".top_body #btn_create_order").css('display','block');

                    // if(response[2] == 1)
                    // {
                    //     var options_current = [];
                    //     $(document).delegate('input:checkbox','change',function(){
                    //         var color_content = '';
                    //         if ($(this).is(':checked')) {
                    //             color_content =  $(this).attr('data-color');
                    //             var product_id_name_option_price = color_content.split(' ');
                    //             let count_option_current = 0;
                    //             jQuery.each(options_current,function (index , option_value) {
                    //                 if(option_value[1] == product_id_name_option_price[1] && option_value[0] == product_id_name_option_price[0]){
                    //                     count_option_current = 1;
                    //                 }
                    //             });
                    //
                    //             if(count_option_current == 0){
                    //                 options_current.push(product_id_name_option_price);
                    //
                    //                 console.log(options_current);
                    //
                    //                 var currentRow=$(this).closest('tr');
                    //                 var amount_td = currentRow.find('td:eq(1)');
                    //                 var price_td = currentRow.find('td:eq(2)');
                    //
                    //                 amount_td.append(`
                    //  <div id="amount_content">
                    //   <label id="product_price" for="" class="">${product_id_name_option_price[0]} </label>
                    //     <div class="input-group">
                    //          <input name="amount_value[]" class="amount input-counter__text input-counter--text-primary-style" type="number" value="">
                    //     </div>
                    //   </div>
                    //     `);
                    //                 price_td.append(`
                    //     <div id="price_content">
                    //     <label id="product_price" for="" class="">${product_id_name_option_price[0]} </label>
                    //     <div class="input-group">
                    //        <input name="price_value[]" class="price input-counter__text input-counter--text-primary-style" value="0" type="number">
                    //     </div>
                    //    </div>
                    //     `);
                    //
                    //             }
                    //
                    //         }
                    //
                    //
                    //     });
                    // }

                }
            });

        });

            $.ajax({    //create an ajax request to display.php
                type: "get",
                url: "/cart_check",
                dataType: "json",   //expect html to be returned
                success: function (response) {
                    console.log(response[0]);
                    if(Number.isInteger(response[1])){
                        $('#order_num').append(`
<input type="hidden" name="order_id" value="${response[1]}">
                    <strong>أوردر رقم ${response[1]}</strong>
                   `);
                    }

                    var product_ids = [];
                    var product_color_amount_price = '';
                    jQuery.each( response[0], function( i, val ) {
                        var option_content = '';
                        var option_amount = '';
                        var option_price = '';

                        jQuery.each(val[3].option,function(i , option){
                            option_content += ``;
                            option_content +=`<label>${option[0]}</label>`;
                            product_color_amount_price +=option[0]+':';
                            product_color_amount_price +=option[1]+',';
                            option_content += '';
                            // option_content +=`</div>`
                            let price_total = option[1] * option[2];

                            prices_values.push(price_total);

                            option_amount +=`
                           <div id="amount_content">
                        <label id="product_price" for="" class=""></label>
                        <div class="input-group">
                            <input style="display: inline;width = 50px" name="amount_value[]" class="amount amount_value_alone input-counter__text input-counter--text-primary-style" type="number"  value="${option[1]}">
                            <input name="color_name_hidd" class="color_name_alone" type="hidden" value="${option[0]}">
                            <input name="product_id_hidd" class="product_id_alone" type="hidden" value="${val[2].product_content[0].id}">
                        </div>
                    </div>
                          `;

                            option_price +=`
                          <div id="price_content">
                        <label id="product_price" for="" class=""></label>
                        <div class="input-group">
                            <div>
                                <input style="display: inline;width = 50px" name="price_value[]" class="price input-counter__text input-counter--text-primary-style_price" value="${price_total}" disabled type="number">

                            </div>
                        </div>

                    </div>
                          `;
                        });

                        $('#remove_cart_'+val[2].product_content[0].id).css('display','block');
                        $('#product_item_'+val[2].product_content[0].id).css('background-color','red');

                        $('#option_btn_'+val[2].product_content[0].id).css('display','none');
                        $('#option_content_'+val[2].product_content[0].id).css('display','none');
                        $(".top_body #btn_create_order").css('display','block');
                        $('.mini-product-container').css('display','block');

                        $('.table_content').append( `

                               <!--====== Row ======-->
                                <tr id="product_num_${val[2].product_content[0].id}">
<input type="hidden" name="product_ids[]" value="${val[2].product_content[0].id}">
<input type="hidden" name="product_color_amount_price[]" value="${product_color_amount_price}">

 <td>
                                        <div class="table-p__box">
                                            <div class="table-p__img-wrap">
                                            <span class="remove_cart_table" id="remove_cart_${val[2].product_content[0].id}" style="color: white;background: none;position: absolute;right: 6px;font-size: 20px;top: -6px;"><a href="#" data-product_id="${val[2].product_content[0].id}">×</a></span>

                                            <label class="text-center" style="color: #8e0814;background-color: #0D0A0A;width: 100%;margin-bottom: 0px">${val[2].product_content[0].price}</label>
                                                <img class="u-img-fluid" src="${val[2].product_content[0].image_path}" alt=""></div>
                                            <div class="table-p__info">

                                                        ${option_content}

                                            </div>
                                        </div>
                                    </td>

                                    <td>

                                  ${option_amount}
                                   </td>
                                    <td>
                                 ${option_price}
                                    </td>




                                </tr>
                                <!--====== End - Row ======-->


                               `);
                               product_color_amount_price = '';

                    });
                    var price_total_value_all = 0;
                    $.each(prices_values,function(index,price){
                        price_total_value_all = price_total_value_all + price;
                    });

                    $('.total_price_order').text(price_total_value_all+'جنيه');
                    $('#submit_order #total_price_value_total').val(price_total_value_all);


                    //product_ids.push(val[1].product_id);

                    //                    var duplicated_product_id = null;
                    //                    duplicated_product_id = duplicated_numbers(product_ids);
                    //                    const operation_status = [];
                    //                    console.log(response);
                    //                    jQuery.each( response, function( i, val ) {
                    //
                    //                        if(duplicated_product_id.indexOf(val[1].product_id) !== -1){
                    //                            if(operation_status.indexOf(val[1].product_id) == -1)
                    //                            {
                    //                                operation_status.push(val[1].product_id);
                    //                                var price = 0;
                    //                                var amount = 0;
                    //                                jQuery.each( response, function( i, subOrder ) {
                    //                                    if(subOrder[1].product_id == val[1].product_id){
                    //                                        price = price + 20;
                    //                                        amount = amount + 5;
                    //                                    }
                    //                                });
                    //
                    //
                    //                                $('.table_content').append(`
                    //
                    //                               <!--====== Row ======-->
                    //                                <tr>
                    //                                    <td>
                    //                                        <div class="table-p__box">
                    //                                            <div class="table-p__img-wrap">
                    //
                    //                                                <img class="u-img-fluid" src="${val[2].product_content[0].image_path}" alt=""></div>
                    //                                            <div class="table-p__info">
                    //                                                <ul class="table-p__variant-list">
                    //                                                        <span>Color:</span>
                    // <select name="color[]" id="color" class="form-control select2" style="width: 100%;" multiple>
                    //                            </select>
                    //                                                     </li>
                    //                                                </ul>
                    //                                            </div>
                    //                                        </div>
                    //                                    </td>
                    //                                    <td>
                    //
                    //                                      <input class="amount input-counter__text input-counter--text-primary-style" type="number" value="">
                    //                                   </td>
                    //                                    <td>
                    //                                        <div class="table-p__input-counter-wrap">
                    //
                    //                                            <!--====== Input Counter ======-->
                    //                                            <div class="input-counter">
                    //
                    //                                                <input class="price input-counter__text input-counter--text-primary-style" value="0" type="text" value="">
                    //
                    //                                            </div>
                    //                                            <!--====== End - Input Counter ======-->
                    //                                        </div>
                    //                                    </td>
                    //                                    <td>
                    //                                        <div class="table-p__del-wrap">
                    //
                    //                                            <a class="far fa-trash-alt table-p__delete-link" href="#"></a></div>
                    //                                    </td>
                    //                                </tr>
                    //                                <!--====== End - Row ======-->
                    //
                    //                               `);
                    //
                    //                                $('#color').append(`
                    //                                  <option  value="${val[3].option[1]}" >${val[3].option[0]} </option>
                    //                                `);
                    //
                    //                                var options = [];
                    //                                $('#color').change(function (){
                    //                                    var value = $(this).val();
                    //                                    value = parseInt(value);
                    //                                    options.push(value);
                    //                                    var price = 0;
                    //                                    var currentRow=$(this).closest('tr');
                    //                                    var td = currentRow.find('td:eq(2)');
                    //                                    td.find('.table-p__input-counter-wrap').remove();
                    //                                    jQuery.each(options,function (index , value_price){
                    //                                        price = price + value_price;
                    //                                    });
                    //                                    td.append(`
                    //                                        <div class="table-p__input-counter-wrap">
                    //
                    //                                            <!--====== Input Counter ======-->
                    //                                            <div class="input-counter">
                    //
                    //                                                <input class="price input-counter__text input-counter--text-primary-style" value="${price}" type="text">
                    //
                    //                                            </div>
                    //                                            <!--====== End - Input Counter ======-->
                    //                                        </div>
                    //                                    `);
                    //                                });
                    //                            }
                    //                        }else{
                    //                            $('.table_content').append(`
                    //
                    //                               <!--====== Row ======-->
                    //                                <tr>
                    //                                    <td>
                    //                                        <div class="table-p__box">
                    //                                            <div class="table-p__img-wrap">
                    //
                    //                                                <img class="u-img-fluid" src="${val[2].product_content[0].image_path}" alt=""></div>
                    //                                            <div class="table-p__info">
                    //                                                <ul class="table-p__variant-list">
                    //
                    // <span>Color:</span>
                    // <select name="color[]" id="color" class=" form-control select2" style="width: 100%;" multiple>
                    //                            </select>
                    //                                                    </li>
                    //                                                </ul>
                    //                                            </div>
                    //                                        </div>
                    //                                    </td>
                    //                                    <td>
                    //                                      <input class="amount input-counter__text input-counter--text-primary-style" type="number" value="20">
                    //                                    </td>
                    //                                    <td>
                    //                                        <div class="table-p__input-counter-wrap">
                    //
                    //                                            <!--====== Input Counter ======-->
                    //                                            <div class="input-counter">
                    //
                    //                                                <input class="price input-counter__text input-counter--text-primary-style" value="" type="number" value="5">
                    //
                    //                                            </div>
                    //                                            <!--====== End - Input Counter ======-->
                    //                                        </div>
                    //                                    </td>
                    //                                    <td>
                    //                                        <div class="table-p__del-wrap">
                    //
                    //                                            <a class="far fa-trash-alt table-p__delete-link" href="#"></a></div>
                    //                                    </td>
                    //                                </tr>
                    //                                <!--====== End - Row ======-->
                    //
                    //                               `);
                    //                            $('#color').append(`
                    //                                  <option  value="${val[3].option[1]}" >${val[3].option[0]}</option>
                    //                                `);
                    //
                    //                            $('#color').change(function (){
                    //                                var value = $(this).val();
                    //                                $(this).siblings('.price').val(value);
                    //                            });
                    //                        }
                    //                    });
                }
            });



        var options = [];
        $(document).delegate('input:checkbox','change',function(){
            var color_content = '';
            if ($(this).is(':checked')) {
                color_content =  $(this).attr('data-color');
                var product_id_name_option_price = color_content.split(' ');
                let count_option = 0;
                jQuery.each(options,function (index , option_value) {
                    if(option_value[1] == product_id_name_option_price[1] && option_value[0] == product_id_name_option_price[0]){
                        count_option = 1;
                    }
                });

                if(count_option == 0){
                    options.push(product_id_name_option_price);

                    var currentRow=$(this).closest('tr');
                    var amount_td = currentRow.find('td:eq(1)');
                    var price_td = currentRow.find('td:eq(2)');
                    //var remove_row = currentRow.find('td:eq(3)');


                    amount_td.append(`

                        `);
                    price_td.append(`


                        `);


                }

            }


        });

        });



        $(document).delegate('header .header__top__left ul li .btn_modal_check','click',function(e){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
            url: '/get_order_today',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
               $('#orders_show').html(data[1]);

               var price_total_content = "<tr style='background-color:#A9A9A9'>";
                price_total_content += "<td colspan='2'><h2 style='font-size:15px;font-weight:bold;color:black'> السعر المحصل الكلى :</h2></td>";
                price_total_content += `<td colspan='1'><h2 style='font-size:15px;font-weight:bold;color:black'> ${data[0]}</h2></td>`;
                price_total_content += "<td colspan='2'><h2 style='font-size:15px;font-weight:bold;color:black'>  قيمة الخصم الكلى :</h2></td>";
                price_total_content += `<td colspan='1'><h2 style='font-size:15px;font-weight:bold;color:black'> ${data[2]}</h2></td>`;
                price_total_content += "<td colspan='2'><h2 style='font-size:15px;font-weight:bold;color:black'>  قيمة الربح :</h2></td>";
                price_total_content += `<td colspan='1'><h2 style='font-size:15px;font-weight:bold;color:black'> ${data[3]}</h2></td>`;
                price_total_content += "</tr>";

               $('#orders_show').append(price_total_content);


               $('#exampleModalOrder').modal('show');
            }
        });


           });

           $(function(){
    //Yes! use keydown because some keys are fired only in this trigger,
    //such arrows keys
    $("body").keydown(function(e){
         //well so you need keep on mind that your browser use some keys
         //to call some function, so we'll prevent this
         //e.preventDefault();
         //now we caught the key code.
         var keyCode = e.keyCode || e.which;
          if(keyCode == 119){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
            url: '/get_order_today',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
               $('#orders_show').html(data[1]);

                var price_total_content = "<tr style='background-color:#A9A9A9'>";
                price_total_content += "<td colspan='2'><h2 style='font-size:15px;font-weight:bold;color:black'> السعر المحصل الكلى :</h2></td>";
                price_total_content += `<td colspan='1'><h2 style='font-size:15px;font-weight:bold;color:black'> ${data[0]}</h2></td>`;
                price_total_content += "<td colspan='2'><h2 style='font-size:15px;font-weight:bold;color:black'>  قيمة الخصم الكلى :</h2></td>";
                price_total_content += `<td colspan='1'><h2 style='font-size:15px;font-weight:bold;color:black'> ${data[2]}</h2></td>`;
                price_total_content += "<td colspan='2'><h2 style='font-size:15px;font-weight:bold;color:black'>  قيمة الربح :</h2></td>";
                price_total_content += `<td colspan='1'><h2 style='font-size:15px;font-weight:bold;color:black'> ${data[3]}</h2></td>`;
                price_total_content += "</tr>";

               $('#orders_show').append(price_total_content);


               $('#exampleModalOrder').modal('show');
            }
        });

          }

    });
});



        $(document).delegate('#price_search,#product_name_search,#category_name_search','keypress',function(e){
            var code = e.keyCode || e.which;
            if(code == 13){
               var value = $(this).val();
               var key = $(this).attr('data-search_key');
               var value_search = $('#value_search').val(value);
               var key_search = $('#key_search').val(key);
               console.log($('#form_search').serializeArray());
               if(value_search != null && key_search != null){
                   $('#form_search').submit();
               }
            }


           });

        $(document).delegate('form #amount_content .amount_value_alone','change',function(){

            var currentdiv=$(this).closest('#amount_content');
            var new_price = $(this).val();
            var color_name = currentdiv.find('.color_name_alone').val();
            var product_id_value = currentdiv.find('.product_id_alone').val();

            $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/set_price',
                type: 'post',
                dataType: 'json',
                data: {
                    new_price : new_price,
                    color_name : color_name,
                    product_id : product_id_value
                },
                 success: function(response) {
                    var discount = $('.discount_input_value').val(0);
                    $('.total_price_value_total').val(response)
        $('.total_price_order').text(response);
                 }
            });

        });
        

        $(document).delegate('.phone','keyup',function(e){
            var phone = $(this).val();
            phone = phone.toString();
            $.ajax({
            url: '/get_customer/'+phone,
            type: 'get',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if(data == 0){

    var n = new Noty({
                text: "هذا العميل لم يسجل من قبل",
                type: "error",
                layout: 'center',
                killer: true,
                buttons: [
                    Noty.button("موافق", 'btn btn-primary mr-2', function () {
                        n.close();
                    })
                ]
            });
            n.show();
                   
                  
               $('.cust_name_input').css('display','block');

            }
        }


        });
    });

    $(document).delegate('.order_type','change',function(e){
            var order_type = $(this).val();
           
                   if(order_type == 1){
                    
                    $('.address_input').css('display','block');
                   }else{
                       
                    $('.address_input').css('display','none');
                   }
  
       


        });

        

        $(document).delegate('.return_product','click',function(e){
           var trans_id = $(this).attr('data-transaction_id');
           

           $.ajax({
            url: '/return_product/'+trans_id,
            type: 'get',
            dataType: 'json',
            success: function(data) {
                  
               $('.return_product'+trans_id).html('تم إسترجاع المنتج');
               $('.return_product'+trans_id).css('background-color','red');
            
        }


        });
        });
    




    // $('.input-counter__minus').on('click',function (){
    //     var value = $(this).next().val();
    //     value = parseInt(value);
    //     alert(value);
    //     if(value > 0)
    //     {
    //         $(this).next().val(--value);
    //     }
    // });
    //
    // $('.input-counter__plus').on('click',function (){
    //     var value = $(this).prev().val();
    //     value = parseInt(value);
    //     $(this).prev().val(++value);
    // });



    // function duplicated_numbers(products){
    //     const toFindDuplicates = products => products.filter((item, index) => products.indexOf(item) !== index)
    //     const duplicateElementa = toFindDuplicates(products);
    //     return duplicateElementa;
    // }
</script>

</body>

</html>
