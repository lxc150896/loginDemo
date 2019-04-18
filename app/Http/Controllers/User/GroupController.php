<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Repositories\Contracts\GroupRepository;
use App\Repositories\Contracts\UserRepository;
use App\Model\Group;
use App\Model\User;
use Auth;
use App\Events\GroupCreated;

class GroupController extends Controller
{
    protected $groupRepository;
    protected $userRepository;

    public function __construct(GroupRepository $groupRepository, UserRepository $userRepository)
    {
        $this->groupRepository = $groupRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $group = $this->userRepository->getUserGroup(auth()->id());
        foreach ($group as $key => $value) {
            $groupsUser =  $value->groups;
        }
        return $groupsUser;
    }

    public function store(MessageRequest $request)
    {
        $data = [
            'name' => $request->text
        ];
        $group = $this->groupRepository->create($data);
        $group->users()->attach(auth()->id());
        broadcast(new GroupCreated($group))->toOthers();

        return $group;
    }
}
