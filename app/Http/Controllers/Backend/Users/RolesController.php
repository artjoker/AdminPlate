<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Users\CreateRole;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

/**
 * Class RolesController.
 */
class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list roles', ['only' => ['index']]);
        $this->middleware('permission:add roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit roles', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete roles', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(): \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application
    {
        /** @var int $paginate */
        $paginate = config('app.limits.backend.pagination');
        $roles    = Role::withCount('users')
            ->paginate($paginate);

        return view('backend.roles.index', [
            'roles'      => $roles,
            'permission' => 'roles',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create(): \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application
    {
        $permissions = Permission::get();

        return view('backend.roles.create', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRole $request
     *
     * @return RedirectResponse
     */
    public function store(CreateRole $request): RedirectResponse
    {
        $role = Role::create(['name' => $request->name, 'active' => isset($request->active)]);
        $role->syncPermissions($request->roles);
        $role->save();

        return redirect(
            $request->get('action') === 'continue'
                ? route('backend.roles.edit', ['role' => $role])
                : route('backend.roles.index')
        )->with('success', ['text' => __('backend.role_created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function edit(int $id): \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application
    {
        $role        = Role::findOrFail($id);
        $role        = Role::findByName($role->name);
        $permissions = Permission::all();

        return view('backend.roles.edit', [
            'role'        => $role,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateRole $request
     * @param int        $id
     *
     * @return RedirectResponse
     */
    public function update(CreateRole $request, int $id): RedirectResponse
    {
        $role         = Role::findOrFail($id);
        $role->name   = $request->string('name')->toString();
        $role->active = $request->boolean('active');
        $role->save();

        /** @var array<int> $roles */
        $roles = $request->roles;
        $role->syncPermissions($roles);

        return redirect(
            $request->get('action') === 'continue'
                ? route('backend.roles.edit', ['role' => $role])
                : route('backend.roles.index')
        )->with('success', ['text' => __('backend.role_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Role::destroy($id);

        return redirect()->route('backend.roles.index')
            ->with('success', ['text' => __('backend.role_deleted')]);
    }
}
