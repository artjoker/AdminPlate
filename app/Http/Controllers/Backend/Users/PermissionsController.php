<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

/**
 * Class PermissionsController.
 */
class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list permissions', ['only' => ['index']]);
        $this->middleware('permission:add permissions', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit permissions', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete permissions', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        /** @var int $paginate */
        $paginate    = config('app.limits.backend.pagination');
        $permissions = Permission::paginate($paginate);

        return view('backend.permissions.index', [
            'permissions' => $permissions,
            'permission'  => 'permissions',
        ]);
    }
}
