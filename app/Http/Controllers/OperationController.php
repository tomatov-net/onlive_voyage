<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Operations;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    use Operations;

    public function index()
    {
        return view('operations.index');
    }

    public function calc(Request $request)
    {
        $result = [
            'result' => '',
            'message' => '',
        ];

        if($request->number1 !== null && $request->number2 !== null && $request->operation){
            $result = $this->calculate($request->number1, $request->number2, $request->operation);
        }

        return response()->json(['message' => $result['message'], 'result' => $result['result']]);
    }
}
