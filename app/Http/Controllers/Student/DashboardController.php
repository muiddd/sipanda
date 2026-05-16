<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\AiSummary;

class DashboardController extends Controller
{
    public function index()
    {
        $chats = ChatMessage::where('user_id', auth()->user()->id)
                    ->orderBy('created_at', 'asc')->get();
        $summary = AiSummary::where('user_id', auth()->user()->id)->latest()->first();

        return view('student.dashboard', compact('chats', 'summary'));
    }
}