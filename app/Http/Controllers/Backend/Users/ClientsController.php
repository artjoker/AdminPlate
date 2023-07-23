<?php

namespace App\Http\Controllers\Backend\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Clients\StoreRequest;
use App\Repositories\Contract\ClientRepository;
use App\Services\Backend\Client\ClientService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

/**
 * Class ClientsController.
 */
class ClientsController extends Controller
{
    /**
     * @param \App\Repositories\Contract\ClientRepository $clientRepository
     * @param \App\Services\Backend\Client\ClientService  $clientService
     */
    public function __construct(
        protected ClientRepository $clientRepository,
        private readonly ClientService $clientService
    ) {
        $this->middleware('permission:list clients', ['only' => ['index']]);
        $this->middleware(
            'permission:add clients',
            ['only' => ['create', 'store']]
        );
        $this->middleware('permission:view clients', ['only' => ['show']]);
        $this->middleware(
            'permission:edit clients',
            ['only' => ['edit', 'update']]
        );
        $this->middleware(
            'permission:delete clients',
            ['only' => ['destroy', 'restore']]
        );
    }

    /**
     * @param string $client
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(string $client): Renderable
    {
        return view(
            'backend.clients.show',
            [
                'client'     => $this->clientRepository->getById($client),
                'permission' => 'clients',
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): Renderable
    {
        /** @var int $paginate */
        $paginate = config('app.limits.backend.pagination');

        return view(
            'backend.clients.index',
            [
                'clients'    => $this->clientRepository->paginate(
                    $paginate,
                    (bool)auth()
                        ->user()
                        ?->can('delete clients')
                ),
                'permission' => 'clients',
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(): Renderable
    {
        return view(
            'backend.clients.create',
            [
                'partners' => [],
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $client = $this->clientService->create($request->getDto());

        return redirect(
            $request->get('action') === 'continue'
                ? route('backend.clients.edit', ['client' => $client])
                : route('backend.clients.index')
        )->with('success', ['text' => __('backend.client_created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $client
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(string $client): Renderable
    {
        return view(
            'backend.clients.edit',
            [
                'client'   => $this->clientRepository->getById($client),
                'partners' => [],
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @param string       $id
     *
     * @return RedirectResponse
     */
    public function update(
        StoreRequest $request,
        string $id
    ): RedirectResponse {
        $client = $this->clientService->update($id, $request->getDto());

        return redirect(
            $request->get('action') === 'continue'
                ? route('backend.clients.edit', ['client' => $client])
                : route('backend.clients.index')
        )->with('success', ['text' => __('backend.client_updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $client
     *
     * @return RedirectResponse
     */
    public function destroy(string $client): RedirectResponse
    {
        $this->clientService->delete($client);

        return redirect(route('backend.clients.index'))
            ->with('success', ['text' => __('backend.deleted')]);
    }

    /**
     * Restore deleted user.
     *
     * @param string $client
     *
     * @return RedirectResponse
     */
    public function restore(string $client): RedirectResponse
    {
        $this->clientService->restore($client);

        return redirect()
            ->route('backend.clients.index')
            ->with('success', ['text' => __('backend.success_title')]);
    }
}
