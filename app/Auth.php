<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail\Fastmail;

class Auth extends Model
{

public static function check() 
{

if(\Request::session()->has('biz_uid') && \Request::session()->has('biz_access_token'))
{

	$db_check = \DB::table('9jb_admins')->where('id',session('biz_uid'))
									->where('access_token',session('biz_access_token'))
									->exists();

	if($db_check) // check if session data is in database
	{
		return true; 
	}
	else
	{
		self::logout(); // logout false session
		return false;
	}
} 

else

return false;

}

public static function banned() 
{

if(self::check())
{

	return \DB::table('9jb_admins')->where('id',self::id())->value('banned') == 'yes' ? true : false ;

	
} 

else

return false;

}



public static function attempt($email,$password) 
{

	if(self::email_exist($email))
	{
		$user_password = self::get_password($email);
		return \Hash::check($password,$user_password) ? true : false ;
	}
	else
	return false;

}

public static function get_user_info($email) 
{

	return \DB::table('9jb_admins')->where('email',$email)->first();

}


public static function get_password($email) 
{

	return \DB::table('9jb_admins')->where('email',$email)->value('password');

}

public static function id() 
{

	
		return session('biz_uid');
	

}

public static function info($value) 
{

	return \DB::table('9jb_admins')->where('id',self::id())->value($value);
}

public static function is_admin($level = 0,$id = NULL) 
{
	$id = $id == NULL ? self::id() : $id;
	if($value == NULL)
	{
		return \DB::table('9jb_admins')->where('id',$id)
								->where('user_type','>',$level)
								->exists();
	}
	else
	{
		return \DB::table('9jb_admins')->where('id',$id)
								->where('user_type','>',$level)
								->exists();
	}

	return \DB::table('9jb_admins')->where('id',self::id())->value($value);
}

public static function higher_admin($id)
    {
        $my_user_type = \DB::table('9jb_admins')->where('id' ,self::id())->value('user_type');
        $user_type = \DB::table('9jb_admins')->where('id' ,$id)->value('user_type');

        return $my_user_type < $user_type ? true : false;


    }

public static function level()
{
  
    return self::info('user_type');


}

public static function email($user_id = NULL) 
{
	$uid = $user_id == NULL ? self::id() : $user_id;
	return \DB::table('9jb_admins')->where('id',$uid)->value('email');
}

public static function password() 
{

	return \DB::table('9jb_admins')->where('id',self::id())->value('password');
}

public static function rehash_password($email,$password) 
{
	$hashed_password = self::get_password($email);

	if (\Hash::needsRehash($hashed_password))
		{
			$new_hashed_password = bcrypt($password);

			\DB::table('9jb_admins')->where('email',$email)->update(['password' => $new_hashed_password]);
		}
	
}

public static function register_user() 
{

$data = \Request::only(['email','state','name','phone','password']);

	return  \DB::table('9jb_admins')->insert( 
							[
									'email' => $data['email'], 
									'password' => bcrypt($data['password']),
									'phone' => $data['phone'], 
									'name' => $data['name'],
									'access_token' => sha1(bcrypt($data['email']).$data['name'].time()),
									'api_access_token' => md5(bcrypt($data['email']).time().uniqid())

							]);

}

public static function send_signup_mail($email)
{
		
   		$user_info = self::get_user_info($email);
   		$subject = 'Welcome to 9jabusiness';

   		self::send_fast_mail($subject,$email,compact('user_info'),'email.signup','email.signup');
}


public static function create_new_password() 
{

	$data = \Request::only(['email','password','password_confirmation','reset_code']);

	return \DB::table('9jb_admins')->where('email',$data['email'])
							->where('reset_code',$data['reset_code'])
							->where('reset_code_expiry','>',now())
							->update( 
										[
											'password' =>  bcrypt($data['password_confirmation']), 
											'reset_code_expiry' => now(),
											'access_token' => sha1(bcrypt($data['email']).$data['reset_code'].time()),
											'api_access_token' => md5(bcrypt($data['email']).time().uniqid())
										]
									);


}



public static function create_session($email) 
{

	$user_info = self::get_user_info($email);

	return session([
				'biz_uid' => $user_info->id ,
				'biz_access_token' => $user_info->access_token 
			]); 

}

public static function email_exist($email) 
{

	return \DB::table('9jb_admins')->where('email',$email)->exists();

}

public static function logout() 
{

		\Request::session()->forget('biz_uid');
		\Request::session()->forget('biz_access_token');

}

public static function reset_code_expired($reset_code) 
{

	return \DB::table('9jb_admins')->where('reset_code',$reset_code)
								->where('reset_code_expiry','<',now())
								->exists();

}

public static function create_reset_code($email) 
{
	$expire = 60 * 60 * 30 ;
	return \DB::table('9jb_admins')->where('email',$email) 
							->update( 
										[
											'reset_code' => rand(222,456).rand(2222,4566).rand(444,888), 
											'reset_code_expiry' => date('Y-m-d h:i:s',(time() + $expire))
										]
									);

}

public static function send_reset_mail($email)
{
	
   		$user_info = self::get_user_info($email);
   		$subject = 'Reset your password - 9jabusiness';

   		self::send_fast_mail($subject,$email,compact('user_info'),'email.reset-code','email.reset-code');
}




public static function send_test_mail()
{
		$send_to = 'seunoni34@gmail.com' ;
   		$user_info = self::get_user_info('info@m9jabusiness.com');
   		$subject = 'Welcome to 9jabusiness';

   		//self::send_fast_mail($subject,$send_to,compact('user_info'),'email.signup','email.signup');

   		$subject = 'Reset your password - 9jabusiness';

   		self::send_fast_mail($subject,$send_to,compact('user_info'),'email.reset-code','email.reset-code');
}


public static function send_fast_mail($subject,$to,$data,$view ,$plain_view = NULL)
{

	return \Mail::to($to)->send(new \App\Mail\FastMail($subject,$data,$view,$plain_view));

}



public static function reset_email_match($email,$reset_code) 
{

	return \DB::table('9jb_admins')->where('email',$email)
							->where('reset_code',$reset_code)
							->where('reset_code_expiry','>',now())
							->exists();

}





}