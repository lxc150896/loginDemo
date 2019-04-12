<?php

namespace App\Repositories\Eloquents;

use App\Model\Message;
use App\Repositories\Contracts\MessageRepository;

class MessageEloquentRepository extends AbstractEloquentRepository implements MessageRepository
{
    public function getModel()
    {
        return \App\Model\Message::class;
    }

    public function getMessages($id, $userId)
    {
    	return $this->_model
    	->where(function($q) use ($id, $userId) {
            $q->where('from', $userId);
            $q->where('to', $id);
        })->orWhere(function($q) use ($id, $userId) {
            $q->where('from', $id);
            $q->where('to', $userId);
        })
        ->get();
    }

    public function updateRead($id, $userId)
    {
    	$this->_model
    	->where('from', $id)
    	->where('to', $userId)
    	->update(['read' => true]);
    }

    public function getUnreadId($id)
    {
    	return $this->_model
    	->select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
    	->where('to', $id)
    	->where('read', false)
    	->groupBy('from')
    	->get();
    }

    public function send($data)
    {
    	return $this->_model
    	->create($data);
    }
}
