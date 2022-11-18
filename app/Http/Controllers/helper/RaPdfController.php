<?php

namespace App\Http\Controllers\helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rAdmins;

class RaPdfController extends Controller
{
    public function update(Request $request, $id)
    {
        if($request->hasFile("passport")){
            $request->validate([
                'passport' => 'required',
            ]);

            if($request->passport != ""){
                $passport = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->passport->extension();
                $request->passport->move(public_path('images'), $passport);
            }else{
                $passport = "";
            }
            
            $ra = rAdmins::find($id);
            $ra->update([
                'passport' => $passport,
            ]);
        }

        if($request->hasFile("eacdegree")){
            $request->validate([
                'eacdegree' => 'required',
            ]);

            if($request->eacdegree != ""){
                $eacdegree = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->eacdegree->extension();
                $request->eacdegree->move(public_path('images'), $eacdegree);
            }else{
                $eacdegree = "";
            }
            
            $ra = rAdmins::find($id);
            $ra->update([
                'eacdegree' => $eacdegree,
            ]);
        }

        if($request->hasFile("eacdesctinproof")){
            $request->validate([
                'eacdesctinproof' => 'required',
            ]);

            if($request->eacdesctinproof != ""){
                $eacdesctinproof = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->eacdesctinproof->extension();
                $request->eacdesctinproof->move(public_path('images'), $eacdesctinproof);
            }else{
                $eacdesctinproof = "";
            }
            
            $ra = rAdmins::find($id);
            $ra->update([
                'eacdesctinproof' => $eacdesctinproof,
            ]);
        }

        if($request->hasFile("onlinetraicert")){
            $request->validate([
                'onlinetraicert' => 'required',
            ]);

            if($request->onlinetraicert != ""){
                $onlinetraicert = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->onlinetraicert->extension();
                $request->onlinetraicert->move(public_path('images'), $onlinetraicert);
            }else{
                $onlinetraicert = "";
            }
            
            $ra = rAdmins::find($id);
            $ra->update([
                'onlinetraicert' => $onlinetraicert,
            ]);
        }

        if($request->hasFile("othertraicert")){
            $request->validate([
                'othertraicert' => 'required',
            ]);

            if($request->othertraicert != ""){
                $othertraicert = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->othertraicert->extension();
                $request->othertraicert->move(public_path('images'), $othertraicert);
            }else{
                $othertraicert = "";
            }
            
            $ra = rAdmins::find($id);
            $ra->update([
                'othertraicert' => $othertraicert,
            ]);
        }

        if($request->hasFile("doc")){
            $request->validate([
                'doc' => 'required',
            ]);

            if($request->doc != ""){
                $doc = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->doc->extension();
                $request->doc->move(public_path('images'), $doc);
            }else{
                $doc = "";
            }
            
            $ra = rAdmins::find($id);
            $ra->update([
                'doc' => $doc,
            ]);
        }

        if($request->hasFile("licenses")){
            $request->validate([
                'licenses' => 'required',
            ]);

            if($request->licenses != ""){
                $licenses = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->licenses->extension();
                $request->licenses->move(public_path('images'), $licenses);
            }else{
                $licenses = "";
            }
            
            $ra = rAdmins::find($id);
            $ra->update([
                'licenses' => $licenses,
            ]);
        }

        if($request->hasFile("cv")){
            $request->validate([
                'cv' => 'required',
            ]);

            if($request->cv != ""){
                $cv = time() . '-' . rand(1000,9000) . 'title' . '.' . $request->cv->extension();
                $request->cv->move(public_path('images'), $cv);
            }else{
                $cv = "";
            }
            
            $ra = rAdmins::find($id);
            $ra->update([
                'cv' => $cv,
            ]);
        }

        return redirect()->back()->with(session()->flash('alert', 'ΕΠΙΚΑΙΡΟΠΟΙΗΜΕΝΟ
        '));
    }

    public function delete($name, $id)
    {
        $ra = rAdmins::find($id);
        if($ra){
            $ra->update([
                $name => "",
            ]);

            return redirect()->back()->with(session()->flash('alert', 'ΕΠΙΚΑΙΡΟΠΟΙΗΜΕΝΟ
            '));
        }
    }
}