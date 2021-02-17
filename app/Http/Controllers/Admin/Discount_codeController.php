<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discount_code;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class Discount_codeController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Discount_code::get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('Admin.Discount_code.index');
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        $this->validate(
            $request,
            [
                'amount' => 'required',
                'expire_data' => 'required',
            ],
            [
                'amount.required' =>'من فضلك ادخل قيمه الخصم',
                'expire_data.required' =>'من فضلك ادخل تاريخ انتهاء الخصم',
            ]
        );
        $this->save_code($request,new Discount_code);
        return $this->apiResponseMessage(1,'تم اضافة الكود بنجاح',200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $code = Discount_code::find($id);
        return $code;
    }

    /**
     * @param Request $request
     * @return int
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $this->validate(
            $request,
            [
                'amount' => 'required',
                'expire_data' => 'required',
            ],
            [
                'amount.required' =>'من فضلك ادخل قيمه الخصم',
                'expire_data.required' =>'من فضلك ادخل تاريخ انتهاء الخصم',
            ]
        );
        $code = Discount_code::find($request->id);
        $this->save_code($request,$code);
        return $this->apiResponseMessage(1,'تم تعديل الصوره بنجاح',200);
    }

    /**
     * @param $request
     * @param $brand
     */
    public function save_code($request,$code){
        $code->name_ar=$request->name_ar;
        $code->name_en=$request->name_en;
        $code->desc_en=$request->desc_en;
        $code->desc_ar=$request->desc_ar;
        $code->amount=$request->amount;
        $code->amount_type=$request->amount_type;
        $code->expire_data=$request->expire_data;
        $code->code=$this->getDiscountCode();
        $code->status=1;


        $code->save();
    }

    /**
     * @return string
     */
 public function getDiscountCode(){
        $length = 6;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|int
     */
    public function destroy($id,Request $request)
    {
        if ($request->type == 2) {
            $ids = explode(',', $id);
            $code = Discount_code::whereIn('id', $ids)->get();
            foreach($code as $row){
                $this->deleteRow($row);
            }
        } else {
            $code = Discount_code::find($id);
            $this->deleteRow($code);
        }
        return response()->json(['errors' => false]);
    }

    /**
     * @param $cat
     */
    private function deleteRow($code){
        $code->delete();
    }


    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    private function mainFunction($data)
    {
        return Datatables::of($data)->addColumn('action', function ($data) {
            $options = '<td class="sorting_1"><button  class="btn btn-info waves-effect btn-circle waves-light" onclick="editFunction(' . $data->id . ')" type="button" ><i class="fa fa-spinner fa-spin" id="loadEdit_' . $data->id . '" style="display:none"></i><i class="sl-icon-wrench"></i></button>';
            $options .= ' <button type="button" onclick="deleteFunction(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            if($data->level == 1)
                $options .= ' <a href="/Admin/Category/index?cat_id='.$data->id.'" title="الاقسام الفرعية" class="btn btn-success waves-effect btn-circle waves-light"><i class="icon-Add"></i> </a></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('status', function ($data) {
            $status = '<button class="btn waves-effect waves-light btn-rounded btn-success statusBut" style="cursor:pointer !important" onclick="ChangeStatus(2,'.$data->id.')" title="اضغط هنا لالغاء التفعيل">مفعل</button>';
            if ($data->status == 2)
                $status = '<button class="btn waves-effect waves-light btn-rounded btn-danger statusBut" onclick="ChangeStatus(1,'.$data->id.')" style="cursor:pointer !important" title="اضغط هنا للتفعيل">غير مفعل</button>';
            return $status;
        })->rawColumns(['action' => 'action','checkBox'=>'checkBox','status'=>'status'])->make(true);
    }
}
