<?php
/**
* Author: German Mendoza
* Twitter: german0296 
* Description: modelo para tabla barrios, esta tabla se encarga de representar los barrios de Madrid
*/
namespace App;

use Illuminate\Database\Eloquent\Model;

class Barrio extends Model
{
    protected $table = 'barrios';

    protected $fillable = array('postal_code', 'name', 'url_name');

    public function setUpdatedAtAttribute($value)
    {
        // to Disable updated_at
    }
}
