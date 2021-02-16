<div class="modal fade bd-example-modal-lg" id="formModel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="formSubmit">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="titleOfModel"><i class="ti-marker-alt m-r-10"></i> Add new </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">الاسم بالعربية</label>
                                <input type="text" id="name_ar" name="name_ar" required class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">الاسم بالانجليزية</label>
                                <input type="text" id="name_en" name="name_en" required class="form-control"   >
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">الوصف بالعربية</label>
                                <input type="text" id="desc_ar" name="desc_ar" required class="form-control"   >
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">الوصف بالانجليزية</label>
                                <input type="text" id="desc_en" name="desc_en" required class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">الخصومات</label>
                                <select  id="is_offer" name="is_offer"  class="form-control"   >
                                    <option value="1">عليه عرض</option>
                                    <option value="2">لا يوجد عرض</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">السعر</label>
                                <input type="text" id="price" name="price"  class="form-control"   >
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">قيمه العرض</label>
                                <input type="number" id="offer_value" name="offer_value"  class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">الصوره</label>
                                <input type="file" id="icon" name="icon"  class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>القسم</label>
                                <select class="custom-select col-12" id="cat_id" onchange="getCat()" name="cat_id" >
                                    <option value="">اختار </option>
                                    @foreach($Cat as $row)
                                        <option value="{{$row->id}}">{{$row->name_ar}} </option>
                                        <option value="{{$row->id}}"> {{$row->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>الماركه</label>
                                <select class="custom-select col-12" id="brand_id" onchange="getCat()" name="brand_id" >
                                    <option value=""> اختار</option>
                                    @foreach($brand as $row)
                                        <option value="{{$row->id}}">{{$row->name_ar}} </option>
                                        <option value="{{$row->id}}"> {{$row->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">الحالة</label>
                                <select  id="status" name="status"  class="form-control"   >
                                    <option value="1">مفعل</option>
                                    <option value="2">غير مفعل</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="err"></div>
                <input type="hidden" name="id" id="id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">اغلاق</button>
                    <button type="submit" id="save" class="btn btn-success"><i class="ti-save"></i> حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
