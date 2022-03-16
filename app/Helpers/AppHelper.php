<?php
namespace App\Helpers;

use Illuminate\Container\Container;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class AppHelper
{
    public static function roleName($name)
    {
        switch ($name) {
            case 'admin':case 'global_admin':
                return 'Administratorius';
                break;
            case 'manager':
                return 'Vadybininkas';
                break;
            case 'employee':
                return 'Darbuotojas';
                break;
        }
        return null;
    }

    public static function statusName($status)
    {
        switch ($status) {
            case 0:
                return 'Laukiama';
                break;
            case 1:
                return 'Vykdoma';
                break;
            case 2:
                return 'Užbaigta';
                break;
            case 3:
                return 'Atšaukta';
                break;
            case 4:
                return 'Neatlikta';
                break;
        }
        return null;
    }

    public static function statusColor($status)
    {
        switch ($status) {
            case 0:
                return 'gray-100';
                break;
            case 1:
                return 'blue-300';
                break;
            case 2:
                return 'green-300';
                break;
            case 3:
                return 'red-300';
                break;
            case 4:
                return 'red-500';
                break;
        }
        return null;
    }

    public static function paginate(Collection $results, $showPerPage, $paramName)
    {
        $pageNumber = Paginator::resolveCurrentPage('page');

        $totalPageNumber = $results->count();

        return self::paginator($results->forPage($pageNumber, $showPerPage), $totalPageNumber, $showPerPage, $pageNumber, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => $paramName,
        ]);

    }

    protected static function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }

    public static function checkPermission($permission)
    {
        if(!Auth::user()->can($permission)) abort(403);
    }

    public static function checkRole($role)
    {
        if(!Auth::user()->role($role)) abort(403);
    }
}
