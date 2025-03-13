<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Subscription;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view("admin.index", compact("members"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id)
    {
        $member = Member::find($id);
        return view("admin.show", compact("member"));
    }
    public function create()
    {

        return view("admin.create");
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
            'end_date' => now()->addMonth(),
        ]);
        return redirect()->route('admin.create')->with('success', 'تمت اضافه المتدرب بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function return()
    {
        $members = Member::all();
        return view('admin.return', compact('members'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $member = Member::findOrFail($id);
        return view("admin.edit", compact("member"));
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
        return redirect()->route('admin.index')->with('success', 'تمت تعديل المتدرب بنجاح');

    }


    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->state = 'قيد المعالجه';
        $member->save();
        return redirect()->route('admin.index')->with('success', 'سيتم مراجعه الطلب');
    }

    public function cancel($id)
    {
        $member = Member::findOrFail($id);
        $member->state = null;
        $member->save();
        return redirect()->route('admin.index')->with('success', 'تم الغاء العمليه ');
    }
}
