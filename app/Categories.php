<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public static function expected_input($action)
    {
        $input =    [
                        'store' => ['title','fa_icon','color','featured_image'],
                        'update' => ['id','title','color','fa_icon']

                    ];

        return $input[$action];
    }

    public static function store($created_by)
    {
    	//$request = new Request;
    	$data = \Request::only(self::expected_input('store'));

    	$upload_folder = 'uploads/images/'.date("Y/m");

    	if(\Request::hasFile('featured_image'))
    	{
	        $extension = \Request::file('featured_image')->extension();
	        $new_name = str_slug($data['title'].microtime().rand(111,666));

	        $full_file_name = "$new_name.$extension";

	        $data['featured_image'] = \Request::file('featured_image')->storeAs($upload_folder,$full_file_name,'uploads');
    	}
    	$data['url'] = str_slug($data['title']);
    	$data['created_by'] = $created_by;
    	$data['create_time'] = time();


    	return  \DB::table('9jb_categories')->insert($data);
    }


    public static function update_data()
    {
    	//$request = new Request;
    	$data = \Request::only(self::expected_input('update'));

    	$upload_folder = 'uploads/images/'.date("Y/m");

    	if(\Request::hasFile('featured_image'))
    	{
	        $extension = \Request::file('featured_image')->extension();
	        $new_name = str_slug($data['title'].microtime().rand(111,666));

	        $full_file_name = "$new_name.$extension";

	        $data['featured_image'] = \Request::file('featured_image')->storeAs($upload_folder,$full_file_name,'uploads');
    	}



    	return  \DB::table('9jb_categories')->where('id',$data['id']) 
    										->update($data);
    }

    public static function info($id)
    {
    	return \DB::table('9jb_categories')->where('id',$id)
    										->orWhere('url',$id)->first();
    }

    public static function get_list()
    {

        return \DB::table('9jb_categories')->orderBy('title','ASC')->get();
    }

    public static function update_listing_count()
    {

        \DB::statement('UPDATE `9jb_categories` SET listing_count = (SELECT count(*) FROM 9jb_listings WHERE 9jb_categories.id = 9jb_listings.category_id) WHERE 1');
    }

}
