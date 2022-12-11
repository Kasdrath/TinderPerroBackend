<?php

namespace App\Http\Controllers;

use App\Repositories\PerroRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;

class PerroController extends Controller
{
    protected PerroRepository $perroRepo;
    public function __construct(PerroRepository $perroRepo)
    {
        $this->perroRepo = $perroRepo;
    }

    public function listarPerros()
    {
        return $this->perroRepo->listarPerros();
    }
}
