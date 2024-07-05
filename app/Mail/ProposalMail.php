<?php

namespace App\Mail;

use PDF;
use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProposalMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $id = $this->data['id'];
        $proposal = Proposal::find($id);
        $pdf = PDF::loadView('proposal.printable',['proposal' => $proposal], $this->data);

        return $this->view('email.agreement')
                    ->attachData($pdf->output(), "agreement.pdf")
                    ->subject('Proposal Agreement');
    }
}
