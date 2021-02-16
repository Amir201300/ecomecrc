<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class BrandsController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Brands::get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('Admin.Brands.index');
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
                'logo' => 'required|image|max:2000',
                'name_ar' => 'required',
                'name_en' => 'required',
            ],
            [
                'logo.required' =>'من فضلك ادخل شعار الماركه',
                'name_ar.required' =>'من فضلك ادخل اسم الماركه بالعربية',
                'name_en.required' =>'من فضلك ادخل اسم الماركه بالانجليزية',
                'logo.image' =>'من فضلك ادخل صورة صالحة'
            ]
        );
        $this->save_brand($request,new Brands);
        return $this->apiResponseMessage(1,'تم اضافة الماركه بنجاح',200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Brands = Brands::find($id);
        return $Brands;
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
                'logo' => 'image|max:2000',
            ],
            [
                'logo.required' =>'من فضلك ادخل شعار القسم',
                'logo.image' =>'من فضلك ادخل صورة صالحة'
            ]
        );
        $brand = Brands::find($request->id);
        $this->save_brand($request,$brand);
        return $this->apiResponseMessage(1,'تم تعديل الماركه بنجاح',200);
    }

    /**
     * @param $request
     * @param $brand
     */
    public function save_brand($request,$brand){
        $brand->name_ar=$request->name_ar;
        $brand->name_en=$request->name_en;
        if($request->logo) {
            deleteFile('Brands',$brand->logo);
            $brand->logo=saveImage('Brands',$request->logo);
        }
        $brand->save();
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
            $Brands = Brands::whereIn('id', $ids)->get();
            foreach($Brands as $row){
                $this->deleteRow($row);
            }
        } else {
            $Brands = Brands::find($id);
            $this->deleteRow($Brands);
        }
        return response()->json(['errors' => false]);
    }

    /**
     * @param $cat
     */
    private function deleteRow($Brands){
        deleteFile('Brands',$Brands->logo);
        $Brands->delete();
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
        })->editColumn('logo', function ($data) {
            $image = '<a href="'. getImageUrl('Brands',$data->logo).'" target="_blank">'
            .'<img  src="'. getImageUrl('Brands',$data->logo) . '" width="50px" height="50px"></a>';
            return $image;
        })->rawColumns(['action' => 'action','logo' => 'logo','checkBox'=>'checkBox'])->make(true);
    }
}
