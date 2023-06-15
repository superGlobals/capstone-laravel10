<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

function customName($name) {
    $initial = strtoupper(substr($name, 0, 1));
    $lastName = substr($name, strpos($name, ' ') + 1);
    $fullName = ucwords($initial) . '.' . ucwords($lastName);

    return $fullName;
}

function checkRole($role) {
   return Auth::user()->role == $role;
}

function haha($type) {
    if($type == 'true_or_false') {
        return 'True or False';
    } elseif($type == 'fill_in_the_blank') {
        return 'Fill in the Blank';
    } elseif($type == 'multiple_choice') {
        return 'Multiple Choice';
    }

}