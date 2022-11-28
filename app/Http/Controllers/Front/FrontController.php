<?php

namespace App\Http\Controllers\Front;

use App\Models\About;
use App\Models\Korpus;
use App\Models\Slider;
use App\Models\Dekanat;
use App\Models\Kafedra;
use App\Models\Message;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index()
    {
        $sliders=Slider::orderBy('sort','ASC')->get();
        $about=About::first();
        $korpuss=Korpus::get();
        $teachers=Teacher::with('getKafedra')->get();
        return view('front.pages.index',compact('sliders','about','korpuss','teachers'));
    }

    public function about()
    {
        $about=About::first();
        return view('front.pages.about',compact('about'));
    }

    public function contact()
    {
        return view('front.pages.contact');
    }

    public function korpus()
    {
        $korpuss=Korpus::get();
        return view('front.pages.korpus',compact('korpuss'));
    }

    public function korpus_single($id)
    {
        $korpus=Korpus::findOrFail($id);
        return view('front.pages.korpus_single',compact('korpus'));
    }

    public function contact_post(Request $request)
    {
        $message = new Message;
        $message->name    = $request->name;
        $message->email   = $request->email;
        $message->title   = $request->title;
        $message->msj     = $request->msj;

        $email = "emraheliyev2908@gmail.com";
        $title= 'Aviasiya saytindan mesaj var';

        $data = [
            'email'  => $request->email,
            'title'  => $request->title,
            'name'  => $request->name,
            'msj'  => $request->msj,
        ];
        Mail::send('mail.sendmail', $data, function($m) use ($title,$email) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $m->to($email, env('MAIL_FROM_NAME') )->subject($title);
        });
        
            $message->save();
            toastr()->success('Mesajınız uğurla göndərildi');
            return redirect()->back();
    }
}
