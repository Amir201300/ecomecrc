<div class="modal fade bd-example-modal-lg" id="DetailsModel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="DetailsForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="DetailsTitle"><i class="ti-marker-alt m-r-10"></i> Add new </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">ابعاد المنتج</label>
                                <input type="text" id="product_dimensions" name="product_dimensions"  class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">الشركة المصنعه</label>
                                <input type="text" id="manufacturer" name="manufacturer"  class="form-control"   >
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">بلد المصدر</label>
                                <input type="text" id="country_of_origin" name="country_of_origin"  class="form-control"   >
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">وزن المنتج</label>
                                <input type="text" id="item_weight" name="item_weight" class="form-control"   >
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">الخامة</label>
                                <input type="text" id="fabric" name="fabric"  class="form-control"   >
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">شكل الرقبة</label>
                                <input type="text" id="neck_style" name="neck_style"  class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">النقش</label>
                                <input type="text" id="pattern" name="pattern"  class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">الشكل</label>
                                <input type="text" id="style" name="style"  class="form-control"   >
                            </div>
                        </div>

                    </div>
                </div>
                <div id="err"></div>
                <input type="hidden" name="product_id" id="product_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"  data-dismiss="modal">اغلاق</button>
                    <button type="submit" id="saveD" class="btn btn-success"><i class="ti-save"></i> حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
