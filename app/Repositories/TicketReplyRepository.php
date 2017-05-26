<?php

namespace L2\Repositories;


class TicketReplyRepository extends Repository
{
    public function model()
    {
        return 'L2\TicketReply';
    }

    public function canReply($ticketId)
    {
        return $this->model->isAllowedToReply($ticketId);
    }
}