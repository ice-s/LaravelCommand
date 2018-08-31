<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Backend\AdminSystem\AdminSystemService;

class TestController extends Controller
{
    private $testService;

    public function __construct(AdminSystemService $testService) {
        $this->testService = $testService;
    }

    public function index(){
        $data = $this->testService->testing();
        return json_encode($data);
    }
}
