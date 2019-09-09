<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->profileIsset == 0) {
            return redirect()->route('profile.set');
        }
        return redirect()->route('blog.index');
    }
    
    public function viewProfile(Profile $profile)
    {
        return view('profile.show', compact('profile'));
    }

    public function profileSet()
    {
        return view('profile.create');
    }
    
    public function createProfile()
    {
        $user = auth()->user();

        $data = Profile::create($this->validateRequest());
        $this->imageUpload($data);

        DB::table('users')->where('id', $user->id)->update(['profileIsset' => 1]);

        return redirect()->route('blog.index')->with('welcome', 'Welcome '.auth()->user()->name);
    }

    public function editProfile(Profile $profile)
    {
        return view('profile.edit', compact('profile'));
    }

    public function updateProfile(Profile $profile)
    {
        $profile->update($this->validateRequest());
        $this->imageUpload($profile);
        return redirect()->route('profile', $profile->id)->with('success', auth()->user()->name.' Profile Edited');
    }

    private function validateRequest()
    {
        return tap(request()->validate([
            'contact' => 'required|numeric|min:9',
            'address' => 'required|min:10',
            'about' => 'required',
            'user_id' => 'required'
        ]), function(){
            if(request()->hasFile('picture')){
                request()->validate([
                    'picture'=>'file|image|max:5000',
                ]);
            }
        });
    }
    
    private function imageUpload($data)
    {
        if (request()->hasFile('picture')) {
            $data->update([
                'picture' => request()->picture->store('uploads/profile', 'public'),
            ]);
           
            $picture = Image::make(public_path('storage/'.$data->picture))->resize(450,600); 
            $picture->save();

        }    
    }

    


}
