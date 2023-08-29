<?php

namespace App\Modules\Hrm\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Hrm\Models\Employee;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
        // Your logic for the 'payment' route
    }

    public function addPayment()
    {
        $employees = Employee::all();
        return view('Hrm::payment.add_payment', compact('employees'));
    }

    public function submitPayment(Request $request)
    {
        // Your logic for the 'submit-payment' route
    }

    public function getPayment(Request $request)
    {
        // Your logic for the 'get-payment' route
    }

    public function paymentEdit($id)
    {
        // Your logic for the 'update-payment/{id}' route
    }

    public function paymentUpdate(Request $request)
    {
        // Your logic for the 'update-payment' route
    }

    public function paymentDelete(Request $request)
    {
        // Your logic for the 'payment-delete' route
    }
}
