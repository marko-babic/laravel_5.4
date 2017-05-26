<?php

namespace L2\Repositories;

class TicketRepository extends Repository
{
    public function model()
    {
        return 'L2\Ticket';
    }

    public function getAllWithRelationship()
    {
        return $this->model->with(['user','topic','replies','status'])->orderBy('created_at','desc')->get();
    }

    public function getById($id)
    {
        return $this->model->find($id)->with(['user', 'topic', 'replies', 'status']);
    }

    public function getUserTickets()
    {
        return $this->model->getAllUserTickets();
    }

    public function canSubmit()
    {
        return $this->model->cansubmit();
    }
}