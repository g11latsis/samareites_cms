<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\rAdmins;
use App\Models\Alert;

class AdminRaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.addRa');
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
            //personal info
            'fname' => 'required',
            'lname' => 'required',
            'dob' => 'required',
            'bloodgroup' => 'required',
            'lvl' => 'required',
            'spec' => 'required',
            'attr' => 'required',
            'grade' => 'required',
            'gen' => 'required',
            'vat' => 'integer',
            'amka' => 'integer',
            'idno' => 'required | integer',
            'passport' => 'max:1000 | mimes:pdf', //r
            'memberid' => 'required',
            'status1' => 'required',
            'img' => 'max:1000', //r
            //address
            'address' => 'required',
            'postal' => 'required',
            'city' => 'required',
            'active' => 'required',
            //contact
            'contact' => 'required',
            'tele' => 'required',
            'email' => 'required | email | unique:r_admins,email',
            //edu
            'edu' => 'required',
            'school' => 'required',
            'degrees' => 'required',
            //eac training
            'eacdegree' => 'max:1000 | mimes:pdf',
            'eacdesctinproof' => 'max:1000 | mimes:pdf', //r
            'onlinetraicert' => 'max:1000 | mimes:pdf', //r
            'othertraicert' => 'max:1000 | mimes:pdf', //r
            //total hrs of volunteering
            'vhrs' => 'integer',
            'healthcarehrs' => 'integer',
            'rescuehrs' => 'integer',
            'nursinghrs' => 'integer',
            'sshrs' => 'integer',
            'traihrs' => 'integer',
            'cyvolunteeringhrs' => 'integer',
            'cyhealthhrs' => 'integer',
            'cyrescuehrs' => 'integer',
            'cynursinghrs' => 'integer',
            'cysshrs' => 'integer',
            'cytraininghrs' => 'integer',
            'cyeduhrs' => 'integer',
            //penalties r
            'doc' => 'max:1000 | mimes:pdf',
            //others
            'licenses' => 'max:1000 | mimes:pdf', //r
            'password' => 'required | confirmed',
            'password_confirmation' => 'required',
            'cv' => 'max:1000 | mimes:pdf',
            'region' => 'required',
        ]);

        if($request->img != ""){
            $img = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $img);
        }else{
            $img = "";
        }

        if($request->passport != ""){
            $passport = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->passport->extension();
            $request->passport->move(public_path('images'), $passport);
        }else{
            $passport = "";
        }

        if($request->eacdegree != ""){
            $eacdegree = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->eacdegree->extension();
            $request->eacdegree->move(public_path('images'), $eacdegree);
        }else{
            $eacdegree = "";
        }

        if($request->eacdesctinproof != ""){
            $eacdesctinproof = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->eacdesctinproof->extension();
            $request->eacdesctinproof->move(public_path('images'), $eacdesctinproof);
        }else{
            $eacdesctinproof = "";
        }

        if($request->onlinetraicert != ""){
            $onlinetraicert = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->onlinetraicert->extension();
            $request->onlinetraicert->move(public_path('images'), $onlinetraicert);
        }else{
            $onlinetraicert = "";
        }

        if($request->othertraicert != ""){
            $othertraicert = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->othertraicert->extension();
            $request->othertraicert->move(public_path('images'), $othertraicert);
        }else{
            $othertraicert = "";
        }

        if($request->doc != ""){
            $doc = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->doc->extension();
            $request->doc->move(public_path('images'), $doc);
        }else{
            $doc = "";
        }

        if($request->licenses != ""){
            $licenses = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->licenses->extension();
            $request->licenses->move(public_path('images'), $licenses);
        }else{
            $licenses = "";
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

        if($request->date != ""){
            $date = strtotime($request->date);
            $date = date('d-M-Y', $date);
        }else{
            $date = "";
        }

        $ra = new rAdmins;
         //personal info
        $ra->fname = $request->fname;
        $ra->lname = $request->lname;
        $ra->dob = $dob;
        $ra->bloodgroup = $request->bloodgroup;
        $ra->donor = $request->donor;
        $ra->lvl = $request->lvl;
        $ra->spec = $request->spec;
        $ra->attr = $request->attr;
        $ra->grade = $request->grade;
        $ra->gen = $request->gen;
        $ra->vat = $request->vat;
        $ra->doy = $request->doy;
        $ra->idno = $request->idno;
        $ra->passport = $passport;
        $ra->amka = $request->amka;
        $ra->memberid = $request->memberid;
        $ra->status1 = $request->status1;
        $ra->img = $img;
        //address
        $ra->address = $request->address;
        $ra->postal = $request->postal;
        $ra->city = $request->city;
        $ra->active = $request->active;
        //contact
        $ra->contact = $request->contact;
        $ra->tele = $request->tele;
        $ra->email = $request->email;
        //edu
        $ra->edu = $request->edu;
        $ra->school = $request->school;
        $ra->degrees = $request->degrees;
        //eac training
        $ra->eacspec = $request->eacspec;
        $ra->eacdegree = $eacdegree;
        $ra->eacdesctin = $request->eacdesctin;
        $ra->eacdesctinproof = $eacdesctinproof;
        $ra->onlinetrai = $request->onlinetrai;
        $ra->onlinetraicert = $onlinetraicert;
        $ra->othertrai = $request->othertrai;
        $ra->othertraicert = $othertraicert;
        //total hrs of volunteering
        $ra->vhrs = $request->vhrs;
        $ra->healthcarehrs = $request->healthcarehrs;
        $ra->rescuehrs = $request->rescuehrs;
        $ra->nursinghrs = $request->nursinghrs;
        $ra->sshrs = $request->sshrs;
        $ra->traihrs = $request->traihrs;
        //current year hrs
        $ra->cyvolunteeringhrs = $request->cyvolunteeringhrs;
        $ra->cyhealthhrs = $request->cyhealthhrs;
        $ra->cyrescuehrs = $request->cyrescuehrs;
        $ra->cynursinghrs = $request->cynursinghrs;
        $ra->cysshrs = $request->cysshrs;
        $ra->cytraininghrs = $request->cytraininghrs;
        $ra->cyeduhrs = $request->cyeduhrs;
        //penalties
        $ra->date = $date;
        $ra->type = $request->type;
        $ra->duration = $request->duration;
        $ra->desc = $request->desc;
        $ra->doc = $doc;
        //others
        $ra->spknow = $request->spknow;
        $ra->licenses = $licenses;
        $ra->password = Hash::make($request->password);
        $ra->cv = $cv;
        $ra->region = $request->region;
        $ra->save();

        if($ra){
            $al = Alert::create([
                'fromid' => 'admin',
                'from' => 'admin',
                'to1' => 'admin',
                'to2' => $ra->id,
                'to3' => '',
                'desc1' => 'Προσθέσατε έναν λογαριασμό Περιφερειακού Διαχειριστή '. $ra->fname. ' '. $ra->lname. '.',
                'desc2' => 'Ο λογαριασμός σας δημιουργήθηκε.',
                'desc3' => '',
            ]);
            return redirect()->back()->with(session()->flash('alert', 'Προστέθηκε ο περιφερειακός διαχειριστής'));
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
        $rg = rAdmins::find($id);
        if($rg){
            if($rg->status2 == 1){
                $rg->update([
                    $rg->status2 = 0,
                ]);
                $al = Alert::create([
                    'fromid' => 'admin',
                    'from' => 'admin',
                    'to1' => 'admin',
                    'to2' => $rg->id,
                    'to3' => '',
                    'desc1' => 'Έχετε απενεργοποιήσει έναν λογαριασμό περιφερειακού διαχειριστή '. $rg->fname. ' '. $rg->lname. '.',
                    'desc2' => 'Ο λογαριασμός σας απενεργοποιήθηκε.',
                    'desc3' => '',
                ]);
            }else{
                $rg->update([
                    $rg->status2 = 1,
                ]);
                $al = Alert::create([
                    'fromid' => 'admin',
                    'from' => 'admin',
                    'to1' => 'admin',
                    'to2' => $rg->id,
                    'to3' => '',
                    'desc1' => 'Έχετε ενεργοποιήσει έναν περιφερειακό λογαριασμό διαχειριστή '. $rg->fname. ' '. $rg->lname. '.',
                    'desc2' => 'Ο λογαριασμός σας ενεργοποιήθηκε.',
                    'desc3' => '',
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

        $ra = rAdmins::find($id);
        return view('admin.editRa', compact('ra'));
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
            //personal info
            'fname' => 'required',
            'lname' => 'required',
            //'dob' => 'required',
            'bloodgroup' => 'required',
            'lvl' => 'required',
            'spec' => 'required',
            'attr' => 'required',
            'grade' => 'required',
            'gen' => 'required',
            'vat' => 'integer',
            'amka' => 'integer',
            'idno' => 'required',
            'passport' => 'max:1000 | mimes:pdf', //r
            'memberid' => 'required',
            'status1' => 'required',
            'img' => 'max:1000', //r
            //address
            'address' => 'required',
            'postal' => 'required',
            'city' => 'required',
            'active' => 'required',
            //contact
            'contact' => 'required',
            'tele' => 'required',
            'email' => 'required | email',
            //edu
            'edu' => 'required',
            'school' => 'required',
            'degrees' => 'required',
            //eac training
            'eacdegree' => 'max:1000 | mimes:pdf',
            'eacdesctinproof' => 'max:1000 | mimes:pdf', //r
            'onlinetraicert' => 'max:1000 | mimes:pdf', //r
            'othertraicert' => 'max:1000 | mimes:pdf', //r
            //total hrs of volunteering
            'vhrs' => 'integer',
            'healthcarehrs' => 'integer',
            'rescuehrs' => 'integer',
            'nursinghrs' => 'integer',
            'sshrs' => 'integer',
            'traihrs' => 'integer',
            'cyvolunteeringhrs' => 'integer',
            'cyhealthhrs' => 'integer',
            'cyrescuehrs' => 'integer',
            'cynursinghrs' => 'integer',
            'cysshrs' => 'integer',
            'cytraininghrs' => 'integer',
            'cyeduhrs' => 'integer',
            //penalties r
            'doc' => 'max:1000 | mimes:pdf',
            //others
            'licenses' => 'max:1000 | mimes:pdf', //r
            'cv' => 'max:1000 | mimes:pdf',
            'region' => 'required',
        ]);

        $ra = rAdmins::find($id);
        
        if($request->img != ""){
            $img = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->img->extension();
            $request->img->move(public_path('images'), $img);
        }else{
            if($ra->img != ""){
                $img = $ra->img;
            }else{
                $img = "";
            }
        }

        if($request->passport != ""){
            $passport = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->passport->extension();
            $request->passport->move(public_path('images'), $passport);
        }else{
            if($ra->passport != ""){
                $passport = $ra->passport;
            }else{
                $passport = "";
            }
        }

        if($request->eacdegree != ""){
            $eacdegree = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->eacdegree->extension();
            $request->eacdegree->move(public_path('images'), $eacdegree);
        }else{
            if($ra->eacdegree != ""){
                $eacdegree = $ra->eacdegree;
            }else{
                $eacdegree = "";
            }
        }

        if($request->eacdesctinproof != ""){
            $eacdesctinproof = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->eacdesctinproof->extension();
            $request->eacdesctinproof->move(public_path('images'), $eacdesctinproof);
        }else{
            if($ra->eacdesctinproof != ""){
                $eacdesctinproof = $ra->eacdesctinproof;
            }else{
                $eacdesctinproof = "";
            }
        }

        if($request->onlinetraicert != ""){
            $onlinetraicert = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->onlinetraicert->extension();
            $request->onlinetraicert->move(public_path('images'), $onlinetraicert);
        }else{
            if($ra->onlinetraicert != ""){
                $onlinetraicert = $ra->onlinetraicert;
            }else{
                $onlinetraicert = "";
            }
        }

        if($request->othertraicert != ""){
            $othertraicert = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->othertraicert->extension();
            $request->othertraicert->move(public_path('images'), $othertraicert);
        }else{
            if($ra->othertraicert != ""){
                $othertraicert = $ra->othertraicert;
            }else{
                $othertraicert = "";
            }
        }

        if($request->doc != ""){
            $doc = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->doc->extension();
            $request->doc->move(public_path('images'), $doc);
        }else{
            if($ra->doc != ""){
                $doc = $ra->doc;
            }else{
                $doc = "";
            }
        }

        if($request->licenses != ""){
            $licenses = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->licenses->extension();
            $request->licenses->move(public_path('images'), $licenses);
        }else{
            if($ra->licenses != ""){
                $licenses = $ra->licenses;
            }else{
                $licenses = "";
            }
        }

        if($request->cv != ""){
            $cv = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->cv->extension();
            $request->cv->move(public_path('images'), $cv);
        }else{
            if($ra->cv != ""){
                $cv = $ra->cv;
            }else{
                $cv = "";
            }
        }

        if($request->password != ""){
            $request->validate([
                'password' => 'confirmed',
                'password_confirmation' => 'required',
            ]);
            $ra->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if($request->dob != ""){
            $dob = strtotime($request->dob);
            $dob = date('d-M-Y', $dob);
            $ra->update([
                'dob' => $dob,
            ]);
        }

        if($request->date != ""){
            $date = strtotime($request->date);
            $date = date('d-M-Y', $date);
            $ra->update([
                'date' => $date,
            ]);
        }

        $ra->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'bloodgroup' => $request->bloodgroup,
            'donor' => $request->donor,
            'lvl' => $request->lvl,
            'spec' => $request->spec,
            'attr' => $request->attr,
            'grade' => $request->grade,
            'gen' => $request->gen,
            'vat' => $request->vat,
            'doy' => $request->doy,
            'idno' => $request->idno,
            'passport' => $passport,
            'amka' => $request->amka,
            'memberid' => $request->memberid,
            'status1' => $request->status1,
            'img' =>$img,
            //address
            'address' => $request->address,
            'postal' => $request->postal,
            'city' => $request->city,
            'active' => $request->active,
            //contact
            'contact' => $request->contact,
            'tele' => $request->tele,
            'email' => $request->email,
            //edu
            'edu' => $request->edu,
            'school' => $request->school,
            'degrees' => $request->degrees,
            //eac training
            'eacspec' => $request->eacspec,
            'eacdegree' => $eacdegree,
            'eacdesctin' => $request->eacdesctin,
            'eacdesctinproof' => $eacdesctinproof,
            'onlinetrai' => $request->onlinetrai,
            'onlinetraicert' => $onlinetraicert,
            'othertrai' => $request->othertrai,
            'othertraicert' => $othertraicert,
            //total hrs of volunteering
            'vhrs' => $request->vhrs,
            'healthcarehrs' => $request->healthcarehrs,
            'rescuehrs' => $request->rescuehrs,
            'nursinghrs' => $request->nursinghrs,
            'sshrs' => $request->sshrs,
            'traihrs' => $request->traihrs,
            //current year hrs
            'cyvolunteeringhrs' => $request->cyvolunteeringhrs,
            'cyhealthhrs' => $request->cyhealthhrs,
            'cyrescuehrs' => $request->cyrescuehrs,
            'cynursinghrs' => $request->cynursinghrs,
            'cysshrs' => $request->cysshrs,
            'cytraininghrs' => $request->cytraininghrs,
            'cyeduhrs' => $request->cyeduhrs,
            //penalties
            'type' => $request->type,
            'duration' => $request->duration,
            'desc' => $request->desc,
            'doc' => $doc,
            //others
            'spknow' => $request->spknow,
            'licenses' => $licenses,
            'cv' => $cv,
            'region' => $request->region,
        ]);

        $al = Alert::create([
            'fromid' => 'admin',
            'from' => 'admin',
            'to1' => 'admin',
            'to2' => $ra->id,
            'to3' => '',
            'desc1' => 'Επεξεργαστήκατε έναν Περιφερειακό Διαχειριστή '. $ra->fname. ' '. $ra->lname. '.',
            'desc2' => 'Ο λογαριασμός σας τροποποιήθηκε.',
            'desc3' => '',
        ]);
        return redirect('/admin/ra')->with(session()->flash('alert', 'ο περιφερειακός διαχειριστής έχει υποστεί επεξεργασία'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rg = rAdmins::find($id);
        if($rg){
            $rg->delete();
            if($rg){
                $al = Alert::create([
                    'fromid' => 'admin',
                    'from' => 'admin',
                    'to1' => 'admin',
                    'to2' => $rg->id,
                    'to3' => '',
                    'desc1' => 'Διαγράψατε έναν Περιφερειακό Διαχειριστή '. $rg->fname. ' '. $rg->lname. '.',
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
