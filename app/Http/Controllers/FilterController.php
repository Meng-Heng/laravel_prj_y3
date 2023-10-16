<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function status_filter(Request $request)
{
    $filter = FilterModel::where('role', true);

    if ($request->has('1')) {
        $filter->where('role', $admin);
    }

    if ($request->has('2')) {
        $filter->where('role', $customer);
    }

     return $filter->get();

    return redirect('filter', ['filter' => $filter]);

}
}
