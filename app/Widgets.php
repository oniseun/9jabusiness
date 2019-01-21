<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Widgets extends Model
{
	public static function get()
	{
		$vars = func_get_args();


		foreach($vars as $type):

			switch($type):

				case 'top_locations':
								$return[$type] = self::top_locations();
								break;

				case 'top_categories':
								$return[$type] = self::top_categories();
								break; 

				case 'location_list':
								$return[$type] = self::location_list();
								break;

				case 'category_list':
								$return[$type] = self::category_list();
								break; 
			endswitch;

		endforeach;

		return $return ;


	}
    public static function top_locations()
    {
    	return \DB::table('9jb_locations')->where('type','state')->orderBy('listing_count','DESC')->limit(10)->get();
    }

    public static function top_categories()
    {

        return \DB::table('9jb_categories')->orderBy('listing_count','DESC')->limit(10)->get();
    }

    public static function location_list()
    {

        return \DB::table('9jb_locations')->select(\DB::Raw('id,url,name'))->where('type','state')->orderBy('name','ASC')->get();
    }

    public static function category_list()
    {

        return \DB::table('9jb_categories')->select(\DB::Raw('id,url,title'))->orderBy('title','ASC')->get();
    }
}
