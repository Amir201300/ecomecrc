@extends('Admin.includes.layouts.master')

@section('title')
    اضافة منتج جديد
@endsection


@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-5 align-self-center">
                    <h4 class="page-title">اضافة منتج جديد</h4>
                    <div class="d-flex align-items-center">

                    </div>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex no-block justify-content-end align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">اضافة منتج جديد</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="#">
                                <div class="form-body">
                                    <h5 class="card-title">المعلومات الاساسية</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">اسم المنتج بالعربية</label>
                                                <input type="text" id="name_ar" class="form-control" placeholder="الاسم بالعربية"> </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">اسم المنتج بالانجليزية</label>
                                                <input type="text" id="lastName" class="form-control" placeholder="الاسم بالانجليزية"> </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">القسم</label>
                                                <select class="form-control" data-placeholder="اختار القسم" tabindex="1" name="cat_id">
                                                    @foreach(getCats(2) as $row)
                                                    <option value="Category 4">{{$row->name_ar}}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>حالة التفعيل</label>
                                                <br/>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline1" value="1" name="status" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline1">مفعل</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="customRadioInline2" name="status" value="2" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadioInline2">غير مفعل</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>سعر المنتج</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="ti-money"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="price" placeholder="سعر المنتج الاساسي" aria-label="price" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>الخصم (ان وجد)</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon2"><i class="ti-cut"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="offer_value" placeholder="نسبة الخصم" aria-label="Discount" aria-describedby="basic-addon2">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <h5 class="card-title m-t-40"> وصف المنتج بالعربية</h5>
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="4" name="desc_ar"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="card-title m-t-40"> وصف المنتج بالانجليزية</h5>
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="4" name="desc_en"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                        <!--/span-->
                                        <div class="col-md-3">
                                            <h5 class="card-title m-t-20">صورة المنتج</h5>
                                            <div class="el-element-overlay">
                                                <div class="el-card-item">
                                                    <div class="el-card-avatar el-overlay-1"> <img src="{{getImageUrl('',null)}}" alt="user" />
                                                        <div class="el-overlay">
                                                            <ul class="list-style-none el-info">
                                                                <li class="el-item"><a class="btn default btn-outline image-popup-vertical-fit el-link" href="{{getImageUrl('',null)}}"><i class="sl-icon-magnifier"></i></a></li>
                                                                <li class="el-item"><a class="btn default btn-outline el-link" href="javascript:void(0);"><i class="sl-icon-link"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn btn-info waves-effect waves-light"><span>رفع الصورة</span>
                                                <input type="file" name="image" class="upload"> </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="card-title m-t-40">المعلومات الاضافية</h5>
                                            <div class="table-responsive">
                                                <table class="table table-bordered td-padding">
                                                    <tbody>

                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" readonly placeholder="الالوان">
                                                        </td>
                                                        <td>
                                                            @foreach(getColors() as $row)
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="checkbox" id="customRadio{{$row->id}}" value="{{$row->id}}" name="color_id[]" class="custom-control-input">
                                                                <label class="custom-control-label" for="customRadio{{$row->id}}"><span style="background-color: {{$row->colorCode}}">{{str_replace('#','',$row->colorCode)}}</span></label>
                                                            </div>
                                                                @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span type="text" class="text-primary">
                                                                 :الصور
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <input type="file" multiple name="images[]" class="form-control"  placeholder="الصور">
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                <div class="form-actions m-t-40">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> حفظ</button>
                                    <button type="button" onclick="{{route('Product.index')}}" class="btn btn-dark">رجوع</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center">
            All Rights Reserved by AdminBite admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>



@endsection

@section('script')

@endsection
