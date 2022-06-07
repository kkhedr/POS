@extends('admin.app')

@section('content_header')


@endsection
@section('content')

<br><br>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">تحليل المنتجات </h3>
        </div>
       
       <div class="card-body">

       <div class="container" style="width: 100%">
    <br>
    <form action="/report" method="get">
    <div class="row">
            @csrf
            <div class="col-md-4">
                <label for="start">من:</label>

                <input style="width: 50%" type="date" id="start" name="start_date"
                       value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>

            <div class="col-md-4">
                <label for="start">إلى:</label>

                <input style="width: 50%" type="date" id="to" name="to_date"
                       value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>

            

            <div class="col-md-3">

                <input class="btn btn-danger" type="submit" value="عرض">
            </div>
    </div>
    </form>
</div>

       <div id="chart"></div>

       <div class="card card-dark">
         @foreach($product_count_all as $product_content)
       <div class="card-header">
            <h3 class="card-title float-left"> {{$product_content['title']}} </h3>
        </div>
       
       <div class="card-body">
       
       <table id="" style="width:100%" class="display table table-hover text-center">
                            <thead class="thead-dark">
                            <tr>
                                <th> الألوان </th>
                                <th> عدد بيعها </th>
                                <th> كمياتها</th>
                                
                            </tr>
                            </thead>
                            <tbody id="category_show">
                            @foreach($product_content['options_count'] as $index=>$option_count)
                              <tr>
                                <td>{{$product_content['colors'][$index]}}</td>
                                <td>{{$option_count}}</td>
                                <td>{{$product_content['amounts'][$index]}}</td>

                              </tr>
                              @endforeach

                          </tbody>
                          </table>
       
       </div>

       @endforeach

       </div>


        <div class="card-footer">

        </div>
    </div>
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('dist/js/apexcharts.js') }}"></script>



    <script>
       $(document).ready(function(){

       function summation(arr){
        let sum = 0;
          for (let i = 0; i < arr.length; i++) {
              sum += arr[i];
          }

          return sum;
       }
        

         var products_contents = @json($product_count_all);
        

        

        var options_count_new = [];

       var series = [];
       var products = [];
       var goals_sub = [];


        jQuery.each(products_contents,function(i,product_content){

          products.push(product_content.title)
          jQuery.each(product_content.options_count,function(i,option_count){
            goals_sub.push({
                    name: product_content.colors[i],
                    value:option_count,
                    strokeHeight:1 ,
            });
          });

          series.push({
            name: product_content.title,
            data: [
              {
              x: product_content.title,
              y: summation(product_content.options_count),
              goals: goals_sub,
              },
              

            ]

          });

          goals_sub = [];
         
        });

        console.log(series);



        // series = [];
        // series.push({
        //   name: 'Category A',
        //   data: [{
        //     x: 'Category A',
        //  y: [6,12],
        //    goals: [
        //     {
        //       name: 'أخضر',
        //       value: 6,
        //       strokeColor: '#775DD0'
        //     },{
        //       name: 'أصفر',
        //       value: 12,
        //       strokeColor: '#775DD0'
        //     }
        //    ]
        //   }]
         

        //   });


        // series.push({
        //   name: 'Category A',
        //   data: [{
        //     x: 'Category A',
        //  y: 7,
        //    goals: [
        //     {
        //       name: 'ااحمر',
        //       value: 7,
        //       strokeColor: '#775DD0'
        //     }
        //    ]
        //   }]
        //   });
       
     
        

        var options = {
          
          series: series,
          chart: {
          type: 'bar',
          height: 350,
          stacked: true,
          toolbar: {
            show: true
          },
          zoom: {
            enabled: true
          }
        },
        responsive: [{
          breakpoint: 480,
          options: {
            legend: {
              position: 'bottom',
              offsetX: -10,
              offsetY: 0
            }
          }
        }],
        plotOptions: {
          bar: {
            horizontal: false,
            borderRadius: 10
          },
        },
        xaxis: {
          type: 'منتجات',
          categories: products,
        },
        legend: {
          position: 'right',
          offsetY: 40,
          show: true,
          showForSingleSeries: true,
          customLegendItems: products,
          
        },
        fill: {
          opacity: 1
        }
        };
        
var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();


      
       });

       
    </script>

@endsection
