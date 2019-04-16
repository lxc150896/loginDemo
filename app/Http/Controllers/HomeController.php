<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\LoginRequest;
use App\Repositories\Contracts\UserRepository;
class HomeController extends Controller
{
    protected $userRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function getUser()
    {
        $arrUser = $this->userRepository->getAll();
        return response()->json($arrUser);
    }
}
