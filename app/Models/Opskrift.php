<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Apr 2019 08:39:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Opskrift
 *
 * @property int $id
 * @property string $navn
 * @property \Carbon\Carbon $tid
 * @property string $beskrivelse
 *
 * @property \Illuminate\Database\Eloquent\Collection $relations
 *
 * @package App\Models
 */
class Opskrift extends Eloquent
{
	protected $table = 'opskrift';
	public $timestamps = false;

	// protected $dates = [
	// 	'tid'
	// ];

	protected $fillable = [
		'navn',
		'tid',
		'beskrivelse'
	];

	public function relations()
	{
		return $this->hasMany(\App\Models\Relation::class, 'o_id');
	}
}
