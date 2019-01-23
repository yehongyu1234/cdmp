<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Project\Entities\Building;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $feild=Building::paginate(10);
        return view('project::bindex',compact('feild'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('project::bcreate');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //dd($request->get('buildingid'));
        $building = new Building;
        $building->project_id = $request->get('projectid');
        $building->buildingid = $request->get('buildingid');
        $building->floors= $request->get('floors');
        $building->structure_type= $request->get('structure_type');
        $building->area = $request->get('area');
        $building->sameas = $request->get('sameas');
        $building->floor_height=$request->get('floor_height');
        if ($building->save()) {
            return view('project::index');
        } else {
            return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request,$building_id)
    {
        $field=Building::where('id',$building_id)->first();
        //dd($field->buildingid);
        return view('project::bview',compact('field'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('project::edit');
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
