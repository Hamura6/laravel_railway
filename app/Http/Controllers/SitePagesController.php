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
        return view('site.pages.index1');
    }

    public function about()
    {
        return view('site.pages.about');
    }
    public function privacy()
    {
        return view('site.pages.privacy');
    }

    public function courses()
    {
        
        $courses = Course::orderBy('id','desc')->paginate(6);
        return view('site.pages.courses', compact('courses'));
    }
    public function news()
    {
        $informations = Information::orderBy('id','desc')->paginate(6);
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
        $photos = EventPhoto::where('event_id', $event->id)->orderBy('id','desc')->paginate(11);
        return view('site.pages.event_photos',compact('title','date','photos'));
    }

    public function contact()
    {
        return view('site.pages.contact');
    }
    public function facebookSite(){
        return view('site.pages.facebook');
    }
    public function directory()
    {
        $directory=BoardMember::
        with(['affiliate:id,user_id', 'affiliate.user:name,last_name,id,gender,photo,email','affiliate.user.phones:number,user_id'])
        ->where('affiliate_id', '!=', null)
        ->where('is_directory', 1)
        ->orderBy('level', 'asc')
        ->get();
        $th_directory=BoardMember::
        with(['affiliate:id,user_id', 'affiliate.user:name,last_name,id,gender,photo,email','affiliate.user.phones:number'])
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
