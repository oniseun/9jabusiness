<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listings;
use App\Widgets;

class IndexController extends Controller
{
   
    public function main()
    {
    	extract(Widgets::get('top_categories','top_locations','location_list','category_list'));
    	
    	$featured = Listings::featured_listing();

    	$latest = Listings::latest_listing();

    	$popular = Listings::popular_listing();

    	return view('public.index',compact('featured','latest','popular','top_categories','top_locations','location_list','category_list'));
    	
    }


      public function send_feedback()
    {
        $expected = ['name','email','phone','comment'];
        if(\Request::has($expected))
        {
            $data = \Request::only($expected);
            if(self::validate_feedback() && \DB::table('9jb_contact_form')->insert($data))
            {
                return back()->with('success','Feedback sent successfully!!');
            }
            else
            {
                return back()->with('failure','Error sending feedback <br>'.implode('<br>',self::$errors));
            }
        }
        
    }


    private static function validate_feedback()
    {
        $data = \Request::only(['name','email','phone','comment']);

        $validate_rules = [
                'name' =>'required|min:5|max:30',
                'email' =>'required|email',
                'phone' => 'nullable|digits_between:5,12',
                'comment'=>'required|min:10'

            ];

    $validate_messages =[];
    $validator = \Validator::make($data,$validate_rules,$validate_messages );

    if(!$validator->fails())
    {

        return true;
    }
    else
    {
        self::$errors = $validator->errors()->all();
        return false;
    }
    }


}
