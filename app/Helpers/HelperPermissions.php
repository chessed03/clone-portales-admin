<?php

use App\Models\System\Permission;
use Illuminate\Support\Facades\Auth;

function ___routeArmored()
{

    session()->forget('route_name');

    $route_name = Route::currentRouteName();

    session()->put('route_name', $route_name);

    if ( !session()->get('access_routes') ) {

        return redirect()->route('home');

    }

    $result = (object)[
        'route_name'    => session()->get('route_name'),
        'routes_access' => session()->get('access_routes')[0]
    ];

    return $result;

}

function ___getAccess( $request, $next, $access_route )
{

    if ( !isset($access_route->route_name) ) {

        return redirect()->route('home');

    }

    if( !in_array( $access_route->route_name, $access_route->routes_access ) ) {

        return redirect()->route('403');

    }

    return $next($request);

}

function ___getPermissionUser()
{

    $result            = null;

    $route             = explode('-', session()->get('route_name'));

    $route_key         = array_search(end($route), $route);

    $route[$route_key] = 'index';

    $route_name        = implode('-', $route);

    $id                = Auth::id();

    $permission        = Permission::getPermissions( $id );

    $key_access        = 0;

    foreach ( session()->get('access_permissions') as $p => $key_permission ) {

        if ( $key_permission->module_route === $route_name ) {

            $key_access = $key_permission->module_id;

        }

    }

    $module     = session()->get('access_permissions')[ $key_access ];

    $access     = $permission[ array_search( $module->module_id, array_column($permission, 'module_id') ) ];

    if ( $access ) {

        $result = (object)[
            'read'    => $access['read'],
            'write'   => $access['write'],
            'schools' => array_merge( $access['read'], $access['write'] )
        ];

    }

    return $result;
}

function ___getAccessButton( $schools )
{

    $permissions = ___getPermissionUser()->write;

    $result = false;

    if ( !empty( $schools ) ) {

        foreach ( $permissions as $p => $permission ) {

            if ( in_array( $permission, $schools ) ) {

                $result = true;

            }

        }

    } else {

        $result = count( $permissions ) > 0;

    }

    return $result;

}

function ___getNameSchools( $schools )
{

    $result = Permission::getDataSchool( $schools );

    $new_result = [];

    foreach ( $result as $key => $item) {

        $data_site = Permission::getDataSite( $item->id );

        $new_result[$key] = (object)[
            'name'        => $item->name,
            'server_name' => ( $data_site ) ? 'https://' . $data_site->server_name : false
        ];

    }

    return $new_result;
}
