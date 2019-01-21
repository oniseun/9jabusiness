<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    public static function expected_input($action)
    {
        $input =    [
                        'store' => ['title','description','tags','products',
                        			'category_id','featured_image','featured_video',  
                        			'price_from','price_to',
                        			'physical_address','featured',
                        			'primary_phone','other_phones',
                        			'primary_email','other_emails',
                        			'website','facebook','instagram','twitter','linkedin',
                        			'founded','state','city','zip_code','map_url',
                        			'image1','image2'],

                        'update' => ['id','title','description','tags','products',
                        			'category_id','featured_video',
                        			'price_from','price_to','featured',
                        			'physical_address',
                        			'primary_phone','other_phones',
                        			'primary_email','other_emails',
                        			'website','facebook','instagram','twitter','linkedin',
                        			'founded','city','zip_code','map_url'],

                        'activate' => ['id'],

                    ];

        return $input[$action];
    }

    public static function store($created_by)
    {
        	//$request = new Request;
    	$data = \Request::only(self::expected_input('store'));

    	
    	$image_list = ['featured_image','image1','image2','image3','image4','image5','image6','business_logo'];

    	// loop through and upload 
    	foreach($image_list as $image_file):

				if(\Request::hasFile($image_file))
		    	{
		    		$upload_folder = 'uploads/images/'.date("Y/m");
		    		
			        $extension = \Request::file($image_file)->extension();
			        $new_name = str_slug($image_file.'-'.$data['title'].microtime().rand(111,666));

			        $full_file_name = "$new_name.$extension";

			        $data[$image_file] = \Request::file($image_file)->storeAs($upload_folder,$full_file_name,'uploads');
		    	}

    	endforeach;

    	$open_hours = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

    	// loop through and upload 
    	foreach($open_hours as $weekday):

			if(strlen(\Request::input($weekday.'_open_time')) > 5 )
	    	{
	    		$data[$weekday.'_status'] = 'open' ;
	    	}

    	endforeach;

    	$data['meta_keywords'] = $data['tags'] ;
    	$data['created_by'] = $created_by ;
    	$data['create_time'] = time();
    	$data['publish_time'] = time();
    	$data['url'] = str_slug($data['title']) ;


    	return  \DB::table('9jb_listings')->insert($data);
    }


    public static function update_data()
    {
        	//$request = new Request;
    	$data = \Request::only(self::expected_input('update'));

    	
    	$image_list = ['featured_image','image1','image2','image3','image4','image5','image6','business_logo'];

    	// loop through and upload 
    	foreach($image_list as $image_file):

				if(\Request::hasFile($image_file))
		    	{
		    		$upload_folder = 'uploads/images/'.date("Y/m");
		    		
			        $extension = \Request::file($image_file)->extension();
			        $new_name = str_slug($image_file.'-'.$data['title'].microtime().rand(111,666));

			        $full_file_name = "$new_name.$extension";

			        $data[$image_file] = \Request::file($image_file)->storeAs($upload_folder,$full_file_name,'uploads');
		    	}

    	endforeach;

    	$open_hours = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

    	// loop through and upload 
    	foreach($open_hours as $weekday):

				if(strlen(\Request::input($weekday.'_open_time')) > 4  )
		    	{
		    		$data[$weekday.'_status'] = 'open' ;
		    	}

    	endforeach;
    	
    	$data['last_update_time'] = time();



    	return  \DB::table('9jb_listings')->where('id',$data['id']) 
											->update($data);
    }



    public static function activate_listing()
    {
    	$data = \Request::only(self::expected_input('activate'));
        $extend = 60 * 60 * 60 * 24 * 30;
    	$data['activation_date'] = date("Y-m-d");
    	$data['status'] = 'activated';
    	$data['expiry_date'] = date("Y-m-d",time() + $extend);
    	return  \DB::table('9jb_listings')->where('id',$data['id']) 
											->update($data);
    }

    public static function delete_listing()
    {
        $id = \Request::input('id');

        $data['status'] = 'deleted';
        return  \DB::table('9jb_listings')->where('id',$id) 
                                            ->update($data);
    }

    public static function restore_listing()
    {
        $id = \Request::input('id');

        $data['status'] = 'pending';
        return  \DB::table('9jb_listings')->where('id',$id) 
                                            ->update($data);
    }


    #----------------
    # ?? LIST
    #----------------

    public static function pending($limit =50)
    {

       $query = "SELECT id, category_id,created_by, title, url, featured_image,  create_time,

       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status = 'pending'
                ORDER BY last_update_time DESC LIMIT $limit ";

        return  \DB::select($query);
    }

    public static function pending_prev($from_time,$limit =15)
    {

       $query = "SELECT id, category_id,created_by, title, url, featured_image,  create_time,

       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name
        
        FROM  9jb_listings
        WHERE status = 'pending'AND last_update_time > $from_time 
        ORDER BY last_update_time ASC LIMIT $limit ";

        return  array_reverse(\DB::select($query)) ;
    }

    public static function pending_next($from_time,$limit =15)
    {

       $query = "SELECT id, category_id,created_by, title, url, featured_image,  create_time,

       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status = 'pending'AND last_update_time < $from_time 
                ORDER BY last_update_time DESC LIMIT $limit ";

        return  \DB::select($query) ;
    }

    // recent list -------------------------------------------------------------

    public static function admin_recent_listing($limit = 15)
    {

       $query = "SELECT id, category_id,created_by, title,url, featured_image,  create_time,expiry_date,activation_date,

       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status != 'deleted'
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query) ;
    }


    public static function admin_prev_recent_listing($from_time, $limit = 15)
    {
       
       $query = "SELECT id, category_id,created_by,title, url, featured_image,  create_time,expiry_date,activation_date,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status != 'deleted' AND create_time > $from_time 
                ORDER BY create_time ASC LIMIT $limit ";

        return  array_reverse(\DB::select($query)) ;
    }

    public static function admin_next_recent_listing($from_time, $limit = 15)
    {
       
       $query = "SELECT id, category_id,created_by,title, url, featured_image,  create_time,expiry_date,activation_date,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status != 'deleted' AND create_time < $from_time 
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query) ;
    }

    // trash -----------------------------------------------

        public static function admin_trash_listing($limit = 15)
    {

       $query = "SELECT id, category_id,created_by, title,url, featured_image,  create_time,expiry_date,activation_date,

       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status = 'deleted' 
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query) ;
    }

    public static function admin_prev_trash_listing($from_time, $limit = 15)
    {
       
       $query = "SELECT id, category_id,created_by,title, url, featured_image,  create_time,expiry_date,activation_date,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status = 'deleted' AND create_time > $from_time 
                ORDER BY create_time ASC LIMIT $limit ";

        return  array_reverse(\DB::select($query)) ;
    }

    public static function admin_next_trash_listing($from_time, $limit = 15)
    {
       
       $query = "SELECT id, category_id,created_by,title, url, featured_image,  create_time,expiry_date,activation_date,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status = 'deleted' AND create_time < $from_time 
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query) ;
    }

    // Expired List ----------------------------------------------------------

    public static function admin_expired_listing($limit = 15)
    {
        $time = time();
       $query = "SELECT id, category_id,created_by, title,url, featured_image,  create_time,expiry_date,activation_date,

       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status != 'deleted' AND UNIX_TIMESTAMP(expiry_date) < $time
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query) ;
    }

    public static function admin_prev_expired_listing($from_time, $limit = 15)
    {
       $time = time();

       $query = "SELECT id, category_id,created_by,title, url, featured_image,  create_time,expiry_date,activation_date,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status != 'deleted' AND UNIX_TIMESTAMP(expiry_date) < $time AND create_time > $from_time 
                ORDER BY create_time ASC LIMIT $limit ";

        return  array_reverse(\DB::select($query)) ;
    }

    public static function admin_next_expired_listing($from_time, $limit = 15)
    {
       $time = time();

       $query = "SELECT id, category_id,created_by,title, url, featured_image,  create_time,expiry_date,activation_date,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name

                FROM  9jb_listings
                WHERE status != 'deleted' AND UNIX_TIMESTAMP(expiry_date) < $time AND create_time < $from_time 
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query) ;
    }

    // Search List ----------------------------------------------------------

     public static function admin_search_list($search_string, $limit = 20)
    {
       

        return \DB::table('9jb_listings')->select(\DB::raw("id, category_id,created_by,title,description, url,activation_date, featured_image,  create_time,primary_phone,primary_email,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name"))
                                    ->where('title', 'like', '%'.$search_string.'%')
                                    ->orWhere('primary_email', 'like', '%'.$search_string.'%')
                                    ->orWhere('tags', 'like', '%'.$search_string.'%')
                                    ->orderBy('create_time','DESC')
                                    ->limit($limit)
                                    ->get();
    }

    #----------------
    # ?? INFO 
    #----------------

    public static function info_public($url)
    {
        return \DB::table('9jb_listings')->select(\DB::raw("*,
        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT url FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_url,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT url FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_url,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
       (SELECT url FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_url,
        (SELECT name FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_name,
         (SELECT photo FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_photo,
         (SELECT url FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_url,
          (SELECT phone FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_phone,
           (SELECT email FROM 9jb_admins WHERE 9jb_listings.created_by = 9jb_admins.id) AS admin_email,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews
        "))
                                    ->where('url', $url)
                                    ->where('status','activated')
                                    ->first();
    }

    public static function info_admin($id)
    {
        return \DB::table('9jb_listings')->where('id',$id)
	                                    ->first();
    }

    public static function update_hits($url)
    {
       \DB::table('9jb_listings')->where('url',$url)->increment('hits');
    }
    #-------------------------------
    # ?? LIST HOME
    #-------------------------------
    public static function latest_listing($limit = 9)
    {
       
       

       $query = "SELECT id, category_id,created_by, title,description, url, featured_image,  create_time,primary_phone,primary_email,

        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE  status='activated'
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query) ;
    }

    public static function featured_listing($limit = 9)
    {
       
       
    	$time = time();
        $query_live = "SELECT id, category_id,created_by, title,description, url, featured_image,  create_time,primary_phone,primary_email,

        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE  status='activated' AND featured ='yes' AND UNIX_TIMESTAMP(featured_expiration_date) < $time
                ORDER BY create_time DESC LIMIT $limit ";

       $query = "SELECT id, category_id,created_by, title,description, url, featured_image,  create_time,primary_phone,primary_email,

        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE  status='activated' AND featured ='yes' 
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query) ;
    }

    public static function popular_listing($limit = 6)
    {
       
       

       $query = "SELECT id, category_id,created_by, title,description, url, featured_image,  create_time,primary_phone,primary_email,

        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE  status='activated'
                ORDER BY hits DESC LIMIT $limit ";

        return  \DB::select($query) ;
    }



    #-------------------------------
    # ?? LIST BY CATEGORY
    #-------------------------------

    public static function category_listing($category_id,$limit = 15)
    {
       
       

       $query = "SELECT id, category_id,created_by, title,description, url, featured_image,  create_time,primary_phone,primary_email,

        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE category_id = ? AND status='activated'
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query,[$category_id]) ;
    }

    public static function category_listing_prev($category_id,$from_time, $limit = 15)
    {
       
       $query = "SELECT id, category_id,created_by,title,description, url, featured_image,  create_time,primary_phone,primary_email,
         (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE category_id = ? AND create_time > ?  AND status='activated'
                ORDER BY create_time ASC LIMIT $limit ";

        return  array_reverse(\DB::select($query,[$category_id,$from_time])) ;
    }

    public static function category_listing_next($category_id,$from_time, $limit = 15)
    {
       
       $query = "SELECT id, category_id,created_by,title,description, url, featured_image,  create_time,primary_phone,primary_email,
         (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
    	(SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE category_id = ? AND create_time < ?  AND status='activated'
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query,[$category_id,$from_time]) ;
    }

   #-------------------------------
    # ?? LIST BY LOCATION
    #-------------------------------

    public static function location_listing($location_id,$limit = 15)
    {
       
       

       $query = "SELECT id, category_id,created_by, title,description, url, featured_image,  create_time,primary_phone,primary_email,

        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE (city = ? or state = ?) AND status='activated'
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query,[$location_id,$location_id]) ;
    }

    public static function location_listing_prev($location_id,$from_time, $limit = 15)
    {
       
       $query = "SELECT id, category_id,created_by,title,description, url, featured_image,  create_time,primary_phone,primary_email,
        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE (city = ? or state = ?) AND create_time > ?  AND status='activated'
                ORDER BY create_time ASC LIMIT $limit ";

        return  array_reverse(\DB::select($query,[$location_id,$location_id,$from_time])) ;
    }

    public static function location_listing_next($location_id,$from_time, $limit = 15)
    {
       
       $query = "SELECT id, category_id,created_by,title,description, url, featured_image,  create_time,primary_phone,primary_email,
         (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE (city = ? or state = ?) AND create_time < ?  AND status='activated'
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query,[$location_id,$location_id,$from_time]) ;
    }

       #-------------------------------
    # ?? AUTHOR LISTINGS
    #-------------------------------

    public static function author_listing($admin_id,$limit = 15)
    {
       
       

       $query = "SELECT id, category_id,created_by, title,description, url, featured_image,  create_time,primary_phone,primary_email,

        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE created_by = ? AND status='activated'
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query,[$admin_id]) ;
    }

    public static function author_listing_prev($admin_id,$from_time, $limit = 15)
    {
       
       $query = "SELECT id, category_id,created_by,title,description, url, featured_image,  create_time,primary_phone,primary_email,
        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
        (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

        FROM  9jb_listings
        WHERE created_by = ? AND create_time > ?  AND status='activated'
        ORDER BY create_time ASC LIMIT $limit " ;

        return  array_reverse(\DB::select($query,[$admin_id,$from_time]));
    }

    public static function author_listing_next($admin_id,$from_time, $limit = 15)
    {
       
       $query = "SELECT id, category_id,created_by,title,description, url, featured_image,  create_time,primary_phone,primary_email,
         (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE created_by = ? AND create_time < ?  AND status='activated'
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query,[$admin_id,$from_time]) ;
    }

    #-------------------------------
    # ?? SEARCH LISTINGS
    #-------------------------------

    public static function search($search_string,$state,$category_id,$limit = 15)
    {
       $bind_param[] = '%'.$search_string.'%';
       $bind_param[] = '%'.$search_string.'%';
       
    	$state_search = 1;
    	if($state > 0)
    	{
    		$bind_param[] = $state;
    		$state_search = "state = ?";
    	}
    	$category_search = 1;
    	if($category_id > 0)
    	{
    		$bind_param[] = $category_id;
    		$category_search = "category_id = ?";
    	}

       $query = "SELECT id, category_id,created_by, title,description, url, featured_image,  create_time,primary_phone,primary_email,

        (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE (title like ? OR products like ?) AND  $state_search AND $category_search  AND status='activated'
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query,$bind_param) ;
    }

    public static function search_prev($search_string,$state,$category_id,$from_time, $limit = 15)
    {
        $bind_param[] = '%'.$search_string.'%';
       $bind_param[] = '%'.$search_string.'%';

       $state_search = 1;
        if($state > 0)
        {
            $bind_param[] = $state;
            $state_search = "state = ?";
        }
        $category_search = 1;
        if($category_id > 0)
        {
            $bind_param[] = $category_id;
            $category_search = "category_id = ?";
        }

        $bind_param[] = $from_time;

       $query = "SELECT id, category_id,created_by,title,description, url, featured_image,  create_time,primary_phone,primary_email,
         (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
        (SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE (title like ? OR products like ?) AND $state_search AND $category_search AND create_time > ?  AND status='activated'
                ORDER BY create_time ASC LIMIT $limit ";

        return  array_reverse(\DB::select($query,$bind_param)) ;
    }

    public static function search_next($search_string,$state,$category_id,$from_time, $limit = 15)
    {
    	$bind_param[] = '%'.$search_string.'%';
       $bind_param[] = '%'.$search_string.'%';

       $state_search = 1;
    	if($state > 0)
    	{
    		$bind_param[] = $state;
    		$state_search = "state = ?";
    	}
    	$category_search = 1;
    	if($category_id > 0)
    	{
    		$bind_param[] = $category_id;
    		$category_search = "category_id = ?";
    	}

    	$bind_param[] = $from_time;

       $query = "SELECT id, category_id,created_by,title,description, url, featured_image,  create_time,primary_phone,primary_email,
         (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
    	(SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE (title like ? OR products like ?) AND $state_search AND $category_search AND create_time < ?  AND status='activated'
                ORDER BY create_time DESC LIMIT $limit ";

        return  \DB::select($query,$bind_param) ;
    }
    
    #----------------
    # ?? LIST
    #----------------

    public static function related_listings($listing_id, $category_id, $state,$limit = 4)
    {

       $query = "SELECT id, category_id,created_by,title, url, featured_image,  create_time,primary_phone,primary_email,
         (SELECT name FROM 9jb_locations WHERE 9jb_listings.city = 9jb_locations.id) AS city_name,
    	(SELECT fa_icon FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS icon,
        (SELECT color FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS color,
        (SELECT title FROM 9jb_categories WHERE 9jb_listings.category_id = 9jb_categories.id) AS category_name,
       (SELECT name FROM 9jb_locations WHERE 9jb_listings.state = 9jb_locations.id) AS state_name,
        (SELECT count(*) FROM 9jb_reviews WHERE 9jb_reviews.listing_id = 9jb_listings.id) AS reviews

                FROM  9jb_listings
                WHERE id <> ? AND category_id = ? AND state = ?  AND status='activated'
                ORDER BY create_time DESC LIMIT $limit ";

        return \DB::select($query,[$listing_id, $category_id, $state]) ;
    }

   


}
