<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\BoardMember;
use App\Models\Course;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\Information;
use Illuminate\Http\Request;

class SitePagesController extends Controller
{
    public function index()
    {
        return view('site.pages.index');
    }

    public function about()
    {
        return view('site.pages.about');
    }

    public function courses()
    {
        /* $users = User::all();

        foreach ($users as $user) {
            $user->assignRole('Afiliado');
        }
       $user=User::create([
            'name'=>'Hamura',
            'last_name'=>'Otsutsuki',
            'birthdate'=>'2005-10-10',
            'gender'=>'Masculino',
            'martial_status'=>'Divorciado',
            'ci'=>'14482906',
            'email'=>'deidaramen2@gmail.com',
            'password'=>Hash::make('madaradelos6')
        ]);
        $user->assignRole('Administrador'); */
        $courses = Course::paginate(6);
        return view('site.pages.courses', compact('courses'));
    }

    public function news()
    {
        $informations = Information::paginate(6);
        return view('site.pages.news', compact('informations'));
    }

    public function events($count=5)
    {
        $total=$count;
        $events=Event::with(['firstPhoto'])->orderBy('id', 'desc')->take($total)->get();
        return view('site.pages.events',compact('events','total'));
    }
    public function eventsGalery($event){
        $event=Event::find($event);
        $title=$event->title;
        $date=$event->date;
        $photos = EventPhoto::where('event_id', $event->id)->paginate(5);
        return view('site.pages.event_photos',compact('title','date','photos'));
    }

    public function contact()
    {
        return view('site.pages.contact');
    }
    public function directory()
    {
        $directory=BoardMember::
        with(['affiliate:id,user_id', 'affiliate.user:name,last_name,id,gender,photo'])
        ->where('affiliate_id', '!=', null)
        ->where('is_directory', 1)
        ->orderBy('level', 'asc')
        ->get();
        $th_directory=BoardMember::
        with(['affiliate:id,user_id', 'affiliate.user:name,last_name,id,gender,photo'])
        ->where('affiliate_id', '!=', null)
        ->where('is_directory', 0)
        ->orderBy('level', 'asc')
        ->get();
        return view('site.pages.directory',compact('directory','th_directory'));
    }
    public function agreements(){
        $convenios=Agreement::orderBy('id','desc')->paginate(10);
        return view('site.pages.agreement',compact('convenios'));
    }
    public function requirement(){
        return view('site.pages.requirement');
    }
}
