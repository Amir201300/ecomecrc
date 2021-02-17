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

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">الاسم بالعربيه</label>
                                <input type="text" id="name_ar" name="name_ar" required class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">الاسم بالانجليزيه</label>
                                <input type="text" id="name_en" name="name_en" required class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">الوصف بالعربيه</label>
                                <textarea type="text" id="desc_ar" name="desc_ar" required class="form-control" ></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">الوصف بالانجليزيه</label>
                                <textarea type="text" id="desc_en" name="desc_en" required class="form-control" ></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">قيمه الخصم</label>
                                <input type="text" id="amount" name="amount" required class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-email">نوع الخصم</label>
                                <select  id="amount_type" name="amount_type"  class="form-control"   >
                                    <option value="1">مفعل</option>
                                    <option value="2">غير مفعل</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-email">تاريخ الانتهاء</label>
                                <input type="date" id="expire_data" name="expire_data" required class="form-control"   >
                            </div>
                        </div>

                        <div class="col-md-6">
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
