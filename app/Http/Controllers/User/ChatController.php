<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\MessageRequest;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\MessageRepository;
use App\Events\NewMessage;
use App\Model\Message;

class ChatController extends Controller
{
    protected $userRepository;
    protected $messageRepository;

    public function __construct(UserRepository $userRepository, MessageRepository $messageRepository)
    {
        $this->userRepository = $userRepository;
        $this->messageRepository = $messageRepository;
    }

    public function getContact()
    {
        $id = auth()->id();
        $contacts = $this->userRepository->getUser($id);
        $unreadIds = $this->messageRepository->getUnreadId($id);

        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)
            ->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return response()->json($contacts);
    }

    public function getMessagesFor($id)
    {
        $userId = auth()->id();
        // $this->messageRepository->updateRead($id, $userId);
        $messages = $this->messageRepository->getMessages($id, $userId);

        return response()->json($messages);
    }

    public function sendMessage(MessageRequest $request)
    {
        $dataMessage = [
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text
        ];
        $message = $this->messageRepository->send($dataMessage);
        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}
