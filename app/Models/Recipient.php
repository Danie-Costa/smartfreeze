<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Recipient
 * 
 * @property int $id
 * @property int|null $company_id
 * @property string $name
 * @property string $phone
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company|null $company
 *
 * @package App\Models
 */
class Recipient extends Model
{
	protected $table = 'recipients';

	protected $casts = [
		'company_id' => 'int'
	];

	protected $fillable = [
		'company_id',
		'name',
		'phone'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}
}
