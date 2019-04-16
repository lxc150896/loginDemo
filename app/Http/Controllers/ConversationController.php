<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Repositories\Contracts\ConversationRepository;
use App\Repositories\Contracts\GroupUserRepository;
use App\Http\Requests\IdRequest;
use App\Http\Requests\ConversationRequest;
use App\Events\NewMessageGroup;
use App\Model\Conversation;
use Auth;

class ConversationController extends Controller
{
    protected $conversationRepository;
    protected $groupUserRepository;

    public function __construct(ConversationRepository $conversationRepository, GroupUserRepository $groupUserRepository)
    {
        $this->conversationRepository = $conversationRepository;
        $this->groupUserRepository = $groupUserRepository;
    }

    public function store(IdRequest $request)
    {
        $user = auth()->user();
        $groupId = $request->id;
        $check = $this->groupUserRepository->countUserGroup($groupId, $user->id);
        if ($check == null) {
            $check == 0;
        }
        if ($user->id === $check->user_id) {
            $conversation = $this->conversationRepository->getMessageGroup($groupId);

            return response()->json($conversation);
        }else {
            return 'ok';
        }
    }

    public function update(ConversationRequest $request)
    {
        $data = [
            'message' => $request->text,
            'group_id' => $request->id,
            'user_id' => auth()->id()
        ];
        $conversation = $this->conversationRepository->create($data);
        broadcast(new NewMessageGroup($conversation));

        return $conversation->load('users');
    }
}
