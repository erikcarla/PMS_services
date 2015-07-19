<?php 

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class MsUser extends Model implements AuthenticatableContract, CanResetPasswordContract {
    use Authenticatable, CanResetPassword;
    /**
	* The database table used by the model.
	*
	* @var string
	*/
    protected $table = 'msuser';
	    /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
    protected $fillable = ['email', 'password', 'role_id', 'photo'];
	    /**
	* The attributes excluded from the model's JSON form.
	*
	* @var array
	*/
    protected $hidden = ['password'];

    public static function create_user($data)
    {
        $hasher = app()->make('hash');
    	
    	$user = new MsUser();
    	$user->email = $data['email'];
    	$user->password = $hasher->make($data['password']);
    	$user->role_id = $data['role_id'];
    	$user->save();
    }

	public static function delete_user($data)
    {
    	MsUser::where('id',$data['id'])
    	->delete();
    }

    public static function detail($id)
    {
    	return MsUser::where('id',$id)
    	->first();
    }

    public static function update_user($data)
    {
        $hasher = app()->make('hash');
    	MsUser::where('id',$data['id'])
    	->update(array(
			'email' => $data['email'],
			'password' => $hasher->make($data['password']),
			'role_id' => $data['role_id']
		));
    }
}
?>