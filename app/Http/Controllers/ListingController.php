<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listings;
use App\Categories;
use App\Widgets;
use App\Locations;
use App\Admin;
use App\Auth;


class ListingController extends Controller
{
    public static $errors = NULL;

    public function select_state()
    {
        $states =Locations::get_states();
        return view('admin.forms.select-state',compact('states'));
    }

    public function add_form($state_id)
    {
        if(!$this->state_exist($state_id))
        {
           return view('admin.404');
        }
        else
        {

            $cities =Locations::get_cities($state_id);
            extract(Widgets::get('location_list','category_list'));
            return view('admin.forms.listing',compact('state_id','cities','location_list','category_list'));
        }
    }

    public function edit_form($id)
    {

        if(!$this->listing_exist($id))
        {
           return view('admin.404');
        }
        else
        {

        $info = Listings::info_admin($id);

        $cities =Locations::get_cities($info->state);

        extract(Widgets::get('location_list','category_list'));

        return view('admin.editforms.listing',compact('info','cities','location_list','category_list'));
        }
        
    }

    ## ADMIN LIST

    public function search_listing()
    {
        $search_string = !\Request::has('q') ? '' : \Request::input('q') ;
        $listings = !\Request::has('q') ? []  : Listings::admin_search_list($search_string);
        return view('admin.list.search-listing',compact('search_string','listings'));
    }

    public function unapproved_listing()
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
            $listings = Listings::pending();
            return view('admin.list.unapproved-listing',compact('listings'));
            }
    }

    public function unapproved_listing_prev($from_time,$page_num)
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
            $listings = Listings::pending_prev($from_time);
            return view('admin.list.unapproved-listing',compact('listings','page_num'));
            }
    }

    public function unapproved_listing_next($from_time,$page_num)
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
            $listings = Listings::pending_next($from_time);
            return view('admin.list.unapproved-listing',compact('listings','page_num'));
            }
    }

    ## Recent Listing

    public function recent_listing()
    {
        $listings = Listings::admin_recent_listing();
        return view('admin.list.recent-listing',compact('listings'));
    }

    public function recent_listing_prev($from_time,$page_num)
    {
        $listings = Listings::admin_prev_recent_listing($from_time);
        return view('admin.list.recent-listing',compact('listings','page_num'));
    }

    public function recent_listing_next($from_time,$page_num)
    {
        $listings = Listings::admin_next_recent_listing($from_time);
        return view('admin.list.recent-listing',compact('listings','page_num'));
    }

    ## Trash Listing

    public function trash_listing()
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
            $listings = Listings::admin_trash_listing(20);
            return view('admin.list.trash-listing',compact('listings'));
        }
    }

    public function trash_listing_prev($from_time,$page_num)
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
            $listings = Listings::admin_prev_trash_listing($from_time);
            return view('admin.list.trash-listing',compact('listings','page_num'));
        }
    }

    public function trash_listing_next($from_time,$page_num)
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
            $listings = Listings::admin_next_trash_listing($from_time);
            return view('admin.list.trash-listing',compact('listings','page_num'));
        }
    }

    ## Expired Listing

    public function expired_listing()
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
            $listings = Listings::admin_expired_listing();
            return view('admin.list.expired-listing',compact('listings'));
        }
    }

    public function expired_listing_prev($from_time,$page_num)
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
            $listings = Listings::admin_prev_expired_listing($from_time);
            return view('admin.list.expired-listing',compact('listings','page_num'));
        }
    }

    public function expired_listing_next($from_time,$page_num)
    {
        if(Auth::level() > 2)
        {
           return view('admin.404');
        }
        else
        {
            $listings = Listings::admin_next_expired_listing($from_time);
            return view('admin.list.expired-listing',compact('listings','page_num'));
        }
    }


    ##// ADMIN LIST

    ## FORM  BUTTONS
    public function add()
    {
        if(\Request::has(Listings::expected_input('store')) 
            && self::validate_data('add_listing') 
            && Listings::store(Auth::id()))
        {
            return redirect('admin/list/recent/listing')->with('success','Listing added successfully!!');
        }
        else
        {
            return back()->with('failure','An error occured while adding listing'.self::$errors);
        }
    }

    public function update_listing()
    {
        if(     \Request::has(Listings::expected_input('update'))) 
        {
            if(  self::validate_data('update_listing') 
                && Listings::update_data())
                {
                    return back()->with('success','Listing updated successfully!!');
                }
                else
                {
                    return back()->with('failure','An error occured while updating listing'.self::$errors);
                }
        }
        
        else
        {
            return back()->with('failure','Some fileds are missing ');
        }
    }

    ##// FORM EDIT BUTTONS

    ## ACTION BUTTONS

    public function remove()
    {
        if(\Request::has('id') && Auth::level() < 3)
        {
            Listings::delete_listing();
            
        }
        return back()->with('success','Listing moved to trash!!');
        
    }

    public function restore()
    {
        if(\Request::has('id') && Auth::level() < 3)
        {
            Listings::restore_listing();
            
        }
        return back()->with('success','Listing restored successfully!!');
        
    }

    public function approve()
    {
        if(\Request::has('id') && Auth::level() < 3)
        {
            Listings::activate_listing();
            
        }
        return back()->with('success','Listing activated successfully!!');
        
    }

    ##// ACTION BUTTONS


	public function info($id)
	{
        if(!$this->listing_exist_public($id))
        {
           return view('public.404');
        }
        else
        {

		extract(Widgets::get('top_locations','top_categories','location_list','category_list'));

    	$info = Listings::info_public($id);

    	return view('public.listing-info',compact('info','top_locations','top_categories','location_list','category_list'));
        }
    	
	}

    #!! SEARCH LISTING

	public function search()
    {
    	extract(Widgets::get('top_locations','top_categories','location_list','category_list'));

    	if(\Request::has(['q','category','location']))
    	{
    	$query = \Request::input('q');
    	$category_url = \Request::input('category');
    	$location_url = \Request::input('location');

    	$c_id = $category_url == 'all' ? 0 : Categories::info($category_url)->id ;
    	$l_id = $location_url == 'all' ? 0 : Locations::info($location_url)->id;

    	$listings = Listings::search($query,$l_id,$c_id);

    	return view('public.search',compact('query','category_url','location_url','listings','top_locations','top_categories','location_list','category_list'));
    	}
    	else
    	{
    		return view('public.search',compact('top_locations','top_categories','location_list','category_list'));
    	}
    }

    public function search_prev($from_time,$page_num)
    {
        extract(Widgets::get('top_locations','top_categories','location_list','category_list'));

        if(\Request::has(['q','category','location']))
        {
        $query = \Request::input('q');
        $category_url = \Request::input('category');
        $location_url = \Request::input('location');

        $c_id = $category_url == 'all' ? 0 : Categories::info($category_url)->id ;
        $l_id = $location_url == 'all' ? 0 : Locations::info($location_url)->id;

        $listings = Listings::search_prev($query,$l_id,$c_id,$from_time);

        return view('public.search',compact('query','category_url','location_url','listings','top_locations','top_categories','location_list','category_list','page_num'));
        }
        else
        {
            return view('public.search',compact('top_locations','top_categories','location_list','category_list'));
        }
    }

    public function search_next($from_time,$page_num)
    {
        extract(Widgets::get('top_locations','top_categories','location_list','category_list'));

        if(\Request::has(['q','category','location']))
        {
        $query = \Request::input('q');
        $category_url = \Request::input('category');
        $location_url = \Request::input('location');

        $c_id = $category_url == 'all' ? 0 : Categories::info($category_url)->id ;
        $l_id = $location_url == 'all' ? 0 : Locations::info($location_url)->id;

        $listings = Listings::search_next($query,$l_id,$c_id,$from_time);

        return view('public.search',compact('query','category_url','location_url','listings','top_locations','top_categories','location_list','category_list','page_num'));
        }
        else
        {
            return view('public.search',compact('top_locations','top_categories','location_list','category_list'));
        }
    }


    #!! CATEGORY

    public function category($url)
    {
        if(!$this->category_exist_public($url))
        {
           return view('public.404');
        }
        else
        {
        	extract(Widgets::get('top_categories','location_list','category_list'));
        	$info = Categories::info($url);
        	$listings = Listings::category_listing($info->id);
        	return view('public.category-listings',compact('info','listings','top_categories','location_list','category_list'));
        }
    }

    public function category_prev($url,$from_time,$page_num)
    {

        if(!$this->category_exist_public($url))
        {
           return view('public.404');
        }
        else
        {
            extract(Widgets::get('top_categories','location_list','category_list'));
            $info = Categories::info($url);
            $listings = Listings::category_listing_prev($info->id,$from_time);
            return view('public.category-listings',compact('info','listings','top_categories','location_list','category_list','page_num'));
        }
    }

    public function category_next($url,$from_time,$page_num)
    {

        if(!$this->category_exist_public($url))
        {
           return view('public.404');
        }
        else
        {
            extract(Widgets::get('top_categories','location_list','category_list'));
            $info = Categories::info($url);
            $listings = Listings::category_listing_next($info->id,$from_time);
            return view('public.category-listings',compact('info','listings','top_categories','location_list','category_list','page_num'));
        }
    }

    #!! LOCATION

    public function location($url)
    {
        if(!$this->location_exist_public($url))
        {
           return view('public.404');
        }
        else
        {
    	extract(Widgets::get('top_locations','location_list','category_list'));
    	$info = Locations::info($url);
    	$state_name = $info->type == 'city' ? Locations::info($info->parent)->name : '';
    	$listings = Listings::location_listing($info->id);
    	return view('public.location-listings',compact('info','state_name','listings','top_locations','location_list','category_list'));
        }
    }

    public function location_prev($url,$from_time,$page_num)
    {
        if(!$this->location_exist_public($url))
        {
           return view('public.404');
        }
        else
        {
        extract(Widgets::get('top_locations','location_list','category_list'));
        $info = Locations::info($url);
        $state_name = $info->type == 'city' ? Locations::info($info->parent)->name : '';
        $listings = Listings::location_listing_prev($info->id,$from_time);
        return view('public.location-listings',compact('info','state_name','listings','top_locations','location_list','category_list','page_num'));
        }
    }

    public function location_next($url,$from_time,$page_num)
    {
        if(!$this->location_exist_public($url))
        {
           return view('public.404');
        }
        else
        {
        extract(Widgets::get('top_locations','location_list','category_list'));
        $info = Locations::info($url);
        $state_name = $info->type == 'city' ? Locations::info($info->parent)->name : '';
        $listings = Listings::location_listing_next($info->id,$from_time);
        return view('public.location-listings',compact('info','state_name','listings','top_locations','location_list','category_list','page_num'));
        }
    }

    #!! AUTHOR

    public function author($url)
    {
        if(!$this->author_exist_public($url))
        {
           return view('public.404');
        }
        else
        {
    	extract(Widgets::get('top_locations','top_categories','location_list','category_list'));
    	$info = Admin::info_public($url);
    	$listings = Listings::author_listing($info->id);
    	return view('public.author-listings',compact('info','listings','top_locations','top_categories','location_list','category_list'));
        }
    }

    public function author_prev($url,$from_time,$page_num)
    {
        if(!$this->author_exist_public($url))
        {
           return view('public.404');
        }
        else
        {
        extract(Widgets::get('top_locations','top_categories','location_list','category_list'));
        $info = Admin::info_public($url);
        $listings = Listings::author_listing_prev($info->id,$from_time);
        return view('public.author-listings',compact('info','listings','top_locations','top_categories','location_list','category_list','page_num'));
        }
    }

    public function author_next($url,$from_time,$page_num)
    {
        if(!$this->author_exist_public($url))
        {
           return view('public.404');
        }
        else
        {
        extract(Widgets::get('top_locations','top_categories','location_list','category_list'));
        $info = Admin::info_public($url);
        $listings = Listings::author_listing_next($info->id,$from_time);
        return view('public.author-listings',compact('info','listings','top_locations','top_categories','location_list','category_list','page_num'));
        }
    }

    private static function validate_data($key)
    {
        $all_image_rules = 'image|mimes:jpeg,jpg,png|max:5000';
        $all_image_update_rules = 'nullable|image|mimes:jpeg,jpg,png|max:5000';

        $validate_rules['add_listing'] = [
            'title' =>'required|min:5|unique:9jb_listings,title',
            'category_id' => 'required|integer|exists:9jb_categories,id',
            'city' => 'required|integer|exists:9jb_locations,id',
            'state' => 'required|integer|exists:9jb_locations,id',
            'description' =>'required|min:10',
            'products' =>'required|min:10',
            'physical_address' =>'required|min:10',
            'tags' =>'required|min:5',
            'zip_code' => 'required|integer',
            'primary_email' =>'required|email',
            'primary_phone' =>'required|digits_between:5,12',
            'featured_image' =>"required|$all_image_rules",
            'business_logo' =>"$all_image_update_rules"

        ];

        for($i=1 ; $i<=6; $i++):

            $validate_rules['add_listing']['image'.$i] = $all_image_rules;

        endfor;

        $validate_rules['update_listing'] = [
            'id' => 'required|integer|exists:9jb_listings,id',
            'title' =>'required|min:5',
            'category_id' => 'required|integer|exists:9jb_categories,id',
            'city' => 'required|integer|exists:9jb_locations,id',
            'description' =>'required|min:10',
            'products' =>'required|min:10',
            'physical_address' =>'required|min:10',
            'tags' =>'nullable|min:10',
            'zip_code' => 'required|integer',
            'primary_email' =>'required|email',
            'primary_phone' =>'required|digits_between:5,12',
            'featured_image' =>"$all_image_update_rules",
            'business_logo' =>"$all_image_update_rules"

        ];

        for($i=1 ; $i<=10; $i++):

            $validate_rules['update_listing']['image'.$i] = $all_image_update_rules;

        endfor;

        $validate_messages =[ ];

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

    

    private function listing_exist_public($id)
    {
        return \DB::table('9jb_listings')->where('url' ,$id)->where('status','activated')->exists();
    } 

    private function category_exist_public($id)
    {
        return \DB::table('9jb_categories')->where('url' ,$id)->exists();
    }

    private function location_exist_public($id)
    {
        return \DB::table('9jb_locations')->where('url' ,$id)->exists();
    }

    private function author_exist_public($id)
    {
        return \DB::table('9jb_admins')->where('url' ,$id)->exists();
    }

    private function listing_exist($id)
    {
        return \DB::table('9jb_listings')->where('id' ,$id) ->exists();
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
