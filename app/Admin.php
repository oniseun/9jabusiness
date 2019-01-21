<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public static function expected_input($action)
{
    $input =    [
                    'store' => ['email','sex','name','phone'],
                    'info_update' => ['email','sex','name','phone','about'],
                    'ban_admin' => ['id'],
                    'photo_update' => ['photo'],
                    'password_update' => ['old','new','new_confirmation']

                ];

    return $input[$action];
}

public static function info($uid) 
{

	return \DB::table('9jb_admins')->where('id',$uid)->first();

}

public static function info_public($url) 
{

	return \DB::table('9jb_admins')->select(\DB::raw('id,url,name,phone,email,photo'))->where('url',$url)->first();

}

public static function get_list() 
{

	return \DB::table('9jb_admins')->select(\DB::raw('*,(SELECT count(*) FROM `9jb_listings` WHERE `9jb_listings`.created_by = `9jb_admins`.id) as listing_count '))->get();

}

public static function banned_list() 
{

	return \DB::table('9jb_admins')->where('banned','yes')->get();

}

public static function create_admin($created_by,$level) 
{

	$data = \Request::only(self::expected_input('store'));

	$default_password = 'password';

	$data['created_by'] = $created_by;
	$data['user_type'] = $level + 1;
	$data['url'] = str_slug($data['name']) ;
	$data['photo'] = 'uploads/profile_photos/nophoto-'.$data['sex'].'.jpg'; 
	$data['password'] = bcrypt($default_password);
	$data['access_token'] = md5(bcrypt($data['email']).time().uniqid());
	$data['date_created'] = now();


	return \DB::table('9jb_admins')->insert($data);

}

public static function ban($created_by) 
{

	$data = \Request::only(self::expected_input('ban_admin'));
	$update_param['banned'] = 'yes';
	$update_param['banned_by'] = $created_by;
	return \DB::table('9jb_admins')->where('id',$data['id']) 
							->update($update_param);

}

public static function unban() 
{

	$data = \Request::only(self::expected_input('ban_admin'));
	$update_param['banned'] = 'no';
	$update_param['banned_by'] = NULL;
	return \DB::table('9jb_admins')->where('id',$data['id']) 
							->update($update_param);

}

public static function update_info($uid) 
{

	$data = \Request::only(self::expected_input('info_update'));

	return \DB::table('9jb_admins')->where('id',$uid) 
							->update($data);

}

public static function update_picture($uid) 
{
	$upload_folder = 'uploads/images/'.date("Y/m");
	$user_name = self::info($uid)->name;
	$extension = \Request::file('photo')->extension();
	$new_name = str_slug($user_name.microtime().rand(111,666));	
	$full_file_name = "$new_name.$extension";

	$data['photo'] = \Request::file('photo')->storeAs($upload_folder,$full_file_name,'uploads');

	return \DB::table('9jb_admins')->where('id',$uid) 
							->update( $data);

}

public static function update_password($uid) 
{

$data = \Request::only(self::expected_input('password_update'));

	return \DB::table('9jb_admins')->where('id',$uid) 
							->update( 
							[

								'password' => bcrypt($data['new']), 
								'access_token' => sha1(bcrypt(Auth::email()).$data['new'].time()),

							]);


}



}
