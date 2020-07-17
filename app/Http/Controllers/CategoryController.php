<?php

namespace App\Http\Controllers;

use App\Category;
use App\Department;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckAdmin');
    }

    public function index()
    {
        $categories = Category::all();
        $departments = Department::all();
       // dd($categories);
        $data = [];
        $data ['categories'] = $categories;
        $data ['departments'] = $departments;
        return view('backend.admin.menu.category',$data);
    }
    public function department()
    {
        $departments = Department::all();
        $data = [];
        $data ['departments'] = $departments;
        return view('backend.admin.menu.department',$data);
    }
    public function getCategory(Request $request)
    {
        $category = Category::where('department_id',$request->department_id)->where('status',1)->get();
        $category_content = '<option value="">Choose....</option>';
        foreach ($category as $item)
        {
            $category_content.='<option value="'.$item->id.'">'.$item->name.'</option>';
        }

        $data = [];
        $data['category_id']=$category_content;

        return response()->json($data);
    }
    public function getSubCategory(Request $request)
    {
        $sub_category = SubCategory::where('category_id',$request->category_id)->where('status',1)->get();
        $sub_category_content = '<option value="">Choose....</option>';
        foreach ($sub_category as $item)
        {
            $sub_category_content.='<option value="'.$item->id.'">'.$item->name.'</option>';
        }

        $data = [];
        $data['sub_category_id']=$sub_category_content;

        return response()->json($data);
    }
    public function editDepartment(Request $request)
    {
        $department = Department::find($request->department_id);
        $data['id']=$department->id;
        $data['name']=$department->name;
        $data['status']=$department->status;
        $data['status']=$department->status;
        $data['short_description']=$department->short_description;
        $data['department_video']=$department->department_video;
        $data['cover_image']=$department->cover_image?$department->cover_image:'upload/department/no-image.png';
        $data['icon']=$department->icon?$department->icon:'upload/department/no-image.png';

        return response()->json($data);

    }
    public function editCategory(Request $request)
    {
        $category = Category::find($request->category_id);
        $data['id']=$category->id;
        $data['name']=$category->name;
        $data['department_id']=$category->department_id;
        $data['status']=$category->status;
        $data['category_image']=$category->category_image?$category->category_image:'upload/category/no-image.png';

        return response()->json($data);

    }
    public function updateDepartment(Request $request)
    {
        $department = Department::find($request->id);
        if($request->hasfile('cover_image'))
        {
            $department_image =  $request->file('cover_image');
            $imageName = Str::uuid(). '.' .$department_image->getClientOriginalExtension();
            $department_image->move(public_path('upload/department/'), $imageName);
            $department_upload_path = "upload/department/" . $imageName;
            if(isset($department->cover_image)){
                unlink(public_path($department->cover_image));
            }

        }
        if($request->hasfile('icon'))
        {
            $department_icon =  $request->file('icon');
            $imageName = Str::uuid(). '.' .$department_icon->getClientOriginalExtension();
            $department_icon->move(public_path('upload/department_icon/'), $imageName);
            $department_icon_path = "upload/department_icon/" . $imageName;
            if(isset($department->icon)){
                unlink(public_path($department->icon));
            }

        }
        $department->name = $request->name;
        $department->status = $request->status;
        $department->short_description = $request->short_description;
        $department->department_video = $request->department_video;
        $department->cover_image = isset($department_upload_path)?$department_upload_path:$department->cover_image;
        $department->icon =  isset($department_icon_path)?$department_icon_path:$department->icon;
        $department->save();
        $request->session()->flash('success','Department Update  Successfully');

        return redirect()->route('admin.department');
    }
    public function updateCategory(Request $request)
    {
        $category = Category::find($request->id);
        if($request->hasfile('category_image'))
        {
            $category_image =  $request->file('category_image');
            $imageName = Str::uuid(). '.' .$category_image->getClientOriginalExtension();
            $category_image->move(public_path('upload/category/'), $imageName);
            $category_upload_path = "upload/category/" . $imageName;
            if(isset($category->category_image)){
                unlink(public_path($category->category_image));
            }

        }
        $category->name = $request->name;
        $category->category_image = isset($category_upload_path)?$category_upload_path:$category->category_image;
        $category->status = $request->status;
        $category->department_id = $request->department_id;
        $category->save();
        $request->session()->flash('success','Category Update  Successfully');

        return redirect()->route('admin.category');
    }
    public function saveDepartment(Request $request)
    {
        $department_upload_path = null;
        if($request->hasfile('cover_image'))
        {
            $department_image =  $request->file('cover_image');
            $imageName = Str::uuid(). '.' .$department_image->getClientOriginalExtension();
            $department_image->move(public_path('upload/department/'), $imageName);
            $department_upload_path = "upload/department/" . $imageName;
        }

        $icon_upload_path = null;
        if($request->hasfile('icon'))
        {
            $department_icon =  $request->file('icon');
            $imageName = Str::uuid(). '.' .$department_icon->getClientOriginalExtension();
            $department_icon->move(public_path('upload/department_icon/'), $imageName);
            $icon_upload_path = "upload/department_icon/" . $imageName;
        }

        $category = new Department();
        $category->name = $request->name;
        $category->short_description = $request->short_description;
        $category->department_video = $request->department_video;

        $category->cover_image = $department_upload_path;
        $category->icon = $icon_upload_path;
        $category->status = $request->status;
        $category->save();
        $request->session()->flash('success','Department Create  Successfully');

        return redirect()->route('admin.department');
    }
    public function saveCategory(Request $request)
    {
        $category_upload_path = null;
        if($request->hasfile('category_image'))
        {
            $category_image =  $request->file('category_image');
            $imageName = Str::uuid(). '.' .$category_image->getClientOriginalExtension();
            $category_image->move(public_path('upload/category/'), $imageName);
            $category_upload_path = "upload/category/" . $imageName;
        }

        $category = new Category();
        $category->name = $request->name;

        $category->department_id  = $request->department_id ;
        $category->category_image = $category_upload_path;
        $category->status = $request->status;
        $category->save();
        $request->session()->flash('success','Category Create  Successfully');

        return redirect()->route('admin.category');
    }
    public function subCategory()
    {
        $categories = Category::where('status',1)->get();
        $departments = Department::where('status',1)->get();
        $subCategories = SubCategory::all();
        $data = [];
        $data ['categories'] = $categories;
        $data ['departments'] = $departments;
        $data ['subCategories'] = $subCategories;
        return view('backend.admin.menu.sub-category',$data);
    }
    public function saveSubCategory(Request $request)
    {
        $subcategory = new SubCategory();
        $subcategory->category_id = $request->category_id;
        $subcategory->department_id = $request->department_id;
        $subcategory->name = $request->name;
        $subcategory->status = $request->status;
        $subcategory->save();
        $request->session()->flash('success','SubCategory Create  Successfully');

        return redirect()->route('admin.sub-category');
    }
    public function editSubCategory(Request $request)
    {
        $subcategory = SubCategory::find($request->subcategory_id);
        $categories = Category::where('department_id',$subcategory->department_id)->where('status',1)->get();
        $category_content = '<option value="">Choose....</option>';
        foreach ($categories as $item)
        {
            $category_content.='<option value="'.$item->id.'">'.$item->name.'</option>';
        }
        $data['id']=$subcategory->id;
        $data['category_id']=$subcategory->category_id;
        $data['department_id']=$subcategory->department_id;
        $data['name']=$subcategory->name;
        $data['status']=$subcategory->status;
        $data['categories']=$category_content;

        return response()->json($data);

    }
    public function updateSubCategory(Request $request)
    {
        $subcategory = SubCategory::find($request->sub_category_id);
        $subcategory->name = $request->name;
        $subcategory->department_id = $request->department_id;
        $subcategory->category_id = $request->category_id;
        $subcategory->status = $request->status;
        $subcategory->save();
        $request->session()->flash('success','Sub Category Update  Successfully');

        return redirect()->route('admin.sub-category');
    }

}
