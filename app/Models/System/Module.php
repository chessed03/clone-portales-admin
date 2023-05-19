<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    const TABLE      = 'modules';

    const REMOVED    = 0;
    
    const ALIVE      = 1;

    public static function getModulesForMenu( $user_id )
    {
        $permissions_user   = Permission::getPermissions( $user_id );

        $modules_user       = [];

        $access_permissions = [];

        if ( $permissions_user ) {

            foreach ($permissions_user as $k => $permision) {

                $query = self::select('id', 'route')
                    ->where('id', $permision['module_id'])
                    ->where('status', self::ALIVE)
                    ->first();

                if ( $query ) {

                    array_push($modules_user, $query->id);

                    $access_permissions[$query->id] = (object)[
                        'module_route' => $query->route,
                        'module_id'    => intval($permision['module_id']),
                        'access'       => count($permision['write']) > 0
                    ];

                }

            }

            if ( !session()->get('access_permissions') ) {

                session()->put('access_permissions', $access_permissions);

            }

        }

        $permissions_modules_user = self::select('id', 'module_id', 'name', 'icon', 'route')
            ->whereIn('id', $modules_user)
            ->get()->toArray();

        $permissions_modules_menu = self::select('id', 'module_id', 'name', 'icon', 'route')
            ->whereNotIn('id', $modules_user)
            ->where('level', 1)
            ->where('status', self::ALIVE)
            ->get()->transform(function ($item, $key) {
                $item->route = '403';
                return $item;
            })->toArray();

        $menu_modules = array_merge( $permissions_modules_user, $permissions_modules_menu );

        $menu_sidebar = [];

        foreach ( $menu_modules as $s => $module) {

            $menu_sidebar['modules'][$module['module_id']]                   = self::select('id', 'name', 'icon')->where('id', $module['module_id'])->first();
            $menu_sidebar['submodules'][$module['module_id']][$module['id']] = $module;

        }

        if ( !session()->get('access_routes') ) {

            $routeCollection = Route::getRoutes();

            $item_routes = [];

            foreach ( $menu_modules as $a => $access) {

                $sessionAccess = session()->get('access_permissions');
                
                if ( $sessionAccess ) {

                    foreach ( $sessionAccess as $s => $routeAccess) {

                        if ( $access['route'] == $routeAccess->module_route ) {
    
                            if ( $routeAccess->access ) {
    
                                $keyAccess = explode('-', $access['route']);
    
                                foreach ($routeCollection as $route) {
    
                                    $keyRoute = explode('-', $route->getName());
    
                                    if ( $keyRoute[0] == $keyAccess[0] ) {
    
                                        array_push($item_routes, $route->getName());
    
                                    }
    
                                }
    
                            } else {
    
                                array_push( $item_routes, $access['route'] );
    
                            }
    
                        }
    
                    }

                }            

            }

            $access_routes = array_unique($item_routes);

            session()->put('access_routes', [
                $access_routes
            ]);
            
        }
        
        return $menu_sidebar;
    }

    public static function getAliveSubmodules()
    {
        $result = null;

        $query  = self::select('id', 'module_id', 'name', 'icon')
            ->where('level', 1)
            ->where('status', self::ALIVE)
            ->get();

        if ( $query ) {

            $menu = [];

            foreach ( $query as $q => $module) {

                $menu[$module->module_id][] = (object)[
                    'id'        => $module->id,
                    'module_id' => $module->module_id,
                    'name'      => $module->name
                ];

            }

            $permissions = [];

            foreach ( $menu as $m => $modules ) {

                $permissions[$m] = [
                    'menu_id'      => $m
                ];

                foreach ( $modules as $s => $module) {

                    $permissions[$m]['modules'][$s] = [
                        'module_id'   => $module->id,
                        'module_name' => $module->name
                    ];

                }

            }

            $result = $permissions;

        }

        return $result;

    }

}
