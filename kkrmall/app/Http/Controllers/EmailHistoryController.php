<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\ValidatedInput;
use App\Http\Requests\EmailSendRequest;
use App\Mail\Email;
use App\Models\EmailHistory;
use Illuminate\Support\Facades\Mail;

class EmailHistoryController extends Controller
{
    private $emailHistory;

    // 의존성 주입
    public function __construct(EmailHistory $emailHistory)
    {
        $this->emailHistory = $emailHistory;
    }

    public function emailSend(Request $request){
        // 유효성 검사 오류시 422 상태 코드로 반환

        

        // 이력 저장
        $emailHistory = new EmailHistory();
        
        $emailHistory->email = $request->email;
        $emailHistory->subject = $request->subject;
        $emailHistory->message = $request->message;

        $emailHistory->save();

        // 저장 성공시 이메일 발송
        if($emailHistory){
            Mail::to($request['email'])->send(new Email($emailHistory));
            // 성공시 success section 으로 성공 문자 전달
            return redirect()->back()
                ->with([
                    'success' => '이메일을 성공적으로 발송했습니다.'
                ]);
        }
    }
}
