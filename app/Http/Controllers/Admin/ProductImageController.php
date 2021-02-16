<?php


namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductImageImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\ProductImage;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class ProductImageController extends Controller
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

        $data = ProductImage::where('product_id',$id)->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request,$id)
    {
        $title=Product::where('id',$id)->value('name_ar');
        return view('Admin.ProductImage.index',compact('id','title'));
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
                'image' => 'required|image|max:2000',
            ],
            [
                'image.required' =>'من فضلك ادخل صوره المنتج',
                'image.image' =>'من فضلك ادخل صورة صالحة'
            ]
        );
        $ProductImage=new ProductImage();
        $ProductImage->image=saveImage('ProductImages',$request->image);
        $ProductImage->product_id=$request->product_id;
        $ProductImage->save();
        return $this->apiResponseMessage(1,'تم اضافة الصورة بنجاح',200);
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
            $ProductImage = ProductImage::whereIn('id', $ids)->get();
            foreach($ProductImage as $row){
                $this->deleteRow($row);
            }
        } else {
            $ProductImage = ProductImage::find($id);
            $this->deleteRow($ProductImage);
        }
        return response()->json(['errors' => false]);
    }

    /**
     * @param $cat
     */
    private function deleteRow($ProductImage){
        deleteFile('ProductImage',$ProductImage->image);
        $ProductImage->delete();
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
