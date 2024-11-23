<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Device
 * 
 * @property int $id
 * @property int|null $company_id
 * @property string $title
 * @property string $description
 * @property string $cover
 * @property string $token
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company|null $company
 * @property Collection|Record[] $records
 *
 * @package App\Models
 */
class Device extends Model
{
	protected $table = 'devices';

	protected $casts = [
		'company_id' => 'int'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'company_id',
		'title',
		'description',
		'cover',
		'token',
		'status'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function records()
	{
		return $this->hasMany(Record::class);
	}
}
