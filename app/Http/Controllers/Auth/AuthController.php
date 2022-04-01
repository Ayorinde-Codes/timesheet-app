<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Carbon\Carbon;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        // last_password_change

        $request->validate([
            'VIPUserName' => 'required',
            'password' => 'required',
        ]);

   
        $credentials = $request->only('VIPUserName', 'password'); 

        // $checkPassword = User::where('VIPUserName', $request->VIPUserName)->first();

        // if($checkPassword->last_password_change == null)
        // {
        //     return redirect("passwordreset");
        // }

        if (Auth::attempt($credentials)) {

            // $checkPassword->last_password_change = Carbon::now();
            // $checkPassword->save();

            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Opps! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }


    public function updatePassword(Request $request)
    {
        
        $checkPassword = User::where('VIPUserName', $request->VIPUserName)->first();

    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        $allEmployees = count(User::all());

        $allProjects = count(Project::all());

        $projects = Project::all();

        $employees = User::all()->take(5);

        $getAllAbsentUsers = User::where('is_on_leave', 1)->get();

        // whereDate('created_at', Carbon::today())
        
        if(Auth::check()){
            return view('auth.dashboard', compact('allEmployees', 'allProjects', 'projects', 'employees', 'getAllAbsentUsers'));
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}