<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function charge(Request $request, $id)
    {
        $course = Course::find($id);
        $charge = Stripe::charges()->create([
            'amount' => $course->price,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $request->stripeToken,
        ]);
        if ($charge['id']) {
            $course->students()->attach(Auth::id(), ['price' => $course->price]);
            return redirect()->route('studentDashboard');
        } else {
            abort(404);
        }
    }
}
