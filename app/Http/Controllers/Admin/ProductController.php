<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $Cat = Category::all();
        $brand = Brands::all();
        return view('Admin.Product.index',compact('Cat','brand'));
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
                'icon' => 'required|image|max:2000',
                'name_ar' => 'required',
                'name_en' => 'required',
            ],
            [
                'icon.required' =>'من فضلك ادخل صوره المنتج',
                'name_ar.required' =>'من فضلك ادخل اسم المنتج بالعربية',
                'name_en.required' =>'من فضلك ادخل اسم المنتج بالانجليزية',
                'icon.image' =>'من فضلك ادخل صورة صالحة'
            ]
        );
        $this->save_product($request,new Product);
        return $this->apiResponseMessage(1,'تم اضافة المنتج بنجاح',200);
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
     * @param $id
     * @return int
     */
    public function ChangeStatus(Request $request,$id){
        $Product=Product::find($id);
        $Product->status=$request->status;
        $Product->save();
        return 1;
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
                'icon' => 'image|max:2000',
                'name_ar' => 'required',
                'name_en' => 'required',
            ],
            [
                'icon.image' =>'من فضلك ادخل صورة صالحة',
                'name_ar.required' =>'من فضلك ادخل اسم المنتج بالعربية',
                'name_en.required' =>'من فضلك ادخل اسم المنتج بالانجليزية',
            ]
        );
        $Product = Product::find($request->id);
        $this->save_product($request,$Product);
        return $this->apiResponseMessage(1,'تم تعديل الماركه بنجاح',200);
    }


    /**
     * @param $request
     * @param $brand
     */
    public function save_product($request,$product){
        $product->name_ar=$request->name_ar;
        $product->name_en=$request->name_en;
        $product->desc_ar=$request->desc_ar;
        $product->desc_en=$request->desc_en;
        $product->is_offer=$request->is_offer;
        $product->price=$request->price;
        $product->price_offer=$request->price_offer;
        $product->offer_value=$request->offer_value;
        $product->brand_id=$request->brand_id;
        $product->cat_id=$request->cat_id;
        $product->status=1;
        if($request->icon) {
            deleteFile('Products',$product->icon);
            $product->icon=saveImage('Products',$request->icon);
        }
        $product->save();
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
            $Product = Product::whereIn('id', $ids)->get();
            foreach($Product as $row){
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
    private function deleteRow($Product){
        deleteFile('Product',$Product->icon);
        $Product->delete();
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
        })->editColumn('icon', function ($data) {
            $image = '<a href="'. getImageUrl('Products',$data->icon).'" target="_blank">'
            .'<img  src="'. getImageUrl('Products',$data->icon) . '" width="50px" height="50px"></a>';
            return $image;
        })->editColumn('status', function ($data) {
            $status = '<button class="btn waves-effect waves-light btn-rounded btn-success statusBut" style="cursor:pointer !important" onclick="ChangeStatus(2,'.$data->id.')" title="اضغط هنا لالغاء التفعيل">مفعل</button>';
            if ($data->status == 2)
                $status = '<button class="btn waves-effect waves-light btn-rounded btn-danger statusBut" onclick="ChangeStatus(1,'.$data->id.')" style="cursor:pointer !important" title="اضغط هنا للتفعيل">غير مفعل</button>';
            return $status;
        })->editColumn('cat_id', function ($data) {
            return $data->cat->name_ar;
        })->rawColumns(['action' => 'action','icon' => 'icon','status'=>'status','checkBox'=>'checkBox'])->make(true);
    }
}
