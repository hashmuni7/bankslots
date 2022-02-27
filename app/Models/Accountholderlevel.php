<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Accountholderlevel
 * 
 * @property int $accountholderlevelid
 * @property string $accountholderlevel
 * @property int $rank
 * 
 * @property Collection|Accountholder[] $accountholders
 *
 * @package App\Models
 */
class Accountholderlevel extends Model
{
	protected $table = 'accountholderlevel';
	protected $primaryKey = 'accountholderlevelid';
	public $timestamps = false;

	protected $casts = [
		'rank' => 'int'
	];

	protected $fillable = [
		'accountholderlevel',
		'rank'
	];

	public function accountholders()
	{
		return $this->hasMany(Accountholder::class, 'accountholderlevelid');
	}
}
