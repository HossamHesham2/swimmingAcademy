<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $members = Member::all();
        return view("superAdmin.index", compact("members"));
    }
    public function show($id)
    {
        $member = Member::find($id);
        return view("admin.show", compact("member"));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("superAdmin.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phoneNumber' => 'required|string|unique:members,phoneNumber',
            'coachName' => 'required|string',
            'level' => 'required|string',
            'typeOfTrain' => 'required|string',
            'location' => 'required|string',
            'price' => 'required|numeric', // نضيف السعر هنا عشان الاشتراك
        ]);
        $member = Member::create($request->only(['name', 'phoneNumber', 'coachName', 'level', 'typeOfTrain', 'location']));
        Subscription::create([
            'member_id' => $member->id,
            'price' => $request->price,
            'start_date' => now(),
            'end_date' => now()->addMonth(), // اشتراك لمدة شهر
        ]);
        return redirect()->route('superAdmin.create')->with('success', 'تمت اضافه المتدرب بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function return()
    {
        $members = Member::all();
        return view('superAdmin.return', compact('members'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view("superAdmin.edit", compact("member"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'phoneNumber' => 'required',
            'coachName' => 'nullable',
            'level' => 'nullable',
            'typeOfTrain' => 'nullable',
            'location' => 'nullable',
            'price' => 'required',
        ]);
        $member = Member::findOrFail($id);
        $member->update($data);
        return redirect()->route('superAdmin.index')->with('success', 'تمت تعديل المتدرب بنجاح');

    }


    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return redirect()->route('superAdmin.index')->with('success', 'تم حذف المتدرب بنجاح');
    }

    public function cancel($id)
    {
        $member = Member::findOrFail($id);
        $member->state = 'تم الرفض';
        $member->save();
        return redirect()->route('superAdmin.return')->with('success', 'تم الرفض ');
    }

    public function accept($id)
    {
        $member = Member::findOrFail($id);
        $member->state = 'تم القبول';
        $member->save();
        return redirect()->route('superAdmin.return')->with('success', 'تم القبول ');
    }
    public function revenue()
    {
        return view('superAdmin.revenue');
    }
}
