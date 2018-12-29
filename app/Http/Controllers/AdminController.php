<?php

namespace App\Http\Controllers;
use App\Building;
use App\Contact;
use App\Http\Requests\PasswordRequest;
use App\Rules\HashCheckRule;
use App\Type;
use App\User;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buar =  $this->buildingsNumberperMonth(date('Y'));
        $users = User::count();
        $buildings  = Building::all();
        $messages = Contact::count();
        $types    = Type::count();
        $latestusers = User::orderBy('created_at', 'desc')->take(8)->get();
        $latestbuildings = Building::orderBy('created_at','desc')->take(7)->get();
        $latestmessages = Contact::orderBy('created_at','desc')->take(10)->get();
        return view("admin.home.index",compact('users','buildings','messages','types','latestusers','latestbuildings','latestmessages','buar'));
    }

    /**
     * display on user info to update his own password
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function editPassword(User $user){
        return view('admin.users.password',compact('user'));
   }

    /**
     * update admin password
     * @param PasswordRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
   public function updatePassword( PasswordRequest $request,User $user)
   {

       $user->update(['password' => Hash::make($request->password)]);
       Auth::logout();
       return redirect("/login");

   }

    /**
     * check if the new password == old password
     * @param $user
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
   protected function checkData($user,$request)
   {
       $user->password = Hash::make($request->password);
       if(!$user->isDirty())
           return redirect()->back()->with("message"," هذه الكلمة تطابق السابقة   ");
   }

    /**
     * display stats page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function stats()
    {
        return view("admin.home.stat");
    }
    /**
     * get website stats by year
     * @param $year
     * @return array
     */
   public function staticsYear(Request $request)
   {
       $year = $request->year;
       $buar =  $this->buildingsNumberperMonth($year);
       $users = User::whereRaw('year(`created_at`)=?',"$year")->count();
       $buildings  = Building::whereRaw('year(`created_at`)=?',"$year")->get();
       $messages = Contact::whereRaw('year(`created_at`)=?',"$year")->count();
       $types    = Type::whereRaw('year(`created_at`)=?',"$year")->count();
       $latestusers = User::whereRaw('year(`created_at`)=?',"$year")->orderBy('created_at', 'desc')->take(8)->get();
       $latestbuildings = Building::whereRaw('year(`created_at`)=?',"$year")->orderBy('created_at','desc')->take(7)->get();
       $latestmessages = Contact::whereRaw('year(`created_at`)=?',"$year")->orderBy('created_at','desc')->take(10)->get();
       return view("admin.home.index",compact('users','buildings','messages','types','latestusers','latestbuildings','latestmessages','buar'));

   }


    /**
     * get count of building per month by given year
     * @param $year
     * @return array
     */
   private function buildingsNumberperMonth($year)
   {
       $buildingsamount = [];
       $buar = [];

       $buildings_count = Building::select('id','created_at')->whereRaw('year(`created_at`)=?',"$year")->get()->groupBy(function($date){
           return Carbon::parse($date->created_at)->format('m');
       });

       foreach ($buildings_count as $key => $value)
       {
           $buildingsamount[(int)$key] = count($value);
       }
       for ($i=1;$i<=12;$i++)
       {
           if(!empty($buildingsamount[$i]))
               $buar[$i] = $buildingsamount[$i];
           else
               $buar[$i] = 0;
       }

       return $buar;

   }


   }

