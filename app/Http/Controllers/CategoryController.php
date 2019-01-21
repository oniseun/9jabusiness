<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Widgets;
use App\Auth;
class CategoryController extends Controller
{
    public static $errors = NULL;

    public function main()
    {
    	$categories = Categories::get_list();
    	return view('public.categories',compact('categories'));
    }
    public function admin_list()
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
            $categories = Categories::get_list();
            return view('admin.list.categories',compact('categories'));
        }
    }

    public function edit_form($id)
    {
        if(!$this->category_exist($id))
        {
           return view('admin.404');
        }
        else
        {
        $info = Categories::info($id);

        return view('admin.editforms.category',compact('info'));
        }
        
    }

    public function add_form()
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
    	return view('admin.forms.category');
        }
    }

    public function add()
    {
        if(\Request::has(Categories::expected_input('store')) && Auth::level() < 3 && self::validate_data('add_category') && Categories::store(Auth::id()))
        {
            return redirect('admin/list/categories')->with('success','Category added successfully!!');
        }
        else
        {
            return back()->with('failure','An error occured while adding category '.self::$errors);
        }
    }

    public function update_category()
    {
        if(\Request::has(Categories::expected_input('update')) && Auth::level() < 3 && self::validate_data('edit_category') && Categories::update_data())
        {
            return back()->with('success','Category updated successfully!!');
        }
        else
        {
            return back()->with('failure','An error occured while updating category '.self::$errors);
        }
    }

   private static function validate_data($key)
    {
        $validate_rules['add_category'] = [
            'title' =>'required|min:5|unique:9jb_categories,title',
            'fa_icon' => 'required|min:5',
            'color' => 'required|in:green,red,blue,brown,yellow,orange,purple',
            'featured_image' => 'required|image|mimes:jpeg,jpg,png|max:5000',

        ];;

        $validate_rules['edit_category'] = [
            'id' => 'required|integer|exists:9jb_categories,id',
            'title' =>'required|min:5',
            'fa_icon' => 'required|min:5',
            'color' => 'required|in:green,red,blue,brown,yellow,orange,purple',
            'featured_image' => 'nullable|image|mimes:jpeg,jpg,png|max:5000',


        ];

        $validate_messages =[];

        $validator = \Validator::make(\Request::all(),$validate_rules[$key],$validate_messages);

        if($validator->fails())
        {
            self::$errors = '<br>* '.implode('<br>* ',$validator->errors()->all());
            return false;
        }
        else
        {
            return true;
        }


    }

    private function category_exist($id)
    {
        return \DB::table('9jb_categories')->where('id' ,$id)->exists();
    }

    


}
