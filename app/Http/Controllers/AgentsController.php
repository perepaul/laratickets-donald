<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Requests\AgentUpdateRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class AgentsController extends RegisteredUserController
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @param Request $request
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(Request $request): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $query = User::query();

        $agents = $query->where('role', User::$support_agent)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('agents.index', ['agents' => $agents]);
    }

    /**
     * @param User $agent
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function edit(User $agent): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('agents.edit', ['agent' => $agent]);
    }


    /**
     * @param AgentUpdateRequest $request
     * @param User $agent
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function update(AgentUpdateRequest $request, User $agent): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $agent->update($request->validated());
        return redirect(route('agents.index'));
    }


    /**
     * @param AgentUpdateRequest $request
     * @param User $agent
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function updatePassword(AgentUpdateRequest $request, User $agent): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $agent->update($request->validated());
        return redirect(route('agents.index'));
    }


    /**
     * @param User $agent
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function destroy(User $agent): View|\Illuminate\Foundation\Application|Factory|Application
    {
        $agent->delete();
        return redirect(route('agents.index'));
    }
}
