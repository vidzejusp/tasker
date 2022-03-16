<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function switch(Request $request)
    {
        //Auth::user()->update(['current_company', $request->company_id]);
        $user = Auth::user();
        $relation = Relation::where('company_id', $request->company_id)->where('user_id', $user->id)->first();
        if($relation)
        {
            $user->current_company = $request->company_id;
            $user->save();
            foreach($user->getRoleNames() as $role)
            {
                if(!str_contains($role, 'global_')) $user->removeRole($role);
            }
            $user->assignRole($relation->role);
        }
        return redirect()->route('dashboard');
    }
}
