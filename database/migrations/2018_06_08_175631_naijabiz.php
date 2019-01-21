<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

function split_str($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}
class naijabiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          $listings = DB::table('dbc_posts')->where('id',206)->get() ;

     foreach($listings as $info):

                         $title = json_decode($info->title,true)['en'];

                         $description = json_decode($info->description,true)['en'];

                         $gallery = json_decode($info->gallery,true);

                         $opening_hours = json_decode($info->opening_hour,true);

                         $phones = split_str([',','|',' '], str_replace(" ",'',$info->phone_no) );

                         $emails = split_str( [',','|',' '], str_replace(" ",'',$info->email) );

                         



                         $insert=
                         [
                              'id' => $info->id,
                              'url' => $info->unique_id,
                              'title' => $title,
                              'description' => strip_tags($description),
                              'tags' => $info->tags,
                              'category_id' => $info->category,
                              'products' => $info->products,
                              'physical_address' => $info->address,
                              'featured_image' => $info->featured_img,
                              'featured_video' => $info->video_url,
                              'hits' => $info->total_view,
                              'created_by' => $info->created_by,
                              'assign_to' => $info->assign_to,
                              'report' => $info->report,
                              'activation_date' => $info->activation_date,
                              'expiry_date' => $info->expirtion_date,
                              'create_time' => $info->create_time,
                              'publish_time' => $info->publish_time,
                              'last_update_time' => $info->last_update_time,
                              'report' => $info->report,
                              'status' => $info->status == 0 ? 'pending' : 'activated',
                              'meta_keywords' => $info->search_meta,
                              'featured' => $info->featured == 0 ? 'no' : 'yes',
                              'featured_expiration_date' => $info->featured_expiration_date,
                              'country' => $info->country,
                              'state' => $info->state,
                              'city' => $info->city,
                              'zip_code' => $info->zip_code,
                              'latitude' => $info->latitude,
                              'longitude' => $info->longitude,
                              'founded' => $info->founded,
                              'website' => $info->website,
                              'primary_phone' => $phones[0],
                              'other_phones' => str_replace(" ",'',$info->phone_no),
                              'primary_email' => $emails[0],
                              'other_emails' => str_replace(" ",'',$info->email),
                              



                         ];

                         // insert gallery and limit to 10 images
                         $check_meta = DB::table('dbc_post_meta')->where('post_id',$info->id)->exists();

                         if($check_meta)
                         {
                              $meta = DB::table('dbc_post_meta')->where('post_id',$info->id)->get() ;

                              foreach($meta as $data):
                                   if($data->key == 'facebook_profile')
                                   {
                                        $insert['facebook'] = $data->value;
                                   }
                                   elseif($data->key =='twitter_profile')
                                   {
                                        $insert['twitter'] = $data->value;;
                                   }
                                   elseif($data->key =='linkedin_profile')
                                   {
                                        $insert['linkedin'] = $data->value;;
                                   }
                                   elseif($data->key == 'business_logo')
                                   {
                                        $insert['business_logo'] = $data->value;;
                                   }
                              endforeach;

                         }
                         

                         $limit = count($gallery) > 10 ? 10 : count($gallery) ;
                         for($i = 1; $i <= $limit ; $i++):

                              $insert['image'.$i ] = $gallery[($i-1)];

                         endfor;

                         // insert opening hours

                         for($i = 0; $i < count($opening_hours) ; $i++):

                              $details = $opening_hours[$i];

                              if($details['closed'] == 0)
                              {
                                   $day = $details['day'];
                                   $start_time = $details['start_time'];
                                   $close_time = $details['close_time'];

                                   $insert[$day.'_status'] = 'open';
                                   $insert[$day.'_open_time'] = $details['start_time'];;
                                   $insert[$day.'_close_time'] = $details['close_time'];

                              }
                         endfor;

                         

                         $insert_param[]  = $insert;

                         DB::table('9jb_listings')->insert($insert);

endforeach;
                        // print_r($insert_param);

                         
$users = DB::table('dbc_users')->get() ;

     foreach($users as $info):

                        
                         



                         $update=
                         [
                              'name' => $info->last_name . ' '. $info->first_name,
                              'date_confirmed' => $info->confirmed_date,
                              'banned' => $info->banned > 0 ? 'yes' : 'no',
                              'access_token' => md5($info->last_name . ' '. $info->first_name.$info->user_email.microtime()),
                              'password' => '$2y$10$viDanEUGvYeLg3MXSDjR6O36iOcvrySmtYz2KOU2g8hQI2LbwKyjq'

                         ];

                         $update_param[] = $update;
                         DB::table('9jb_admins')->where('id',$info->id)->update($update);

endforeach;


     $users = DB::table('9jb_categories')->get() ;

     foreach($users as $info):

                        
                         

                         $update=
                         [
                              'url' => str_slug($info->title)

                         ];

                         $update_param[] = $update;

                         DB::table('9jb_categories')->where('id',$info->id)->update($update);

endforeach;

                         

                         print_r($update_param);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
