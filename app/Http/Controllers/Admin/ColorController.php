<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class ColorController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Color::get();
        return $this->mainFunction($data);
    }


    public function index()
    {
        return view('Admin.Color.index');
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
                'colorCode' => 'unique:colors|required',
            ],
            [
                'colorCode.required' =>'من فضلك ادخل اللون',
                'colorCode.unique' =>'اللون موجود لدينا بالفعل',
            ]
        );
        $this->save_Color($request,new Color);
        return $this->apiResponseMessage(1,'تم اضافة القسم بنجاح',200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Color = Color::find($id);
        return $Color;
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
                'colorCode' => 'unique:colors,colorCode,'.$request->id.'|required',
            ],
            [
                'colorCode.required' =>'من فضلك ادخل اللون',
                'colorCode.unique' =>'اللون موجود لدينا بالفعل',
            ]
        );
        $Color = Color::find($request->id);
        $this->save_Color($request,$Color);
        return $this->apiResponseMessage(1,'تم تعديل اللون بنجاح',200);
    }

    /**
     * @param $request
     * @param $cat
     */
    public function save_Color($request,$color){
        $color->colorCode=$request->colorCode;
        $color->save();
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
            $Categories = Color::whereIn('id', $ids)->get();
            foreach($Categories as $row){
                $this->deleteRow($row);
            }
        } else {
            $Color = Color::find($id);
            $this->deleteRow($Color);
        }
        return response()->json(['errors' => false]);
    }

    /**
     * @param $cat
     */
    private function deleteRow($cat){
        deleteFile('Color',$cat->image);
        $cat->delete();
    }

    /**
     * @param Request $request
     * @param $id
     * @return int
     */
    public function ChangeStatus(Request $request,$id){
        $store=Color::find($id);
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
                $options .= ' <a href="/Admin/Color/index?cat_id='.$data->id.'" title="الاقسام الفرعية" class="btn btn-success waves-effect btn-circle waves-light"><i class="icon-Add"></i> </a></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('productNum', function ($data) {
            return $data->product->count();
        })->editColumn('colorCode', function ($data) {
            return '<span style="background-color: '.$data->colorCode.';width: 10px ; height: 10px">#</span>' . str_replace('#','',$data->colorCode);
        })->rawColumns(['action' => 'action','colorCode'=>'colorCode','checkBox'=>'checkBox'])->make(true);
    }
}
