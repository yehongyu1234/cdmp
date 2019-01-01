<?php

namespace Modules\Setting\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Design\Entities\Work;
use Modules\Setting\Entities\Company;
use Yajra\DataTables\DataTables;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $comdata=Company::all();
        return view('setting::index');
    }
    #获取ajax列表
    public function getlist() {
        $field = Company::select(['id', 'name', 'location', 'zhizhao','connectorid','com_code','type','location','history','marketmanager_id']);
        $data= DataTables::of($field)->make();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user=User::where("name","<>","Admin")->get();
        $company=Company::all();
        $designtype=Work::all();
        return view('setting::companycreate',compact('user','designtype','company'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}