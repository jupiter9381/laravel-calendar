<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PayrollConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $payroll;
    
    public function __construct($payroll)
    {
        $this->payroll = $payroll;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->view('email')
                    ->with([
                        'total_amount' => $this->payroll->total_amount,
                        'id' => $this->payroll->id,
                    ]);
    }
}
