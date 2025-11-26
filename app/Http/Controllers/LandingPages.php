<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Information;
use App\Models\Institution;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LandingPages extends Controller
{
    public function index(){
        return view('web.pages.index');
    }
    public function about(){
        return view('web.pages.about');
    }
    public function universities(Request $request){
            return University::query()
        ->when($request->q, fn($q) => $q
            ->where('name', 'like', "%{$request->q}%")
        )
        ->limit(50)
        ->get(['id', 'name', 'entity'])
        ->map(fn($u) => [
            'id' => $u->id,
            'name' => $u->name . ($u->entity ? " ({$u->entity})" : ''),
        ]);
    }
    public function course(){
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
        $courses=Course::paginate(6);
        return view('web.pages.course',compact('courses'));
        
    }
    public function news(){
        $informations=Information::paginate(6);
        return view('web.pages.news',compact('informations'));
    }
    public function event(){
        
        return view('web.pages.event');
    }
    public function contact(){
        return view('web.pages.contact');
    }
    public function login(){
        return view('web.pages.login');
    }
    public function requirement(){
        $requirement = Institution::first()->requirement;
        return view('prueba.requirement',compact('requirement'));
    }
    public function save(Request $request){
/*         dd($request);
 */        $request->validate([
           'requirement' => 'required|max:65500',
       ]);
        $description = $request->input('requirement');
        $institution = Institution::first();
        $institution->update([
            'requirement' => $description,
        ]);
        return redirect()->route('institution.configuration');

    }
}
