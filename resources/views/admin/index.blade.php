@extends('admin.app')

@section('content_header')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$categories_count}}</h3>

                        <p>عدد الفئات</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$products_count}}</h3>
                        <p>عددالمنتجات</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="order_profit inner">
                        <h3>{{$price_total}} جنيه</h3>
                        <p>إجمالى المبيعات </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>

             <!-- ./col -->
             <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="order_profit inner">
                        <h3>{{$orders_profits}} جنيه</h3>
                        <p>إجمالى الربح </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="card card-dark">
                <div class="card-body">
                    <div class="col-md-12">
                        @if(count($orders) != 0)
                    <table id="" style="width:100%;border-radius 500px;" class="table-responsive table table-hover text-center">
                        <thead class="thead-dark">
                        <tr>
                            <th style="border-radius:0px 30px 30px 0px;" scope="col">رقم الأوردر</th>
                            <th scope="col">رقم المنتج</th>
                            <th scope="col">إسم المنتج</th>
                            <th scope="col">ألوان المنتج</th>
                            <th scope="col">الكمية</th>
                            <th scope="col">الكمية المتبقية</th>
                            <th scope="col">السعر</th>
                            <th scope="col"> نوع الأوردر </th>
                            <th style="border-radius:30px 0px 0px 30px;" scope="col">التاريخ</th>
                        </tr>
                        </thead>
                        <tbody id="orders_show">
                         <?php echo $order_content_html; ?>

                        </tbody>
                    </table>

                    <div>

                    @if(@isset($status) && @isset($status) == 1)
                    <ul style="background-color:gray;list-style:none;text-align:center;border:none;margin-top:15px;width: 750px;">
                            <li style="display:inline-block;width:170px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">السعر الكلى:</h2>
</li>
                            <li style="display:inline-block;width:140px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">  {{$price_total}}جنيه</h2>
</li>

<li style="display:inline-block;width:160px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">قيمة الخصم:</h2>
</li>
                            <li style="display:inline-block;width:140px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">  {{$discount_value }}جنيه</h2>
</li>
</ul>
                     @else
                     <ul style="background-color:gray;list-style:none;border:none;text-align:center;margin-top:15px;width: 700px;">
                            <li style="display:inline-block;width:200px">
                              <h2 style="fonta-size:25px;font-weight:bold;color:white"> الإجمالى:</h2>
</li>
                            <li style="display:inline-block;width:200px">
                              <h2 style="fonta-size:25px;font-weight:bold;color:white">  {{$price_total}} جنيه</h2>
</li>
</ul>


                    </div>
                    @endif

                    @else
    <h2 style="background-color:gray;width:500px;text-align:center;fonta-size:25px;font-weight:bold;color:white"> لا يوجدأوردرات</h2>
    @endif


                </div>

                    </div>
                </div>
            </div>

        </div>

    </div>




    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        if($('#orders_profits').length)
        {
            var orders_profits = $('#orders_profits').val();
            $('.order_profit h3').append(`
             ${orders_profits+' جنيه'}
            `);
        }else{
            $('.order_profit h3').append(`

            `);
        }

    </script>
@endsection
