<?php
namespace SPDP\Http\Controllers;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */

    // This is for after authenticated, which homepage the system will redirect.
    public function index(){
        $type = auth()->user()->role;
        switch ($role) {
            case 'fakulti':
                    return view('dashboard/fakulti-dashboard');
                break;
            case 'pjk':
                    return view('dashboard/pjk-dashboard');
                break; 
            case 'senat':
                return view('dashboard/senat-dashboard');
            break; 
            case 'penilai':
                    return view('dashboard/penilai-dashboard');
                break; 
            case 'jppa':
                    return view('dashboard/jppa-dashboard');
                break; 
            default:
                    return view ('/login'); 
                break;
        }
        
    
    }
    public function fakulti(Request $req){
        return view('dashboard/fakulti-dashboard');
        
        }
    public function pjk(Request $req){
        return view('dashboard/pjk-dashboard');
            
        }
    public function penilai(Request $req){
        return view('dashboard/penilai-dashboard');
                
        }
    public function jppa(Request $req){
        return view('dashboard/jppa-dashboard');
                
        }
    public function senat(Request $req){
        return view('dashboard/senat-dashboard');
                
        }
    
   
}