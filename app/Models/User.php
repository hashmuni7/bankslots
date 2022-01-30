<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property string|null $phonenumber
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $usercategoryid
 * 
 * @property Usercategory $usercategory
 * @property Collection|Marketvendor[] $marketvendors
 *
 * @package App\Models
 */
class User extends \Illuminate\Foundation\Auth\User
{
	protected $table = 'users';

	protected $casts = [
		'current_team_id' => 'int',
		'usercategoryid' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'two_factor_secret',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'two_factor_secret',
		'two_factor_recovery_codes',
		'remember_token',
		'current_team_id',
		'profile_photo_path',
		'phonenumber',
		'usercategoryid'
	];

	public function usercategory()
	{
		return $this->belongsTo(Usercategory::class, 'usercategoryid');
	}

	public function marketvendors()
	{
		return $this->hasMany(Marketvendor::class, 'registeredby');
	}
}
