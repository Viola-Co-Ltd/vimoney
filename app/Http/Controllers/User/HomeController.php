<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\requestMoney;
use Illuminate\Support\Facades\Validator;
use App\Rules\validatorPhone;
use App\Rules\validatorIndentityCard;

class HomeController extends Controller
{
    /**
     * register request money
     * param: name, indetityCart, phone, money
     */
    public function registerRequestMoney(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'indentityCard' => ['required', new validatorIndentityCard()],
            'phone' => ['required', new validatorPhone()]
        ]);
        if ($validator->fails()){
            return ['errors' => true, 'messages' => $validator->errors()];
        }else{
            $requestMoney = requestMoney::create([
                'full_name' => $request->name,
                'phone' => $request->phone,
                'indentity_card' => $request->indentityCard,
                'money' => $request->money
                
            ]);
            return ['errors' => false];
        }
    }
}
