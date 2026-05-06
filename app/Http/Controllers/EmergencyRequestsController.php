<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmergencyRequest;
use App\Notifications\EmergencyNotification;
use App\Models\User;

class EmergencyRequestsController extends Controller
{
    public function index()
    {
        return view('emergancyRequest.index')
            ->with('emergancyRequest', EmergencyRequest::orderBy('created_at', 'DESC')->get());
    }

    public function create()
    {
        return view('emergancyRequest.create');
    }

    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate(
            [
                'description' => 'required',
                'location' => 'required',
                'whatsapp' => ['required', 'regex:/^[0-9\s\-\+]+$/'],
            ],
            [
                'whatsapp.regex' => 'يرجى إدخال رقم واتساب صالح .',
            ]
        );

        // إنشاء الطلب الطارئ
        $emergencyRequest = EmergencyRequest::create([
            'type' => null,
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'whatsapp' => $request->input('whatsapp'),
            'user_id' => auth()->user()->id
        ]);

        // إرسال إشعارات لجميع المستخدمين
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new EmergencyNotification($emergencyRequest));
        }

        return redirect('/emergancyRequest')->with('message', 'تم إضافة الطلب الطارىء بنجاح!');;
    }

    public function show($id)
    {
        return view('emergancyRequest.show')
            ->with('emergencyRequest', EmergencyRequest::where('id', $id)->first());
    }

    public function edit($id)
    {
        return view('emergancyRequest.edit')
            ->with('emergancyRequest', EmergencyRequest::where('id', $id)->first());
    }

    public function update(Request $request, string $id)
    {
        // التحقق من صحة البيانات المدخلة أثناء التحديث
        $request->validate(
            [
                'description' => 'required',
                'location' => 'required',
                'whatsapp' => ['required', 'regex:/^[0-9\s\-\+]+$/'],
            ],
            [
                'whatsapp.regex' => 'يرجى إدخال رقم واتساب صالح .',
            ]
        );

        // تحديث الطلب الطارئ (الحقل type يُترك كما هو إن وُجد سابقًا)
        EmergencyRequest::where('id', $id)
            ->update([
                'description' => $request->input('description'),
                'location' => $request->input('location'),
                'whatsapp' => $request->input('whatsapp'),
                'user_id' => auth()->user()->id,
            ]);

        return redirect('/emergancyRequest/' . $id)
            ->with('message', 'تم تعديل الطلب بنجاح');
    }

    public function destroy(string $id)
    {
        EmergencyRequest::where('id', $id)->delete();
        return redirect('/emergancyRequest')
            ->with('message', 'تم حذف الطلب بنجاح');
    }
}
