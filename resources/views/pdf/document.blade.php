<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IBAG</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

{{--<div class="logo">--}}
{{--    <img src="{{base_path('public/logo/logo.jpg')}}">--}}
{{--</div>--}}

<div class="limiter">
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100 ver1 m-b-110">
                <div class="table100-head">
    
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
                            <th scope="col">سعر البيع </th>
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
                            <li style="display:inline-block;width:10px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">السعر الكلى:</h2>
</li>
                            <li style="display:inline-block;width:10px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">  {{$price_total}}جنيه</h2> 
</li>

<li style="display:inline-block;width:10px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">قيمة الخصم:</h2>
</li>
                            <li style="display:inline-block;width:140px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">  {{$discount_value }}جنيه</h2> 
</li>

</ul>
                     @else
                     <table style="background-color:gray;list-style:none;border:none;text-align:center;margin-top:15px;margin-right:-5px;width: 100%;">
                           
                     <tr>
                     <td style="display:inline-block;">
                              <h2 style="fonta-size:7px;font-weight:bold;color:white">الإجمالى :</h2>
</td>
                            <td style="display:inline-block;">
                              <h2 style="fonta-size:7px;font-weight:bold;color:white">  {{$price_total}}جنيه</h2>
                               
</td>


                     </tr>
                    
</table>
                    @endif
              </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
