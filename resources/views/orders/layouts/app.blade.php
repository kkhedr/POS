<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IBAG</title>

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
                            <li><i class="fa fa-envelope"></i> IBag@gmail.com</li>
                            <li></li>
                        </ul>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">

                        <div class="header__top__right__social">
                            <form id="submit_order">
                            <ul style="list-style: none;text-decoration: none">
                                <li class="has-dropdown">

                                    <a class="shop_cart" id="shopping_cart"><i style="font-size: 35px" class="fa fa-cart-arrow-down"></i>
                                        <span class="total-item-round"></span></a>

                                    <!--====== Dropdown ======-->
                                    <span class="js-menu-toggle"></span>
                                    <div class="mini-cart">
                                        <div class="text-center" style="background-color: #0D0A0A;color: #8e0814;width: 100%" id="order_num"></div>

                                        <!--====== Mini Product Container ======-->
                                        <div class="mini-product-container gl-scroll u-s-m-b-15">

                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 u-s-m-b-30">
                                                        <div class="table-responsive">
                                                            <table class="table-p">
                                                                <thead>
                                                                <th style="float: left">تفاصيل المنتج</th>

                                                                <th>الكمية</th>
                                                                <th>سعر المنتج</th>
                                                                </thead>
                                                                <tbody id="table_body" class="table_content">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="">
                                                            <input type="submit" id="btn_create_order" class="btn_create_order_table btn btn-dark " value="تأكيد الأوردر">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--====== End - Mini Product Container ======-->
                                        <!--====== Mini Product Statistics ======-->
                                        <div class="mini-product-stat">
                                        <!--====== End - Mini Product Statistics ======-->
                                     </div>
                                    <!--====== End - Dropdown ======-->
                                    </div>

                                </li>

                            </ul>
                            </form>
                        </div>
                        <div class="header__top__right__auth">
                            <a href="/main"><i class="fa fa-user"></i> تسجيل الدخول</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="top_body">
    
        <div class="container">
            <div class="row">
            <div class="col-lg-3">
            <input type="submit" id="btn_create_order" class="btn btn-dark " value="تأكيد الأوردر">

          </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="/"><img src="{{asset('logo/logo.jpg')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <br><br>
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="/" method="get">
                                @csrf
                                <input type="text" name="search" placeholder="إسم المنتج أو رقمه؟">
                                <button type="submit" class="btn btn-dark">بحث</button>
                            </form>
                        </div>

                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>

    </div>
</header>
<!-- Header Section End -->

<div class="body_content" style="background-color: rgba(5, 4, 9, 0.84);color: #ffffff; height: 100%">

    <!-- Hero Section Begin -->
    <section class="hero" >
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>الفئات</span>
                        </div>
                        <ul>
                            @foreach($categories as $catgeory)
                                <li><a href="/?category_id={{$catgeory->id}}">{{$catgeory->name}}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">

                    <!-- Featured Section Begin -->
                    <section class="featured spad" style="padding: 10px">
                        <div class="container">

                            <div class="row featured__filter">
                                @foreach($products as $product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 mix" style="padding: 10px">
                                        <div class="product_item card" id="product_item_{{$product->id}}">
                                            <input name="discounts[]" id="dicount_input_{{$product->id}}" class="dicount_input" type ="number" placeholder = "ضع خصم على المنتج" />
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
                                                            <div class="col-md-6">
                                                                <input type="number" id="colors_amounts_{{$product->id}}[]" value="" placeholder="الكمية" style="width: 100px;border: 1px solid red;background-color: #dccece;" name="colors_amounts[]">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <strong class="float-right">{{$option->color}}</strong>
                                                                <input type="hidden" name="colors_names[]" id="colors_names_{{$product->id}}[]" value="{{$option->id}}">
                                                            </div>
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
                                            <div> {{$products->links()}}</div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Featured Section End -->

                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->


    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> كل الحقوق محفوظة <i class="fa fa-heart" aria-hidden="true"></i> by <a style="color: #ffffff" href="/">IBAG</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

</div>


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

        $(".btn_create_order_table").css('display','none');
        $(".top_body #btn_create_order").css('display','none');
        $('.header__top__right__social .mini-cart').css('display','none');
        $(".dicount_input").css('display','none');

        $('.remove_cart').on('click',function (){
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

                    console.log(response);

                    if(response[1] == 1){
                        $(".top_body #btn_create_order").css('display','none');
                        $(".btn_create_order_table").css('display','none');
                        $('.mini-cart').css('display','none');
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
                    $('tr').remove();
                     $('#order_num').empty();
                     $('.mini-cart').css('display','none');
                     $(".btn_create_order_table").css('display','none');
                     $(".top_body #btn_create_order").css('display','none');

                     $('.remove_cart').css('display','none');
                     $('.dicount_input').css('display','none');
                    $('.product_item').css('background-color','');

                    $('.option_btn_parent').css('display','block');
                    $('.options_content').css('display','none');
            
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

        $(document).delegate('.featured__filter .card-footer .options_content div .product_btn','click',function(){
            var product_id = $(this).attr('data-product_id');
            var option_parent = $(this).closest('.card-footer').find('.options_content');
            var options_id = option_parent.find("input[name='colors_names[]']")
                .map(function(){return $(this).val();}).get();
            var amounts = option_parent.find("input[name='colors_amounts[]']")
                .map(function(){return $(this).val();}).get();
            var product_price =option_parent.find('#colors_price').val();

            var discounts = option_parent.find("input[name='discounts[]']")
                .map(function(){return $(this).val();}).get();
            
            var amounts = amounts.filter(function (el) {
            if(el == ''){
                var index = amounts.indexOf(el);
                options_id.splice(index, 1); 
            }
            return el != '';
            });

            console.log(options_id);
            console.log(amounts);

            $.ajaxSetup({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
                        option_content += `<li style="display: block">`;
                        option_content +=`<label>${option[0]}</label>`;
                        product_color_amount_price +=option[0]+':';
                        product_color_amount_price +=option[1]+',';
                        option_content += '</li>';
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
                          `;amount_content

                        option_price +=`
                          <div id="price_content">
                        <label id="product_price" for="" class=""></label>
                        <div class="input-group">
                            <div>
                                <input style="display: inline;" name="price_value[]" class="price input-counter__text input-counter--text-primary-style_price" value="${price_total}" disabled type="number">
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
                                                                               <label class="text-center" style="color: #8e0814;background-color: #0D0A0A;width: 100%">${response[0].product.name}</label>
                                                                                <img class="u-img-fluid" style="width: 100px;height: 100px" src="${response[0].product.image_path}" alt=""></div>
                                                                            <div class="table-p__info">
                                                                                <ul class="table-p__variant-list">

                                                                                  ${option_content}
                                                                                </ul>
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
                            option_content += `<li style="display: block">`;
                            option_content +=`<label>${option[0]}</label>`;
                            product_color_amount_price +=option[0]+':';
                            product_color_amount_price +=option[1]+',';
                            option_content += '</li>';
                            // option_content +=`</div>`
                            let price_total = option[1] * option[2];
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

                        $('.table_content').append( `
                               <!--====== Row ======-->
                                <tr id="product_num_${val[2].product_content[0].id}">
<input type="hidden" name="product_ids[]" value="${val[2].product_content[0].id}">
<input type="hidden" name="product_color_amount_price[]" value="${product_color_amount_price}">


 <td>
                                        <div class="table-p__box">
                                            <div class="table-p__img-wrap">
                                                <label class="text-center" style="color: #8e0814;background-color: #0D0A0A;width: 100%">${val[2].product_content[0].name}</label>
                                                <img class="u-img-fluid" style="width: 100px;height: 100px" src="${val[2].product_content[0].image_path}" alt=""></div>
                                            <div class="table-p__info">
                                                <ul class="table-p__variant-list">
                                                        ${option_content}
                                                </ul>
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

        $(document).delegate('form #amount_content .amount_value_alone','change',function(){
               
            var currentdiv=$(this).closest('#amount_content');
            var color_name = currentdiv.find('.color_name_alone').val();
            var product_id_value = currentdiv.find('.product_id_alone').val();
            
            alert(product_id_value);

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
