<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Auth, File;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    use \App\Traits\ApiResponseTrait;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function allData(Request $request)
    {
        $data = Category::where('level',1)->where('cat_id',null)->get();
        if($request->cat_id)
            $data = Category::where('level',2)->where('cat_id',$request->cat_id)->get();
        return $this->mainFunction($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $title='الاقسام';
        $cat_id=null;
        if($request->cat_id){
            $cat=Category::find($request->cat_id);
            $title=$cat->name_ar;
            $cat_id=$request->cat_id;
        }
        return view('Admin.Category.index',compact('title','cat_id'));
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
                'name_ar' => 'required',
                'name_en' => 'required',
            ],
            [
                'image.required' =>'من فضلك ادخل صورة القسم',
                'name_ar.required' =>'من فضلك ادخل اسم القسم بالعربية',
                'name_en.required' =>'من فضلك ادخل اسم القسم بالانجليزية',
                'img.image' =>'من فضلك ادخل صورة صالحة'
            ]
        );
        $this->save_cat($request,new Category);
        return $this->apiResponseMessage(1,'تم اضافة القسم بنجاح',200);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        $Category = Category::find($id);
        return $Category;
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
                'img' => 'image|max:2000',
            ],
            [
                'img.required' =>'من فضلك ادخل صورة القسم',
                'img.image' =>'من فضلك ادخل صورة صالحة'
            ]
        );
        $Category = Category::find($request->id);
        $this->save_cat($request,$Category);
        return $this->apiResponseMessage(1,'تم تعديل القسم بنجاح',200);
    }

    /**
     * @param $request
     * @param $cat
     */
    public function save_cat($request,$cat){
        $cat->name_ar=$request->name_ar;
        $cat->name_en=$request->name_en;
        $cat->status=$request->status;
        $cat->cat_id=$request->cat_id;
        $cat->level=$request->cat_id ? 2 : 1;
        if($request->image) {
            deleteFile('Category',$cat->image);
            $cat->image=saveImage('Category',$request->image);
        }
        $cat->save();
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
            $Categories = Category::whereIn('id', $ids)->get();
            foreach($Categories as $row){
                $this->deleteRow($row);
            }
        } else {
            $Category = Category::find($id);
            $this->deleteRow($Category);
        }
        return response()->json(['errors' => false]);
    }

    /**
     * @param $cat
     */
    private function deleteRow($cat){
        deleteFile('Category',$cat->image);
        $cat->delete();
    }

    /**
     * @param Request $request
     * @param $id
     * @return int
     */
    public function ChangeStatus(Request $request,$id){
        $store=Category::find($id);
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
                $options .= ' <a href="/Admin/Category/index?cat_id='.$data->id.'" title="الاقسام الفرعية" class="btn btn-success waves-effect btn-circle waves-light"><i class="icon-Add"></i> </a></td>';
            return $options;
        })->addColumn('checkBox', function ($data) {
            $checkBox = '<td class="sorting_1">' .
                '<div class="custom-control custom-checkbox">' .
                '<input type="checkbox" class="mybox" id="checkBox_' . $data->id . '" onclick="check(' . $data->id . ')">' .
                '</div></td>';
            return $checkBox;
        })->editColumn('image', function ($data) {
            $image = '<a href="'. getImageUrl('Category',$data->image).'" target="_blank">'
            .'<img  src="'. getImageUrl('Category',$data->image) . '" width="50px" height="50px"></a>';
            return $image;
        })->editColumn('status', function ($data) {
            $status = '<button class="btn waves-effect waves-light btn-rounded btn-success statusBut" style="cursor:pointer !important" onclick="ChangeStatus(2,'.$data->id.')" title="اضغط هنا لالغاء التفعيل">مفعل</button>';
            if ($data->status == 2)
                $status = '<button class="btn waves-effect waves-light btn-rounded btn-danger statusBut" onclick="ChangeStatus(1,'.$data->id.')" style="cursor:pointer !important" title="اضغط هنا للتفعيل">غير مفعل</button>';
            return $status;
        })->rawColumns(['action' => 'action','status'=>'status', 'image' => 'image','checkBox'=>'checkBox'])->make(true);
    }
}
