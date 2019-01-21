<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Locations;
use App\Widgets;

class LocationController extends Controller
{
    public static $errors = NULL;

    public function states()
    {
    	$locations = Locations::get_states();
    	return view('public.locations',compact('locations'));
    }
    public function select_state()
    {
        $states =Locations::get_states();
        return view('admin.list.select-state',compact('states'));
    }


     public function cities($state_id)
    {
        if(!$this->state_exist($state_id))
        {
           return view('admin.404');
        }
        else
        {
            $cities =Locations::get_cities($state_id);
            $state_name = Locations::info($state_id)->name;
            return view('admin.list.cities',compact('state_id','state_name','cities'));
            }
    }

    public function add_city_form()
    {
    	$states = Widgets::get('location_list')['location_list'];
    	return view('admin.forms.city',compact('states'));
    }

    public function edit_city_form($id)
    {
        if(!$this->city_exist($id))
        {
           return view('admin.404');
        }
        else
        {
            
             $states =Locations::get_states();
            $info = Locations::info($id);
            $state_name = Locations::info($info->parent)->name;
            return view('admin.editforms.city',compact('states','info','state_name'));
        }
        
    }

    public function add_city()
    {
        if(\Request::has(Locations::expected_input('store_city')) && self::validate_data('add_city') && Locations::add_city())
        {
            return redirect('admin/list/cities/'.\Request::input('parent'))->with('success','City added successfully!!');
        }
        else
        {
            return back()->with('failure','An error occured while adding city '.self::$errors);
        }
    }

    public function update_city()
    {
        if(\Request::has(Locations::expected_input('update_city')) && self::validate_data('edit_city') && Locations::update_city())
        {
            return back()->with('success','City updated successfully!!');
        }
        else
        {
            return back()->with('failure','An error occured while updating city '.self::$errors);
        }
    }

    private static function validate_data($key)
    {
        $validate_rules['add_city'] = [
            'parent' =>'required|integer|exists:9jb_locations,id',
            'name' => 'required|min:5|unique:9jb_locations,name',

        ];;

        $validate_rules['edit_city'] = [
            'id' => 'required|integer|exists:9jb_locations,id',
            'parent' =>'required|integer|exists:9jb_locations,id',
            'name' => 'required|min:5',


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
    

    private function city_exist($id)
    {
        return \DB::table('9jb_locations')->where('id' ,$id)->where('type' ,'city')->exists();
    }

    private function state_exist($id)
    {
        return \DB::table('9jb_locations')->where('id' ,$id)->where('type' ,'state')->exists();
    }


}
