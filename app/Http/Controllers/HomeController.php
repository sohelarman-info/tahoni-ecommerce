<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use PDF;
use App\Exports\OrderDateExport;
use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\OrderExport;
use App\Imports\CategoryImport;
use App\Review;
use Maatwebsite\Excel\Facades\Excel;

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
        $today          = Order::whereDate('created_at', Carbon::now())->count();
        $yesterday      = Order::whereDate('created_at', Carbon::yesterday())->count();
        $seven_days_ago = Order::whereDate('created_at', Carbon::now()->subDays(7))->count();
        return view('backend.dashboard', [
            'today'             => $today,
            'yesterday'         => $yesterday,
            'seven_days_ago'    => $seven_days_ago,
        ]);
    }
    function users(){
        $user_count = User::count();
        $users = User::orderBy('name', 'asc')->paginate();
        return view('backend.users.users', [
            'users' => $users,
            'user_count' => $user_count
        ]);
    }
    function UserDelete($id){
        User::findOrFail($id)->delete();
        return redirect('users')->with('UserDelete', 'User Deleted Successfully!');
    }
    function Orders(){
        return view('backend.orders.orders',[
            'orders' => Order::latest()->paginate(10)
        ]);
    }
    function ExcelDownload(){
        return Excel::download(new OrderExport, 'Orders.xlsx');

    }
    public function import(Request $request)
    {
        Excel::import(new CategoryImport, $request->file('excel'));
        return back()->with('success', 'All good!');
    }
    function SelectedDateExcelDownload(Request $request){
        $from   = $request->start;
        $to     = $request->end;
        return Excel::download(new OrderDateExport($from, $to), 'Orders.xlsx');
    }
    function PDFDonwload(){
        $orders = Order::all();
        $pdf = PDF::loadView('exports.pdf', [
            'orders' => $orders,
        ]);
        return $pdf->download('exports.pdf');
    }
    function Comments(Request $request){
        $comment            = new Comment;
        $comment->blog_id   = $request->blog_id;
        $comment->user_id   = Auth::id();
        $comment->name      = $request->name;
        $comment->email     = $request->email;
        $comment->comment   = $request->comment;
        $comment->save();
        return back();
    }
    function UserReview(Request $request){
        if (Review::where('user_id', Auth::id())->where('product_id', $request->product_id)->exists()) {
            return 'You alrady Reviewed';
        }else {
            $review = new Review;
            $review->user_id    = Auth::id();
            $review->product_id = $request->product_id;
            $review->rating     = $request->rating;
            $review->name       = $request->name;
            $review->email      = $request->email;
            $review->massage    = $request->massage;
            $review->save();
            return back();
        }
    }
}
