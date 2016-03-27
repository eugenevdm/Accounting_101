<?php

namespace App\Http\ViewComposers;

use App\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class GlobalComposer {

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $company = Company::where('selected',true)->first();
        $view->with('company', $company);
    }

}