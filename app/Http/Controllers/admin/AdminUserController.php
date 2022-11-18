<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\IndUser;
use App\Models\Alert;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.addUser');
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
            'fName' => 'required',
            'mName' => 'required',
            'dob' => 'required',
            'bloodType' => 'required',
            'edu' => 'required',
            'spec' => 'required',
            'attr' => 'required',
            'lvl' => 'required',
            'prof' => 'required',
            'gen' => 'required',
            'region' => 'required',
            'address' => 'required',
            'postal' => 'required',
            'contact' => 'required',
            'tele' => 'required',
            'email' => 'required | email | unique:ind_users,email',
            'vat' => 'integer',
            'idNo' => 'required | integer',
            'active' => 'required',
            'password' => 'required | confirmed',
            'password_confirmation' => 'required',
            'dor' => 'required',
            'doo' => 'required',
            'school' => 'required',
            'register' => 'required',
            'city' => 'required',
            'regNo' => 'required',
            'langs' => 'required',
            'hrs' => 'integer',
            'cv' => 'max:1000 | mimes:pdf',
        ]);

        if($request->img != ""){
            $img = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $img);
        }else{
            $img = "";
        }

        if($request->cv != ""){
            $cv = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->cv->extension();
            $request->cv->move(public_path('images'), $cv);
        }else{
            $cv = "";
        }

        if($request->dob != ""){
            $dob = strtotime($request->dob);
            $dob = date('d-M-Y', $dob);
        }else{
            $dob = "";
        }

        if($request->dor != ""){
            $dor = strtotime($request->dor);
            $dor = date('d-M-Y', $dor);
        }else{
            $dor = "";
        }

        if($request->doo != ""){
            $doo = strtotime($request->doo);
            $doo = date('d-M-Y', $doo);
        }else{
            $doo = "";
        }

        $ind = IndUser::create([
            'name' => $request->name,
            'fname' => $request->fName,
            'mname' => $request->mName,
            'dob' => $dob,
            'bloodtype' => $request->bloodType,
            'edu' => $request->edu,
            'school' => $request->school,
            'spec' => $request->spec,
            'attr' => $request->attr,
            'lvl' => $request->lvl,
            'prof' => $request->prof,
            'gen' => $request->gen, 
            'vat' => $request->vat, 
            'idno' => $request->idNo,
            'passport' => $request->passport,
            'region' => $request->region,
            'address' => $request->address,
            'postal' => $request->postal,
            'contact' => $request->contact,
            'tele' => $request->tele,
            'email' => $request->email,
            'active' => $request->active,
            'password' => Hash::make($request->password),
            'status' => 1,
            'img' => $img,
            'dor' => $dor,
            'doo' => $doo,
            'register' => $request->register,
            'regno' => $request->regNo,
            'city' => $request->city,
            'languages' => $request->langs,
            'hours' => $request->hrs,
            'awards' => $request->awards,
            'penalties' => $request->penalties,
            'cv' => $cv,
            'part_status' => false,
        ]);
        
        if($ind){
            $al = Alert::create([
                'fromid' => 'admin',
                'from' => 'admin',
                'to1' => 'admin',
                'to2' => '',
                'to3' => $ind->id,
                'desc1' => 'Προσθέσατε έναν Εθελοντή '. $ind->name. '.',
                'desc2' => '',
                'desc3' => 'Ο λογαριασμός σας δημιουργήθηκε.',
            ]);
            return redirect()->back()->with(session()->flash('alert', 'Ο χρήστης προστέθηκε'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) //status change method
    {
        $user = IndUser::find($id);
        if($user){
            if($user->status == 1){
                $user->update([
                    $user->status = 0,
                ]);
                $al = Alert::create([
                    'fromid' => 'admin',
                    'from' => 'admin',
                    'to1' => 'admin',
                    'to2' => '',
                    'to3' => $user->id,
                    'desc1' => 'Έχετε απενεργοποιήσει έναν λογαριασμό εθελοντή '. $user->name. '.',
                    'desc2' => '',
                    'desc3' => 'Ο λογαριασμός σας απενεργοποιήθηκε.',
                ]);
            }else{
                $user->update([
                    $user->status = 1,
                ]);
                $al = Alert::create([
                    'fromid' => 'admin',
                    'from' => 'admin',
                    'to1' => 'admin',
                    'to2' => '',
                    'to3' => $user->id,
                    'desc1' => 'Έχετε ενεργοποιήσει έναν λογαριασμό εθελοντή '. $user->name. '.',
                    'desc2' => '',
                    'desc3' => 'Ο λογαριασμός σας ενεργοποιήθηκε.',
                ]);
            }
        }
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = IndUser::find($id);
        return view('admin.editUser', compact('user'));
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
            'fName' => 'required',
            'mName' => 'required',
            //'dob' => 'required',
            'bloodType' => 'required',
            'edu' => 'required',
            'spec' => 'required',
            'attr' => 'required',
            'lvl' => 'required',
            'prof' => 'required',
            'gen' => 'required',
            'region' => 'required',
            'address' => 'required',
            'postal' => 'required',
            'contact' => 'required',
            'tele' => 'required',
            'email' => 'required | email',
            'vat' => 'integer',
            'idNo' => 'required',
            'active' => 'required',
            //'dor' => 'required',
            //'doo' => 'required',
            'school' => 'required',
            'register' => 'required',
            'city' => 'required',
            'regNo' => 'required',
            'langs' => 'required',
            'hrs' => 'required',
            'cv' => 'max:1000 | mimes:pdf',
        ]);

        $ind = IndUser::find($id);

        if($request->img != ""){
            $img = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $img);
        }else{
            if($ind->img != ""){
                $img = $ind->img;
            }else{
                $img = "";
            }
        }

        if($request->cv != ""){
            $cv = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->cv->extension();
            $request->cv->move(public_path('images'), $cv);
        }else{
            if($ind->cv != ""){
                $cv = $ind->cv;
            }else{
                $cv = "";
            }
        }

        if($request->password != ""){
            $request->validate([
                'password' => 'confirmed',
                'password_confirmation' => 'required',
            ]);
            $ind->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if($request->dob != ""){
            $dob = strtotime($request->dob);
            $dob = date('d-M-Y', $dob);
        }else{
            $dob = $ind->dob;
        }

        if($request->dor != ""){
            $dor = strtotime($request->dor);
            $dor = date('d-M-Y', $dor);
        }else{
            $dor = $ind->dor;
        }

        if($request->doo != ""){
            $doo = strtotime($request->doo);
            $doo = date('d-M-Y', $doo);
        }else{
            $doo = $ind->doo;
        }

        $ind->update([
            'name' => $request->name,
            'fname' => $request->fName,
            'mname' => $request->mName,
            'dob' => $dob,
            'bloodtype' => $request->bloodType,
            'edu' => $request->edu,
            'school' => $request->school,
            'spec' => $request->spec,
            'attr' => $request->attr,
            'lvl' => $request->lvl,
            'prof' => $request->prof,
            'gen' => $request->gen, 
            'vat' => $request->vat, 
            'idno' => $request->idNo,
            'passport' => $request->passport,
            'region' => $request->region,
            'address' => $request->address,
            'postal' => $request->postal,
            'contact' => $request->contact,
            'tele' => $request->tele,
            'email' => $request->email,
            'active' => $request->active,
            'status' => 1,
            'img' => $img,
            'dor' => $dor,
            'doo' => $doo,
            'register' => $request->register,
            'regno' => $request->regNo,
            'city' => $request->city,
            'languages' => $request->langs,
            'hours' => $request->hrs,
            'awards' => $request->awards,
            'penalties' => $request->penalties,
            'cv' => $cv,
            'part_status' => false,
        ]);
        
        if($ind){
            $al = Alert::create([
                'fromid' => 'admin',
                'from' => 'admin',
                'to1' => 'admin',
                'to2' => '',
                'to3' => $ind->id,
                'desc1' => 'Επεξεργαστήκατε έναν Εθελοντή '. $ind->name. '.',
                'desc2' => '',
                'desc3' => 'Ο λογαριασμός σας τροποποιήθηκε.',
            ]);
            return redirect()->back()->with(session()->flash('alert', 'Ο χρήστης ενημερώθηκε'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = IndUser::find($id);
        if($user){
            $user->delete();
            if($user){
                $al = Alert::create([
                    'fromid' => 'admin',
                    'from' => 'admin',
                    'to1' => 'admin',
                    'to2' => '',
                    'to3' => '',
                    'desc1' => 'Διαγράψατε έναν Εθελοντή '. $user->name. '.',
                    'desc2' => '',
                    'desc3' => '',
                ]);
                return redirect()->back();
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }
    }
}
