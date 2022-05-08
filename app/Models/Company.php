<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = "tbl_companies";

    /**
     * The attributes that are guarded from mass assign.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, boolean>
     */
    protected $fillable = [
        'name',
        'email',
        'website',
        'logo',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($company) {
            $company->employees()->delete();
        });
    }
}
