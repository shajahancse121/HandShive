<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogCategory;
use App\Comment;
use App\Contact;
use App\Courier;
use App\Cupon;
use App\Department;
use App\User;
use App\Role;
use App\CustomerShare;
use App\Faq;
use App\MissionVision;
use App\Offer;
use App\Shipping;
use App\Slider;
use App\Support;
use App\WhyChooseUs;
use App\WorkFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\CompanyProfile;
use App\TaskWeDo;

class ManageContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckAdmin');
    }

    public function comopanyProfile()
    {


        $company = CompanyProfile::find(1);
        return view('backend.admin.company.company-profile', ['company' => $company]);
    }
    public function adminUser()
    {
        $users = User::all();
        $roles = Role::all();
        return view('backend.admin.company.view-user-all', ['users' => $users, 'roles' => $roles]);
    }
    public function saveUser(Request $request)
    {
        $user_upload_path = null;
        if ($request->hasfile('image')) {
            $user_image =  $request->file('image');
            $imageName = Str::uuid() . '.' . $user_image->getClientOriginalExtension();
            $user_image->move(public_path('upload/users/'), $imageName);
            $user_upload_path = "upload/users/" . $imageName;
        }

        $user = new User();
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->email = $request->email;
        $user->status = 1;
        $user->password = bcrypt($request->password);
        $user->image = $user_upload_path ? $user_upload_path : 'blank.png';

        $user->save();
        $request->session()->flash('success', 'User Create  Successfully');

        return redirect()->route('admin.view-user');
    }
    public function updateUser(Request $request)
    {
        $user = User::find($request->user_id);
        if ($request->hasfile('image')) {
            $image =  $request->file('image');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/users/'), $imageName);
            $user_upload_path = "upload/users/" . $imageName;
            if (isset($user->image)) {
                unlink(public_path($user->image));
            }
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->password)) {

            $user->password = bcrypt($request->password);
        }

        $user->image = isset($user_upload_path) ? $user_upload_path : $user->image;
        $user->status = $request->status;
        $user->role_id = $request->role_id;

        $user->save();
        $request->session()->flash('success', 'User Update  Successfully');

        return redirect()->route('admin.view-user');
    }
    public function editUser(Request $request)
    {

        $user = User::find($request->user_id);
        $data['id'] = $user->id;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['status'] = $user->status;
        $data['role_id'] = $user->role_id;
        $data['image'] = $user->image ? $user->image : 'upload/category/no-image.png';

        return response()->json($data);
    }
    public function editCompany(Request $request)
    {


        $company = CompanyProfile::find($request->id);
        if ($request->hasfile('logo')) {
            $company_logo =  $request->file('logo');
            $imageName = Str::uuid() . '.' . $company_logo->getClientOriginalExtension();
            $company_logo->move(public_path('frontend/'), $imageName);
            $category_upload_path = "frontend/" . $imageName;
        }
        $company->name = $request->name;
        $company->logo = isset($category_upload_path) ? $category_upload_path : $company->logo;
        $company->title = $request->title;
        $company->address = $request->address;
        $company->email = $request->email;
        $company->mobile = $request->mobile;
        $company->facebook = $request->facebook;
        $company->youtube = $request->youtube;
        $company->twitter = $request->twitter;
        $company->instragram = $request->instragram;

        $company->save();
        $request->session()->flash('success', 'Company Profile Update  Successfully');

        return redirect()->route('admin.profile');
    }

    public function viewAllSlider()
    {
        $sliders = Slider::all();
        $departments = Department::where('status', 1)->get();
        $data = [];
        $data['sliders'] = $sliders;
        $data['departments'] = $departments;
        return view('backend.admin.content.slider', $data);
    }
    public function viewAllSupport()
    {
        $support = Support::all();
        $data = [];
        $data['supports'] = $support;
        return view('backend.admin.content.support-content', $data);
    }
    public function viewAllOffer()
    {
        $offer = Offer::all();
        $data = [];
        $data['offers'] = $offer;
        return view('backend.admin.content.offer-content', $data);
    }
    public function updateSlider(Request $request)
    {

        if ($request->hasfile('new_photo')) {
            $slider_image =  $request->file('new_photo');
            $imageName = Str::uuid() . '.' . $slider_image->getClientOriginalExtension();
            $slider_image->move(public_path('upload/slider/'), $imageName);
            $slider_upload_path = "upload/slider/" . $imageName;
        }

        $slider = Slider::find($request->slider_id);
        $slider->title = $request->title;
        $slider->department_id = $request->department_id;
        $slider->description = $request->description;
        $slider->url_link = $request->url_link;
        $slider->status = $request->status;
        $slider->photo = !empty($slider_upload_path) ? $slider_upload_path : $slider->photo;
        $slider->save();

        $request->session()->flash('success', 'Slider Update  Successfully');

        return redirect()->route('admin.slider');
    }
    public function updateWorkFlow(Request $request)
    {

        $work_flow = WorkFlow::find($request->work_flow_id);

        if ($request->hasfile('work_flow_img')) {
            $work_flow_image =  $request->file('work_flow_img');
            $imageName = Str::uuid() . '.' . $work_flow_image->getClientOriginalExtension();
            $work_flow_image->move(public_path('upload/department_work_flow/'), $imageName);
            $img_upload_path = "upload/department_work_flow/" . $imageName;
            if (isset($work_flow->work_flow_img)) {
                unlink(public_path($work_flow->work_flow_img));
            }
        }
        $work_flow->department_id = $request->department_id;
        $work_flow->work_flow_img = isset($img_upload_path) ? $img_upload_path : $work_flow->work_flow_img;
        $work_flow->status = $request->status;
        $work_flow->save();

        $request->session()->flash('success', 'WorkFlow Update  Successfully');

        return redirect()->route('admin.add-work-flow');
    }
    public function deleteWorkFlow(Request $request, $work_flow_id = null)
    {
        $content = WorkFlow::find($work_flow_id);

        if (isset($content->work_flow_img)) {
            unlink(public_path($content->work_flow_img));
        }


        $content->delete();


        $request->session()->flash('success', 'WorkFlow Deleted  Successfully');

        return redirect()->route('admin.add-work-flow');
    }
    public function updateContent(Request $request)
    {

        $mission_vision = MissionVision::find($request->content_id);

        if ($request->hasfile('new_photo')) {

            $mv_image =  $request->file('new_photo');
            $imageName = Str::uuid() . '.' . $mv_image->getClientOriginalExtension();
            $mv_image->move(public_path('upload/slider/'), $imageName);
            $item_upload_path = "upload/slider/" . $imageName;

            $slider_previous_photo = public_path($mission_vision->photo);
            unlink($slider_previous_photo);
        }


        $mission_vision->title = $request->title;
        $mission_vision->details = $request->details;

        $mission_vision->photo = !empty($item_upload_path) ? $item_upload_path : $mission_vision->photo;
        $mission_vision->save();

        $request->session()->flash('success', 'Content Update  Successfully');

        return redirect()->route('admin.mission-vision');
    }
    public function updateCustomerShare(Request $request)
    {

        $content = CustomerShare::find($request->content_id);

        if ($request->hasfile('new_photo')) {

            $mv_image =  $request->file('new_photo');
            $imageName = Str::uuid() . '.' . $mv_image->getClientOriginalExtension();
            $mv_image->move(public_path('upload/customer_share/'), $imageName);
            $item_upload_path = "upload/customer_share/" . $imageName;
            if ($content->photo) {
                $slider_previous_photo = public_path($content->photo);
                unlink($slider_previous_photo);
            }
        }


        $content->name = $request->name;
        $content->message = $request->message;
        $content->hyperlink = $request->hyperlink;

        $content->photo = !empty($item_upload_path) ? $item_upload_path : $content->photo;
        $content->save();

        $request->session()->flash('success', 'Testimonial Update  Successfully');

        return redirect()->route('admin.customer-share');
    }
    public function saveMissionVision(Request $request)
    {
        if ($request->hasfile('photo')) {
            $mission_image =  $request->file('photo');
            $imageName = Str::uuid() . '.' . $mission_image->getClientOriginalExtension();
            $mission_image->move(public_path('upload/mission_vision/'), $imageName);
            $image_upload_path = "upload/mission_vision/" . $imageName;
        }

        $mvitem = new MissionVision();
        $mvitem->title = $request->title;
        $mvitem->details = $request->details;
        $mvitem->photo = $image_upload_path;
        $mvitem->save();

        $request->session()->flash('success', 'Content Save  Successfully');

        return redirect()->route('admin.mission-vision');
    }
    public function saveCustomerShare(Request $request)
    {

        if ($request->hasfile('photo')) {
            $mission_image =  $request->file('photo');
            $imageName = Str::uuid() . '.' . $mission_image->getClientOriginalExtension();
            $mission_image->move(public_path('upload/customer_share/'), $imageName);
            $image_upload_path = "upload/customer_share/" . $imageName;
        }

        $mvitem = new CustomerShare();
        $mvitem->name = $request->name;
        $mvitem->message = $request->message;
        $mvitem->hyperlink = $request->hyperlink;
        $mvitem->photo = $image_upload_path;
        $mvitem->save();

        $request->session()->flash('success', 'Customer Testimonial Save  Successfully');

        return redirect()->route('admin.customer-share');
    }

    public function saveWorkFlow(Request $request)
    {
        $status = $request->status;
        $department_id = $request->department_id;
        if ($request->hasfile('work_flow_img')) {
            foreach ($request->file('work_flow_img') as $file) {


                $imageName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('upload/department_work_flow'), $imageName);
                $image_upload_path = "upload/department_work_flow/" . $imageName;


                $workFlow = new WorkFlow();
                $workFlow->work_flow_img = $image_upload_path;
                $workFlow->department_id = $department_id;
                $workFlow->status = $status;
                $workFlow->save();
            }
        }



        $request->session()->flash('success', 'WorkFlow Save  Successfully');

        return redirect()->route('admin.add-work-flow');
    }
    public function saveSlider(Request $request)
    {
        if ($request->hasfile('photo')) {
            $slider_image =  $request->file('photo');
            $imageName = Str::uuid() . '.' . $slider_image->getClientOriginalExtension();
            $slider_image->move(public_path('upload/slider/'), $imageName);
            $slider_upload_path = "upload/slider/" . $imageName;
        }

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->department_id = $request->department_id;
        $slider->description = $request->description;
        $slider->url_link = $request->url_link;
        $slider->status = $request->status;
        $slider->photo = $slider_upload_path;
        $slider->save();

        $request->session()->flash('success', 'Slider Create  Successfully');

        return redirect()->route('admin.slider');
    }


    public function deleteContent(Request $request, $content_id = null)
    {
        $content = MissionVision::find($content_id);

        $slider_previous_photo = public_path($content->photo);
        unlink($slider_previous_photo);
        $content->delete();

        $request->session()->flash('success', 'Content Delete  Successfully');

        return redirect()->route('admin.mission-vision');
    }
    public function deleteShare(Request $request, $content_id = null)
    {
        $content = CustomerShare::find($content_id);

        $slider_previous_photo = public_path($content->photo);
        unlink($slider_previous_photo);
        $content->delete();

        $request->session()->flash('success', 'Testimonial Delete  Successfully');

        return redirect()->route('admin.customer-share');
    }
    public function deleteSlider(Request $request, $slider_id = null)
    {
        $slider = Slider::find($slider_id);

        $slider_previous_photo = public_path($slider->photo);
        unlink($slider_previous_photo);
        $slider->delete();

        $request->session()->flash('success', 'Slider Delete  Successfully');

        return redirect()->route('admin.slider');
    }
    public function editSlider(Request $request)
    {
        $slider = Slider::find($request->slider_id);
        $data['id'] = $slider->id;
        $data['title'] = $slider->title;
        $data['department_id'] = $slider->department_id;
        $data['description'] = $slider->description;
        $data['photo'] = $slider->photo;
        $data['url_link'] = $slider->url_link;
        $data['status'] = $slider->status;

        return response()->json($data);
    }
    public function editCustomerShare(Request $request)
    {
        $mission_vision = CustomerShare::find($request->content_id);
        $data['id'] = $mission_vision->id;
        $data['name'] = $mission_vision->name;
        $data['message'] = $mission_vision->message;
        $data['hyperlink'] = $mission_vision->hyperlink;
        $data['photo'] = $mission_vision->photo;

        return response()->json($data);
    }
    public function editContent(Request $request)
    {
        $mission_vision = MissionVision::find($request->content_id);
        $data['id'] = $mission_vision->id;
        $data['title'] = $mission_vision->title;
        $data['details'] = $mission_vision->details;
        $data['photo'] = $mission_vision->photo;

        return response()->json($data);
    }
    public function editWorkFlow(Request $request)
    {
        $work_flow = WorkFlow::find($request->work_flow_id);
        $data['work_flow_id'] = $work_flow->id;
        $data['department_id'] = $work_flow->department_id;
        $data['status'] = $work_flow->status;
        $data['work_flow_img'] = $work_flow->work_flow_img;


        return response()->json($data);
    }

    public function editSupport(Request $request)
    {
        $support = Support::find($request->support_id);
        $data['id'] = $support->id;
        $data['title'] = $support->title;
        $data['details'] = $support->details;
        $data['icon'] = $support->icon;


        return response()->json($data);
    }
    public function editOffer(Request $request)
    {
        $offer = Offer::find($request->offer_id);

        $data['url_link'] = $offer->url_link;
        $data['image'] = $offer->image;
        $data['show_home'] = $offer->show_home;


        return response()->json($data);
    }
    public function updateSupport(Request $request)
    {

        if ($request->hasfile('new_photo')) {
            $support_icon =  $request->file('new_photo');
            $imageName = Str::uuid() . '.' . $support_icon->getClientOriginalExtension();
            $support_icon->move(public_path('upload/support/'), $imageName);
            $support_icon_path = "upload/support/" . $imageName;
        }

        $support = Support::find($request->support_id);
        $support->title = $request->title;
        $support->details = $request->details;
        $support->icon = !empty($support_icon_path) ? $support_icon_path : $support->icon;
        $support->save();

        $request->session()->flash('success', 'Support Content Update  Successfully');

        return redirect()->route('admin.support');
    }
    public function updateOffer(Request $request)
    {
        if ($request->hasfile('new_photo')) {
            $offer_img =  $request->file('new_photo');
            $imageName = Str::uuid() . '.' . $offer_img->getClientOriginalExtension();
            $offer_img->move(public_path('upload/offer/'), $imageName);
            $offer_img_path = "upload/offer/" . $imageName;
        }

        $offer = Offer::find($request->offer_id);
        $offer->url_link = $request->url_link;
        $offer->show_home = $request->show_home ? 1 : 0;
        $offer->image = !empty($offer_img_path) ? $offer_img_path : $offer->image;
        $offer->save();

        $request->session()->flash('success', 'Offer Content Update  Successfully');

        return redirect()->route('admin.offer');
    }
    public function viewAllShipping()
    {
        $shippings = Shipping::all();
        $data = [];
        $data['shippings'] = $shippings;
        return view('backend.admin.content.shipping', $data);
    }
    public function editShipping(Request $request)
    {
        $shipping = Shipping::find($request->shipping_id);
        $data['id'] = $shipping->id;
        $data['title'] = $shipping->title;
        $data['amount'] = $shipping->amount;

        return response()->json($data);
    }
    public function updateShipping(Request $request)
    {

        $shipping = Shipping::find($request->shipping_id);
        $shipping->title = $request->title;
        $shipping->amount = $request->amount;
        $shipping->save();

        $request->session()->flash('success', 'Shipping Content Update  Successfully');

        return redirect()->route('admin.shipping');
    }
    public function viewAllCupon()
    {
        $cupons = Cupon::all();
        $data = [];
        $data['cupons'] = $cupons;
        return view('backend.admin.content.cupon-list', $data);
    }
    public function saveCupon(Request $request)
    {

        $cupon = new Cupon();
        $cupon->code = $request->code;
        $cupon->start_date = date("Y-m-d", strtotime($request->start_date));
        $cupon->end_date =  date("Y-m-d", strtotime($request->end_date));
        $cupon->discount_type = $request->discount_type;
        $cupon->amount = $request->amount;
        $cupon->status = $request->status;
        $cupon->save();

        $request->session()->flash('success', 'Cupon Create  Successfully');

        return redirect()->route('admin.cupon');
    }
    public function editCupon(Request $request)
    {
        $cupon = Cupon::find($request->cupon_id);
        $data['id'] = $cupon->id;
        $data['code'] = $cupon->code;
        $data['start_date'] = $cupon->start_date;
        $data['end_date'] = $cupon->end_date;
        $data['discount_type'] = $cupon->discount_type;
        $data['amount'] = $cupon->amount;
        $data['status'] = $cupon->status;


        return response()->json($data);
    }
    public function updateCupon(Request $request)
    {
        $cupon = Cupon::find($request->cupon_id);
        $cupon->code = $request->code;
        $cupon->start_date = date("Y-m-d", strtotime($request->start_date));
        $cupon->end_date =  date("Y-m-d", strtotime($request->end_date));
        $cupon->discount_type = $request->discount_type;
        $cupon->amount = $request->amount;
        $cupon->status = $request->status;
        $cupon->save();

        $request->session()->flash('success', 'Cupon Update Successfully');

        return redirect()->route('admin.cupon');
    }
    public function viewAllBlog()
    {
        $whychooseus = WhyChooseUs::all();
        $data = [];
        $data['whycooseus'] = $whychooseus;
        return view('backend.admin.content.blog-list', $data);
    }
    public function allContactMessage()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->get();
        $data = [];
        $data['contacts'] = $contacts;
        return view('backend.admin.content.contacts-message', $data);
    }

    public function addWorkFlow()
    {
        $work_flow = WorkFlow::all();
        $departments = Department::where('status', 1)->get();
        $data = [];
        $data['work_flow'] = $work_flow;
        $data['departments'] = $departments;
        return view('backend.admin.content.work_flow', $data);
    }
    public function customerShare()
    {
        $customer_share = CustomerShare::all();
        $data = [];
        $data['customer_shares'] = $customer_share;
        return view('backend.admin.content.customer-share', $data);
    }
    public function missionVision()
    {
        $misssion_vissions = MissionVision::all();
        $data = [];
        $data['misssion_vissions'] = $misssion_vissions;
        return view('backend.admin.content.mission-vision', $data);
    }
    public function deleteContactMessage($contact_id, Request $request)
    {
        $contact = Contact::find($contact_id);
        if ($contact->delete()) {
            $request->session()->flash('success', 'Message Deleted  Successfully');
        } else {
            $request->session()->flash('success', 'Message Deleted  Faild!');
        }
        return redirect()->route('admin.contact-message');
    }

    public function viewContactMessage(Request $request)
    {
        $contact = Contact::find($request->contact_id);
        $data['email'] = $contact->email;
        $data['name'] = $contact->name;
        $data['phone'] = $contact->phone;
        $data['subject'] = $contact->subject;
        $data['message'] = $contact->message;

        return response()->json($data);
    }


    public function viewAllBlogComments()
    {
        $comments = Comment::all();
        $data = [];
        $data['comments'] = $comments;
        return view('backend.admin.content.blog-comments', $data);
    }
    public function addBlog()
    {
        $categories = BlogCategory::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $data = [];
        $data['categories'] = $categories;
        $data['departments'] = $departments;
        return view('backend.admin.content.add-blog', $data);
    }
    public function editSupportService($support_id = null)
    {
        $whychooseuss = WhyChooseUs::find($support_id);
        $departments = Department::where('status', 1)->get();
        $data = [];
        $data['departments'] = $departments;
        $data['whychooseus'] = $whychooseuss;
        return view('backend.admin.content.edit-blog', $data);
    }
    public function deleteSupportService($support_id, Request $request)
    {
        $wchoous = WhyChooseUs::find($support_id);

        if ($wchoous->delete()) {
            $request->session()->flash('success', 'Support Services Deleted  Successfully');
        } else {
            $request->session()->flash('success', 'Support Services Deleted  Successfully');
        }

        return redirect()->route('admin.blog');
    }
    public function deleteComment($comment_id, Request $request)
    {
        $comment = Comment::find($comment_id);
        if ($comment->delete()) {
            $request->session()->flash('success', 'Comments Deleted  Successfully');
        } else {
            $request->session()->flash('success', 'Comments Deleted  Faild!');
        }
        return redirect()->route('admin.blog-comments');
    }
    public function saveSupportService(Request $request)
    {

        $whychooseus = new WhyChooseUs();
        $whychooseus->department_id = $request->department_id;
        $whychooseus->support_tag = json_encode($request->support_tag);
        $whychooseus->support_message = $request->support_message;
        $whychooseus->status = $request->status;
        $whychooseus->save();

        $request->session()->flash('success', 'Support & Services Save  Successfully');

        return redirect()->route('admin.blog');
    }
    public function updateSupportService($support_id, Request $request)
    {
        $whychooseus = WhyChooseUs::find($support_id);


        $whychooseus->department_id = $request->department_id;
        $whychooseus->support_tag = json_encode($request->support_tag);
        $whychooseus->support_message = $request->support_message;
        $whychooseus->status = $request->status;
        $whychooseus->save();
        $request->session()->flash('success', 'Support & Services Save  Successfully');

        return redirect()->route('admin.blog');
    }
    public function blogCategory()
    {
        $categories = BlogCategory::all();
        $data = [];
        $data['categories'] = $categories;
        return view('backend.admin.content.blog-category', $data);
    }
    public function editBlogCategory(Request $request)
    {
        $category = BlogCategory::find($request->category_id);

        $data['name'] = $category->name;
        $data['status'] = $category->status;

        return response()->json($data);
    }
    public function saveBlogCategory(Request $request)
    {
        $category = new BlogCategory();
        $category->name = $request->name;
        $category->slug = preg_replace('/\s+/u', '-', trim($request->name));

        $category->status = $request->status;
        $category->save();
        $request->session()->flash('success', 'Save Blog Category  Successfully');

        return redirect()->route('admin.blog-category');
    }
    public function updateBlogCategory(Request $request)
    {
        $blogCategory = BlogCategory::find($request->blog_category_id);
        $blogCategory->name = $request->name;
        $blogCategory->slug = preg_replace('/\s+/u', '-', trim($request->name));

        $blogCategory->status = $request->status;
        $blogCategory->save();

        $request->session()->flash('success', 'Blog Category Update Successfully');

        return redirect()->route('admin.blog-category');
    }
    public function showTaskWeDo()
    {
        $departments = Department::where('status', 1)->get();
        $task_we_do = TaskWeDo::get();
        $data = [];
        $data['departments'] = $departments;
        $data['task_we_do'] = $task_we_do;
        return view('backend.admin.content.task_we_do', $data);
    }
    public function saveTaskWeDo(Request $request)
    {
        //'tag_url','icon','status','department_id'
        $taskWeDo = new TaskWeDo();
        $taskWeDo->department_id = $request->department_id;
        $tag_url_data = [];

        for ($i = 0; $i < count($request->tag); $i++) {
            $tag_url_data[] = [
                "tag" => $request->tag[$i],
                "url" => $request->tag_url[$i],
            ];
        }
        $icon = [];
        
        if($request->hasfile('icon'))
        {
            foreach($request->file('icon') as $file)
            {


                $imageName = rand(100,5000). '.' .$file->getClientOriginalExtension();
                $file->move(public_path('upload/task_icon'), $imageName);
                $product_upload_path = $imageName;

                $icon[] = $product_upload_path;


            }
        }

      
       
        $taskWeDo->status = $request->status;
        $taskWeDo->tag_url = json_encode($tag_url_data);
        $taskWeDo->icon = json_encode($icon);
        $taskWeDo->save();
        $request->session()->flash('success', 'Save Task We Do   Successfully');

        return redirect()->route('admin.courier');
    }
    public function editTask(Request $request)
    {
        $task_we_do = TaskWeDo::find($request->task_id);
        $input_field = '';
        $count = 1;
       
        foreach(json_decode($task_we_do->tag_url) as $value){
            if($count ==100)
            {
                $input_field.= '<input type="text" name ="tag[]" value="'.$value->tag.'" class="form-control col-md-4" placeholder="Enter Tag">';
                $input_field.= '<input type="text" name="tag_url[]" class="form-control  col-md-6" value="'.$value->url.'" placeholder="Enter Hyper Link">';
            
                $input_field.='  <label class="col-md-1 text-left">';
                $input_field.='<a href="javascript:void(0);" class="add_button_1" title="Add more"><i class="ion-plus-circled" style="font-size: 20px;"></i></a></label>';

            }else{
                
            $input_field .='<div style="margin-top: 10px;margin-left: 0px !important;" class="row">';
            $input_field.='<input type="text" class="form-control col-md-4" placeholder="Enter Tag" name="tag[]" value="'.$value->tag.'"> <input type="text" name="tag_url[]" value="'.$value->url.'" class="form-control  col-md-6" placeholder="Enter Hyper Link"> ';
            $input_field.='<label class="col-md-1 text-left"> <a href="javascript:void(0);" class="remove_button" title="Add field"><i class="ion-minus-circled" style="font-size: 20px;"></i></a> </label></div>';
      

            }
            $count++;
  
        }
   

        $data['department_id'] = $task_we_do->department_id;
        $data['tag_url'] = $input_field;
        $data['status'] = $task_we_do->status;

        return response()->json($data);
    }
    public function updateCourier(Request $request)
    {
        $courier = Courier::find($request->courier_id);
        $courier->name = $request->name;
        $courier->status = $request->status;
        $courier->save();

        $request->session()->flash('success', 'Courier Company Update Successfully');

        return redirect()->route('admin.courier');
    }
}
