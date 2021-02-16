<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Product::get();
        return $this->mainFunction($data);
    }


    public function index()
    {
        return view('Admin.Product.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm (){
        return view('Admin.Product.create');
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
                'ProductCode' => 'unique:Products|required',
            ],
            [
                'ProductCode.required' =>'من فضلك ادخل اللون',
                'ProductCode.unique' =>'اللون موجود لدينا بالفعل',
            ]
        );
        $this->save_Product($request,new Product);
        return $this->apiResponseMessage(1,'تم اضافة القسم بنجاح',200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Product = Product::find($id);
        return $Product;
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
                'ProductCode' => 'unique:Products,ProductCode,'.$request->id.'|required',
            ],
            [
                'ProductCode.required' =>'من فضلك ادخل اللون',
                'ProductCode.unique' =>'اللون موجود لدينا بالفعل',
            ]
        );
        $Product = Product::find($request->id);
        $this->save_Product($request,$Product);
        return $this->apiResponseMessage(1,'تم تعديل اللون بنجاح',200);
    }

    /**
     * @param $request
     * @param $cat
     */
    public function save_Product($request,$Product){
        $Product->ProductCode=$request->ProductCode;
        $Product->save();
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
            $Categories = Product::whereIn('id', $ids)->get();
            foreach($Categories as $row){
                $this->deleteRow($row);
            }
        } else {
            $Product = Product::find($id);
            $this->deleteRow($Product);
        }
        return response()->json(['errors' => false]);
    }

    /**
     * @param $cat
     */
    private function deleteRow($cat){
        deleteFile('Product',$cat->image);
        $cat->delete();
    }

    /**
     * @param Request $request
     * @param $id
     * @return int
     */
    public function ChangeStatus(Request $request,$id){
        $store=Product::find($id);
        $store->status=$request->status;
        $store->save();
        return 1;
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
                $options .= ' <a href="/Admin/Product/index?cat_id='.$data->id.'" title="الاقسام الفرعية" class="btn btn-success waves-effect btn-circle waves-light"><i class="icon-Add"></i> </a></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('productNum', function ($data) {
            return $data->product->count();
        })->editColumn('ProductCode', function ($data) {
            return '<span style="background-Product: '.$data->ProductCode.';width: 10px ; height: 10px">#</span>' . str_replace('#','',$data->ProductCode);
        })->rawColumns(['action' => 'action','ProductCode'=>'ProductCode','checkBox'=>'checkBox'])->make(true);
    }
}
