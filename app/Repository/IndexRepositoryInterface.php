<?php

namespace App\Repository;

interface IndexRepositoryInterface
{
    public function index();
    public function postStore($request);

    public function commentStore($request);
}
