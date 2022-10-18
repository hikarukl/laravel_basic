<?php


namespace App\Http\Controllers\Admin;


class DashboardController
{
    public function index()
    {
        $data = [
            'breadCrumb' => 'Dashboard'
        ];

        return view("admin.dashboard.index", $data);
    }
}
