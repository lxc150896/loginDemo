<?php

namespace App\Repositories\Eloquents;

use App\Model\Conversation;
use App\Repositories\Contracts\ConversationRepository;

class ConversationEloquentRepository extends AbstractEloquentRepository implements ConversationRepository
{
    public function getModel()
    {
        return \App\Model\Conversation::class;
    }

    public function getMessageGroup($id)
    {
    	return $this->_model
    	->where('group_id', $id)
    	->get();
    }
}
