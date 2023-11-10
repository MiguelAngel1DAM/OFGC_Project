<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'Projects';
    protected $fillable = [
        'PlayListId',
        'Season', 
        'ProjectNote',
        'ProjectDateIni',
        'ProjectDateEnd',
        'ProjectRevision',];
}
