@extends('admin.app')

@section('content_header')

@endsection
@section('content')
<br><br>
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title float-left">إضافة فئات</h3>
            <a href="/category" class="btn btn-success float-right">عرض الفئات</a>
        </div>
        <!-- /.card-header -->
        <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
            @csrf
            @method('post')

            @include('admin.partials._errors')

            {{--name--}}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-shopping-bag"></i></span>
                            </div>
                            <input type="text" name="name" value="{{old('category_name')}}" class="form-control" placeholder="إسم الفئة" data-inputmask="'alias': 'ip'" data-mask >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Upload image input-->
                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                            <input id="upload" type="file" required name="image" onchange="" class="image form-control border-0">
                            <label id="upload-label" for="upload" class="font-weight-bold  text-muted"> </label>
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
                                <span class="input-group-text"><i class="fas fa-plus-circle"></i></span>
                            </div>
                            <input type="submit" value="{{trans('site.add_category')}}" class="btn btn-success" data-inputmask="'alias': 'ip'" data-mask>
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

@endsection
