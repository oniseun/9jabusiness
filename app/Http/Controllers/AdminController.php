<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Auth;

class AdminController extends Controller
{
    public static $errors = NULL;
    
    public function add_form()
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
    	   return view('admin.forms.admin');
        }
    }

    public function login_form()
    {
        if(Auth::check())
        {
            return redirect('dashboard');
        }
        else
        {
            return view('admin.auth.login');
        }
        
    }

    public function banned_form()
    {
        if(!Auth::banned())
        {
            return redirect('dashboard');
        }
        else
        {
       
            return view('admin.banned');
        
        }
    }

    public function edit_profile()
    {
    	$user_info = Admin::info(Auth::id());
    	return view('admin.editforms.profile',compact('user_info'));
    }

    public function logout_form()
    {
        $user_info = Admin::info(Auth::id());
        return view('admin.forms.logout',compact('user_info'));
    }

    public function edit_password()
    {
    	return view('admin.editforms.password');
    }

    public function add()
    {
        if(\Request::has(Admin::expected_input('store')) && Auth::level() < 3 && self::validate_data('add_user',Auth::id()) && Admin::create_admin(Auth::id(),Auth::level()))
        {
            return redirect('admin/list/admins')->with('success','User Added successfully');
        }
        else
        {
            return back()->with('failure','An error occured while processing data '.self::$errors);
        }
    }

    
    
    public function update_profile()
    {
        if(\Request::has(Admin::expected_input('info_update')) && self::validate_data('edit_profile',Auth::id()) && Admin::update_info(Auth::id()))
        {
            return back()->with('success','Data updated successfully!!');
        }
        else
        {
            return back()->with('failure','An error occured while processing data '.self::$errors);
        }
    }

    public function update_picture()
    {

        if(\Request::has(Admin::expected_input('photo_update')) && self::validate_data('edit_picture',Auth::id()) &&  Admin::update_picture(Auth::id()))
        {
            return back()->with('success','Photo uploaded successfully!!');
        }
        else
        {
            return back()->with('failure','An error occured while uploading photo '.self::$errors)->withInput();
        }
    }

    public function update_password()
    {

        if(\Request::has(Admin::expected_input('password_update')) && self::validate_data('edit_password',Auth::id()) && Admin::update_password(Auth::id()))
        {
            Auth::create_session(Auth::info('email'));
            return back()->with('success','Password changed successfully!!');
        }
        else
        {
            return back()->with('failure','An error occured while processing ...'.self::$errors);
        }
    }

    public function ban_admin()
    {
        if(\Request::has('id') 
            && $this->admin_exist(\Request::input('id'))
            && \Request::input('id') != Auth::id()
            && Auth::higher_admin(\Request::input('id')))
        {
            Admin::ban(Auth::id());
            
        }
        return back()->with('success','Admin added to banned list!!');
        
    }

    public function unban_admin()
    {
        if(\Request::has('id') 
            && $this->admin_exist(\Request::input('id'))
            && \Request::input('id') != Auth::id() 
            && Auth::higher_admin(\Request::input('id')))
        {
            Admin::unban(Auth::id());
            
        }
        return back()->with('success','Admin removed from banned list !!');
        
    }

    public function login()
    {
        $fields = ['email','password'];
        if(\Request::has(['email','password']))
        {
            extract(\Request::only($fields));
            if(Auth::attempt($email,$password))
            {
                Auth::create_session($email);
                return redirect('dashboard')->with('success','Logged in successfully');
            }
            else
            {
                return back()->with('failure','Incorrect email and password!');
            }
            
        }
    }


    public function logout()
    {
        
                Auth::logout();
                return redirect('/')->with('success','Logged out successfully');
            
            
    }

    public function admin_list()
    {
        $admins = Admin::get_list(); 
        return view('admin.list.admins',compact('admins'));
    }

     private static function validate_data($key,$uid)
    {
        $validate_rules['add_user'] = [
            'name' =>'required|min:5|max:30',
            'sex' =>'required|in:male,female',
            'email' =>'required|email|unique:9jb_admins,email',
            'phone' => 'required|digits_between:5,12|unique:9jb_admins,phone'


        ];

        $validate_rules['edit_profile'] = [
            'name' =>'required|min:5|max:30',
            'sex' =>'required|in:male,female',
            'email' =>'required|email|unique:9jb_admins,email,'.$uid.',id',
            'phone' => 'nullable|digits_between:5,12|unique:9jb_admins,phone,'.$uid.',id',
            'about'=>'nullable|min:5',


        ];
        $validate_rules['edit_photo'] = [
            'photo' => 'required|image|mimes:jpeg,png|max:5000',

        ];

        $validate_rules['edit_password'] = [
            'old' =>'required|min:5',
            'new' => 'required|min:5|confirmed',
            'new_confirmation' =>'min:5',
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

    private function admin_exist($id)
    {
        return \DB::table('9jb_admins')->where('id' ,$id) ->exists();
    }

    

}
