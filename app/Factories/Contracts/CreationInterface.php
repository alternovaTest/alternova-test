<?php

namespace App\Factories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface CreationInterface
{
    public function Create(array $data): Model;
}
