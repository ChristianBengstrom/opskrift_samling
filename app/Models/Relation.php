<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 09 Apr 2019 08:39:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Relation
 * 
 * @property int $o_id
 * @property int $i_id
 * @property float $qt
 * 
 * @property \App\Models\Opskrift $opskrift
 * @property \App\Models\Ingredien $ingredien
 *
 * @package App\Models
 */
class Relation extends Eloquent
{
	protected $table = 'relation';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'o_id' => 'int',
		'i_id' => 'int',
		'qt' => 'float'
	];

	protected $fillable = [
		'qt'
	];

	public function opskrift()
	{
		return $this->belongsTo(\App\Models\Opskrift::class, 'o_id');
	}

	public function ingredien()
	{
		return $this->belongsTo(\App\Models\Ingredien::class, 'i_id');
	}
}
