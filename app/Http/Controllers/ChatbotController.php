<?php

namespace App\Http\Controllers;

use App\Models\Chatbot;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    /**
     * عرض صفحة الـ Chatbot
     */
    public function index()
    {
        $chatbots = Chatbot::with('systemSetting')->get();

        return view('chatbot', compact('chatbots'));
    }

    /**
     * تغيير حالة الـ Chatbot
     */
    public function updateStatus(Request $request, $id)
    {
        $chatbot = Chatbot::find($id);

        // لو الـ chatbot مش موجود
        if (!$chatbot) {
            return redirect()
                ->route('chatbot')
                ->with('error', 'Chatbot غير موجود.');
        }

        // التحقق من الحالة
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $chatbot->status = $request->status;
        $chatbot->save();

        return redirect()
            ->route('chatbot')
            ->with('success', 'تم تحديث حالة الـ Chatbot بنجاح.');
    }
}