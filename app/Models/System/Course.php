<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Course extends Model
{

    use HasFactory;

    protected $table = 'courses';

    const TABLE      = "courses";

    const REMOVED    = 0;

    const ALIVE      = 1;


    # Relationship polymorphic
    public function notices()
    {
        
        return $this->morphMany(Notice::class, 'noticeable');

    }

    public static function findNoticeById( $id )
    {
        
        return Notice::findNoticeById( $id , self::class );
        
    }

    public static function getAliveCoursesForView($keyWord, $paginateNumber, $orderBy)
    {
        $schools = ___getPermissionUser()->schools;

        $result = null;

        $query = self::whereRaw('status = "' . self::ALIVE . '"');

        $query->whereRaw('name LIKE "' . $keyWord . '"');

        if ($orderBy == 1) {

            $query->orderByRaw('name ASC');

        }

        if ($orderBy == 2) {

            $query->orderByRaw('name DESC');

        }

        if ($orderBy == 3) {

            $query->orderByRaw('created_at DESC');

        }

        if ($orderBy == 4) {

            $query->orderByRaw('created_at ASC');

        }

        $collection = $query->paginate($paginateNumber);

        if ($collection) {

            $result = $collection;

        }

        return $result;
    }

    public static function getAliveSchools()
    {
        $shoolsPermissions = ___getPermissionUser()->write;

        return School::getAliveSchoolsByArrayId($shoolsPermissions);
    }

    public static function validateCourseName($name, $id)
    {

        $result = null;

        $query = DB::table(self::TABLE);

        if ($id) {

            $query->where('id', '!=', $id);

        }

        $query->where('name', $name);

        $query->where('status', self::ALIVE);

        $rows = $query->count();

        if ($rows) {

            $result = $rows;

        }

        return $result;

    }

    public static function createItem($data)
    {

        $item              = new self();
        $item->name        = $data->name;
        $item->description = $data->description;
        $item->start_date  = $data->start_date;
        $item->finish_date = $data->finish_date;
        $item->location    = $data->location;
        $item->image_url   = $data->image_url;
        $item->created_by  = auth()->user()->id . "-" . auth()->user()->name;


        if ($item->save()) {

            Binnacle::binnacleRegister('create', self::TABLE, 'course', $item->id);

           //Notice::launchNoticeById( $item->id, self::class, $data->launch_notice, $item->created_by );
            
           if ( !is_null($data->launch_notice) ) {
                
                self::find($item->id)->notices()->create([

                    'start_date' => $item->start_date,
                    'created_by' => $item->created_by

                ]);

            }
                        
            return true;

        }

        return false;

    }

    public static function updateItem($data)
    {

        $item              = self::where('id', $data->id)->first();
        $item->name        = $data->name;
        $item->description = $data->description;
        $item->start_date  = $data->start_date;
        $item->finish_date = $data->finish_date;
        $item->location    = $data->location;
        $item->image_url   = $data->image_url;

        if ($item->update()) {

            Binnacle::binnacleRegister('update', self::TABLE, 'course', $item->id);

            //Notice::launchNoticeById( $data->id, self::class, $data->launch_notice, $item->created_by );

            $notice = $item->notices()
                ->where('noticeable_id', $data->id)
                ->where('noticeable_type', self::class)
                ->first();

            if ( is_null( $notice ) ) {

                if ( !is_null($data->launch_notice) ) {
                
                    self::find($item->id)->notices()->create([
                        
                        'start_date' => $item->start_date,
                        'created_by' => $item->created_by
        
                    ]);
    
                }

            } else {
                                
                $notice->status     = ( is_null($data->launch_notice) ) ? self::REMOVED : self::ALIVE ;

                $notice->start_date = $data->start_date;

                $notice->update();               

            }

            return true;

        }

        return false;
    }

}
