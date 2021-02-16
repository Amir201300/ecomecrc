<?php


namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductImageImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\ProductSize;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class ProductSizesController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request,$id)
    {

        $data = ProductSize::where('product_id',$id)->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request,$id)
    {
        $title=Product::where('id',$id)->value('name_ar');
        return view('Admin.ProductSizes.index',compact('id','title'));
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
                'name_ar' => 'required',
                'name_en' => 'required',
            ],
            [
                'name_ar.required' =>'من فضلك ادخل حجم المنتج بالعربيه',
                'name_en.required' =>'من فضلك ادخل حجم المنتج بالانجليزيه',
            ]
        );
        $this->save_size($request,new ProductSize());
        return $this->apiResponseMessage(1,'تم اضافة الحجم بنجاح',200);
    }


    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $size = ProductSize::find($id);
        return $size;
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
                'name_ar' => 'required',
                'name_en' => 'required',
            ],
            [
                'name_ar.required' =>'من فضلك ادخل حجم المنتج بالعربيه',
                'name_en.required' =>'من فضلك ادخل حجم المنتج بالانجليزيه',
            ]
        );
        $size = ProductSize::find($request->id);
        $this->save_size($request,$size);
        return $this->apiResponseMessage(1,'تم تعديل الحجم بنجاح',200);
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
            $size = ProductSize::whereIn('id', $ids)->get();
            foreach($size as $row){
                $this->deleteRow($row);
            }
        } else {
            $size = ProductSize::find($id);
            $this->deleteRow($size);
        }
        return response()->json(['errors' => false]);
    }

    /**
     * @param $request
     * @param $size
     */
    public function save_size($request,$size){
        $product=Product::find($request->product_id);
        $size->product_id=$request->product_id;
        $size->name_ar=$request->name_ar;
        $size->name_en=$request->name_en;
        $size->price=$request->price;
        $size->price_offer = $product->is_offer ==1 ? getRateNumber($request->price,$product->offer_value,2) : null;
        $size->save();
    }
    /**
     * @param $cat
     */
    private function deleteRow($size){
        $size->delete();
    }


    /**
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    private function mainFunction($data)
    {
        return Datatables::of($data)->addColumn('action', function ($data) {
            $options = ' <button type="button" onclick="deleteFunction(' . $data->id . ',1)" class="btn btn-dribbble waves-effect btn-circle waves-light"><i class="sl-icon-trash"></i> </button></td>';
            $options .= '<td class="sorting_1"><button  class="btn btn-info waves-effect btn-circle waves-light" onclick="editFunction(' . $data->id . ')" type="button" ><i class="fa fa-spinner fa-spin" id="loadEdit_' . $data->id . '" style="display:none"></i><i class="sl-icon-wrench"></i></button>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('image', function ($data) {
            $image = '<a href="'. getImageUrl('ProductImages',$data->image).'" target="_blank">'
                .'<img  src="'. getImageUrl('ProductImages',$data->image) . '" width="50px" height="50px"></a>';
            return $image;
        })->rawColumns(['action' => 'action','image' => 'image','checkBox'=>'checkBox'])->make(true);
    }
}
