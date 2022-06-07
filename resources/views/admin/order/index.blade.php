@extends('admin.app')

@section('content_header')

@endsection
@section('content')

<style>
    table th{
    font-size :14px;
}

</style>

    <br><br>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">عرض الأوردرات</h3>
        </div>
        <!-- /.card-header -->
<div class="container" style="width: 100%">
    <br>
    <form action="/orders" method="get">
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
            </div>
    </div>
    </form>
</div>


        <div class="col-md-12">
            <div class="">
                <form action="/generate_pdf" method="get">
                        @csrf
                            <input style="width: 50%" type="hidden" id="start_pdf" name="start_date_pdf"
                                   value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                            <input style="width: 50%" type="hidden" id="to_pdf" name="to_date_pdf"
                                   value="{{Carbon\Carbon::now()->format('Y-m-d')}}">

                            <input class="btn btn-info" type="submit" value="إنشاء فايل pdf">
                </form>
                <!-- /.card-header -->
                <div class="card-body">

                <form id="form_order_id" action="/getorderonly" method="get">
                        @csrf
    <div class="input-group rounded" style="margin-bottom:15px;width:50%">
  <input type="number" class="form-control rounded" id="order_num_id" class="order_num_class" name="order_num" placeholder="رقم الأوردر" aria-label="Search" aria-describedby="search-addon" />
  <span class="input-group-text border-0" id="search-addon">
    <i class="fas fa-search"></i>
  </span>
</div>

</form>






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
                            <th scope="col">سعر الشراء</th>
                            <th scope="col"> نوع الأوردر </th>
                            <th scope="col"> التاريخ </th>
                            <th style="border-radius:30px 0px 0px 30px;" scope="col">إسترجاع</th>
                        </tr>
                        </thead>
                        <tbody id="orders_show">
                         <?php echo $order_content_html; ?>

                        </tbody>
                    </table>

                    <div>

                    @if(@isset($status) && @isset($status) == 1)
                    <ul style="background-color:gray;list-style:none;text-align:center;border:none;margin-top:15px;width: 700px;">
                            <li style="display:inline-block;width: 160px;">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">السعر الكلى:</h2>
</li>
                            <li style="display:inline-block;width:160px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">  {{$price_total}}جنيه</h2>
</li>

<li style="display:inline-block;width:160px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">قيمة الخصم:</h2>
</li>
                            <li style="display:inline-block;width:160px">
                              <h2 style="fonta-size:10px;font-weight:bold;color:white">  {{$discount_value }}جنيه</h2>
</li>

</ul>
                     @else
                     <ul style="background-color:gray;list-style:none;border:none;text-align:center;margin-top:15px;width: 800px;">
                            <li style="display:inline-block;width:160px">
                              <label style="font-size: 20px;font-weight:bold;color:white">إجمالى السعر :</label>
</li>
                            <li style="display:inline-block;width:160px">
                              <h2 style="font-size:20px;font-weight:bold;color:white">  {{$price_total}}جنيه</h2>

</li>

<li style="display:inline-block;width:160px">
                              <label style="font-size:20px;font-weight:bold;color:white">إجمالى الخصم:</label>
</li>
                            <li style="display:inline-block;width:160px">
                              <h2 style="font-size:20px;font-weight:bold;color:white">  {{$discount_total}} جنيه</h2>
</li>

                         <li style="display:inline-block;width:160px">
                             <label style="font-size:20px;font-weight:bold;color:white">إجمالى الربح:</label>
                         </li>

                         <li style="display:inline-block;width:160px">
                             <h2 style="fonta-size:10px;font-weight:bold;color:white">  {{$orders_profits}} جنيه</h2>
                         </li>

</ul>
                    @endif

                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <div class="d-flex justify-content-center">

                        </div>
                    </ul>
                </div>
            </div>
            <!-- /.card -->



        </div>

        <!-- /.card-body -->
        <div class="card-footer">

        </div>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function(){

            $(document).delegate('#order_num_id','keypress',function(e){
            var code = e.keyCode || e.which;
            if(code == 13){
               var value = $(this).val();

               if(value != null){
                   $('#form_order_id').submit();
               }
            }


           });



            $('#start').on('change',function(){
                var start_date = $(this).val();
                $('#start_pdf').val(start_date);
            });
            $('#to').on('change',function(){
                var to_date = $(this).val();
                $('#to_pdf').val(to_date);
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


        });
    </script>

@endsection
