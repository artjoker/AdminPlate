<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Backend\Users\Traits\LastSuperadmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Users\CreateRequest;
use App\Http\Requests\Backend\Users\UpdateRequest;
use App\Models\Role;
use App\Repositories\Contract\UserRepository;
use App\Services\Backend\User\Exception\LastSuperadminException;
use App\Services\Backend\User\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class UsersController.
 */
class UsersController extends Controller
{
    use LastSuperadmin;

    /**
     * @param UserRepository                         $userRepository
     * @param \App\Services\Backend\User\UserService $userService
     */
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserService $userService
    ) {
        $this->middleware(
            'permission:list admins',
            ['only' => ['index', 'show']]
        );
        $this->middleware(
            'permission:add admins',
            ['only' => ['create', 'store']]
        );
        $this->middleware(
            'permission:edit admins',
            ['only' => ['edit', 'update']]
        );
        $this->middleware('permission:delete admins', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        /** @var int $paginate */
        $paginate = config('app.limits.backend.pagination');

        return view(
            'backend.users.index',
            [
                'users'      => $this->userRepository->paginate(
                    $paginate,
                    (bool)auth()
                        ->user()
                        ?->can('delete admins')
                ),
                'permission' => 'admins',
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create(): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view(
            'backend.users.create',
            [
                'roles' => Role::pluck('name', 'id'),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $user = $this->userService->create($request->getDto());

        return redirect(
            $request->get('action') === 'continue'
                ? route('backend.users.edit', ['user' => $user])
                : route('backend.users.index')
        )->with('success', ['text' => __('backend.user_created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function edit(string $id)
    {
        return view(
            'backend.users.edit',
            [
                'user'  => $this->userRepository->getById($id),
                'roles' => Role::pluck('name', 'id'),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param string        $id
     *
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        try {
            $user = $this->userService->update($id, $request->getDto());
        } catch (LastSuperadminException $exception) {
            return back()->with(['danger' => ['text' => $exception->getMessage()]]);
        }

        return redirect(
            $request->get('action') === 'continue'
                ? route('backend.users.edit', ['user' => $user])
                : route('backend.users.index')
        )->with('success', ['text' => __('backend.user_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            $this->userService->delete($id);
        } catch (LastSuperadminException $exception) {
            return back()->with(['danger' => ['text' => $exception->getMessage()]]);
        }

        return redirect()
            ->route('backend.users.index')
            ->with('success', ['text' => __('backend.deleted')]);
    }

    /**
     * Restore deleted user.
     *
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function restore(string $id): RedirectResponse
    {
        $this->userService->restore($id);

        return redirect()
            ->route('backend.users.index')
            ->with('success', ['text' => 'User successfully restored']);
    }
}
