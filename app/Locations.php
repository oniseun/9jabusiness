<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
	public static function expected_input($action)
    {
        $input =    [
                        'store_city' => ['parent','name'],
                        'update_city' => ['id','parent','name']
                        
                    ];

        return $input[$action];
    }

    public static function info($id)
    {
        return \DB::table('9jb_locations')->where('id',$id)->orWhere('url',$id)->first();
    }

   	public static function get_states()
    {
    	return \DB::table('9jb_locations')->where('type','state')->orderBy('name','ASC')->get();
    }

    public static function get_cities($state_id)
    {
    	return \DB::table('9jb_locations')->where('parent',$state_id)->where('type','city')->orderBy('listing_count','DESC')->get();
    }

    public static function add_city()
    {
    	$data = \Request::only(self::expected_input('store_city'));

    	$insert_param = [
    					'parent_country' => 1, // nigeria = 1
    					'parent' => $data['parent'],
    					'name' => $data['name'],
    					'url' => str_slug($data['name']),
    					'type' => 'city'
    					];

    	return  \DB::table('9jb_locations')->insert($insert_param);
    }

    public static function update_city()
    {
    	$data = \Request::only(self::expected_input('update_city'));
    	
    	$update_param=[
    					'parent' => $data['parent'],
    					'name' => $data['name']
    					];

    	return  \DB::table('9jb_locations')->where('id',$data['id']) 
		    								->where('type','city') 
											->update($update_param);
    }

    public static function update_listing_count()
    {

        \DB::statement("UPDATE `9jb_locations` SET listing_count = (SELECT count(*) FROM 9jb_listings WHERE 9jb_locations.id                = `9jb_listings`.state) WHERE type='state';
                        UPDATE `9jb_locations` SET listing_count = (SELECT count(*) FROM 9jb_listings WHERE 9jb_locations.id= `9jb_listings`.city) WHERE type='city';
                        ");
    }
}
