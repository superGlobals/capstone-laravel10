<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number', 
        'image',
        'class_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class);
    }

    public static function deleteOldImage($fileName, $folderName) 
    {
        $imagePath = public_path()."/$folderName/";
        $image = $imagePath . $fileName;

        if(file_exists($image)) {
            @unlink($image);
        }
    }

    // public function getImage($image) 
    // {
    //     if(file_exists() {
    //         return asset('students_image'. $image);
    //     } 

    //     return asset('images/default.jpg');
    // }

    // protected function id_number(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => strtoupper($value)
    //     );
    // }
}
