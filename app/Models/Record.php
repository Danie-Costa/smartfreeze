<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Record
 * 
 * @property int $id
 * @property int|null $company_id
 * @property int|null $device_id
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company|null $company
 * @property Device|null $device
 *
 * @package App\Models
 */
class Record extends Model
{
	protected $table = 'records';

	protected $casts = [
		'company_id' => 'int',
		'device_id' => 'int'
	];

	protected $fillable = [
		'company_id',
		'device_id',
		'description'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function device()
	{
		return $this->belongsTo(Device::class);
	}
}
