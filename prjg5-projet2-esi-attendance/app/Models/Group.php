<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{

    /**
     * Method to count all the groups in the table 'groups'
     */
    public static function countAllGroups()
    {
        return DB::table( 'groups' )
        ->get()
        ->count();
    }

    /**
     * Method to get all groups in the database.
     */
    public static function findAllGroups()
    {
        $groups = DB::table('groups')
        ->get();
        return $groups;
    }

    /**
     * Method to get all groups in the database.
     *
     * @param name  The name of the group
     */
    public static function findGroup($name)
    {
        return DB::table('groups')
        ->where('name', '=', $name)
        ->get();
    }
}
