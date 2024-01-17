<?php

namespace App\Modules\Finance\Http\Controllers;

use App\Libraries\CommonFunction;
use App\Libraries\Encryption;
use App\Models\CreditAmount;
use App\Models\District;
use App\Models\Member;
use App\Models\SpendAmount;
use App\Models\User;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Http\Request;
use Hash;
use Auth;
use DB;
use Session;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $userRepo;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $members = Member::where('status', 1)->count();
        $incomes = CreditAmount::where('status', 1)->sum('amount');
        $expends = SpendAmount::where('status', 1)->sum('amount');
        $revenue = $incomes - $expends;
        $memberDatas = Member::where('status', 1)->latest()->take(10)->get();
        $incomeDatas = CreditAmount::where('status', 1)->latest()->take(5)->get();
        $expenseDatas = SpendAmount::where('status', 1)->latest()->take(5)->get();
        $districts = DB::table('districts')->get()->pluck('bn_name')->toArray();
        $dis = DB::table('districts')->get()->pluck('id')->toArray();
        $value = [];
        foreach($dis as $d)
        {
            $number = Member::where('district_id', $d)->count();
            $value[] = $number;
        }

        return view('Finance::admin.dashboard', compact('value','districts','members', 'incomes', 'expends', 'revenue', 'memberDatas', 'incomeDatas', 'expenseDatas'));
    }

    public function profile()
    {
        $user = Auth::guard("web")->user();
        return view('Finance::admin.profile', compact('user'));
    }

    //Change Password
    public function changePassword()
    {
        return view('Finance::admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $ok = User::find($request->id);
        $password = $request->input('current_password');
        $check = User::where('id', Auth::user()->id)->first();
        if (Hash::check($password, $check->password)) {
            if ($request->password == $request->confirm_password) {
                $ok->password = bcrypt($request->password);
                $ok->save();
                return back()->withSuccess('Password Change Successful');
            }
            return back()->withErrors('New Password & Confirm Password Not Match!');
        } else {
            return back()->withErrors('Current Password Not Match');
        }
    }

    public function updateProfile(Request $request)
    {
        $user_id = Encryption::decodeId($request->user_id);
        $data = User::findOrFail($user_id);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->status = $request->status;
        if ($request->has('image') && $request->image != '') {
            CommonFunction::imageDelete($data->image);
            $request->validate(['image' => 'required|image|mimes:jpeg,jpg,png,webp']);
            $path = 'assets/uploads/users/' . date("Y") . "/" . date("m") . "/";
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
                $new_file = fopen($path . '/index.html', 'w') or die('Cannot create file:  [UC-1001]');
                fclose($new_file);
            }
            $root_path = CommonFunction::getProjectRootDirectory(); // Path to the project's root folder
            $image = $request->image;
            $imageName = time() . '.' . $image->extension();
            $image->move($root_path . '/' . $path, $imageName);
            $data->image = $path . $imageName;
        }
        $res = $this->userRepo->Update($data);
        if ($res->code == 200) {
            Session::flash('success', 'Profile has been updated Successfully');
            return redirect()->back();
        } else {
            Session::flash('error', CommonFunction::showErrorPublic($res->message) . '[UC-1005]');
            return Redirect::back()->withInput();
        }
    }
}
