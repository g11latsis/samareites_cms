<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\IndUser;
use App\Models\Alert;

class AdminServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.addService');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'regno' => 'required | integer',
            'date' => 'required',
            'type' => 'required',
            'locus' => 'required',
            'parts' => 'required',
            'strthrs' => 'required | date_format:H:i',
            'endhrs' => 'required | date_format:H:i',
            'ttlhrs' => 'required | integer',
            'parthrs' => 'required | integer',
        ]);

        $parts = $request->parts;
        foreach($parts as $part){
            $user = IndUser::find($part);
            if($user){
                $al = Alert::create([
                    'fromid' => 'admin',
                    'from' => 'admin',
                    'to1' => '',
                    'to2' => '',
                    'to3' => $user->id,
                    'desc1' => '',
                    'desc2' => '',
                    'desc3' => 'Έχετε εγγραφεί σε μια υπηρεσία.',
                ]);
                $user->update([
                    'part_status' => true,
                ]);
            }
        }

        $parts = implode(",", $request->parts);

        if($request->date != ""){
            $date = strtotime($request->date);
            $date = date('d-M-Y', $date);
        }else{
            $date = "";
        }

        $service = Service::create([
            'name' => $request->name,
            'regno' => $request->regno,
            'date' => $date,
            'type' => $request->type,
            'detail' => $request->exp,
            'veh' => $request->veh,
            'vehtype' => $request->vehtype,
            'driver' => $request->driver,
            'desc' => $request->desc,
            'locus' => $request->locus,
            'strthrs' => $request->strthrs,
            'endhrs' => $request->endhrs,
            'ttlhrs' => $request->ttlhrs,
            'parts' => $parts,
            'parthrs' => $request->parthrs,
            'region' => $request->region,
            'ra_id' => session('admin_id'),
        ]);

        $al = Alert::create([
            'fromid' => 'admin',
            'from' => 'admin',
            'to1' => 'admin',
            'to2' => '',
            'to3' => '',
            'desc1' => 'Προσθέσατε μια Υπηρεσία '. $service->name. '.',
            'desc2' => '',
            'desc3' => '',
        ]);

        return redirect()->back()->with(session()->flash('alert', 'Προστέθηκε ηυπηρεσία'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id) ?? '';
        return view('admin.editService', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'regno' => 'required | integer',
            'type' => 'required',
            'locus' => 'required',
            'parts' => 'required',
            'strthrs' => 'required | date_format:H:i',
            'endhrs' => 'required | date_format:H:i',
            'ttlhrs' => 'required | integer',
            'parthrs' => 'required | integer',
        ]);

        $parts = $request->parts;
        foreach($parts as $part){
            $user = IndUser::find($part);
            if($user){
                if($user->part_status != true){
                    $al = Alert::create([
                        'fromid' => 'admin',
                        'from' => 'admin',
                        'to1' => '',
                        'to2' => '',
                        'to3' => $user->id,
                        'desc1' => '',
                        'desc2' => '',
                        'desc3' => 'Έχετε εγγραφεί σε μια υπηρεσία.',
                    ]);
                }
                $user->update([
                    'part_status' => true,
                ]);
            }
        }

        $parts = implode(",", $request->parts);
        $service = Service::find($id);

        if($request->date != ""){
            $date = strtotime($request->date);
            $date = date('d-M-Y', $date);
        }else{
            $date = $service->date;
        }

        $service->update([
            'name' => $request->name,
            'regno' => $request->regno,
            'date' => $date,
            'type' => $request->type,
            'detail' => $request->exp,
            'veh' => $request->veh,
            'vehtype' => $request->vehtype,
            'driver' => $request->driver,
            'desc' => $request->desc,
            'locus' => $request->locus,
            'strthrs' => $request->strthrs,
            'endhrs' => $request->endhrs,
            'ttlhrs' => $request->ttlhrs,
            'parts' => $parts,
            'parthrs' => $request->parthrs,
            'region' => $request->region,
            'ra_id' => session('admin_id'),
        ]);

        $al = Alert::create([
            'fromid' => 'admin',
            'from' => 'admin',
            'to1' => 'admin',
            'to2' => '',
            'to3' => '',
            'desc1' => 'Επεξεργαστήκατε μια Υπηρεσία '. $service->name. '.',
            'desc2' => '',
            'desc3' => '',
        ]);

        return redirect()->back()->with(session()->flash('alert', 'Προστέθηκε ηυπηρεσία'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        if($service){
            $service->delete();
            $al = Alert::create([
                'fromid' => 'admin',
                'from' => 'admin',
                'to1' => 'admin',
                'to2' => '',
                'to3' => '',
                'desc1' => 'Διαγράψατε μια Υπηρεσία '. $service->name. '.',
                'desc2' => '',
                'desc3' => '',
            ]);
        }
        return redirect()->back();
    }
}
