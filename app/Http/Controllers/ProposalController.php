<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Proposal;
use App\Mail\ProposalMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proposal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show(Proposal $proposal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal)
    {
        return view('proposal.edit',['proposal' => $proposal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proposal $proposal)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Proposal $proposal)
    {
        //
        if($proposal){
            $proposal->delete();
            return redirect(route('dashboard')); //with success error to be added later
        }else{
            return redirect()->back(); // failure error
        }
    }

    // Print to pdf
    public function pdf_print(Proposal $proposal){
        $data = [
            'title' => 'PROPOSAL FOR '.$proposal->customer_name,
            'date' => date('m/d/Y')
        ];
        
        $pdf = PDF::loadView('proposal.printable', $data)
        ->with('proposal', $proposal);
        
       
        
        
        if($pdf->download($proposal->customer_name.'Proposal.pdf') == true){
            $responseData = [
                'message' => 'Pdf Ready for download',
                'success' => true // or false based on your logic
            ];

        }else{


            $responseData = [
                'message' => 'Pdf couldn\'t downaload',
                'success' => false // or false based on your logic
            ];

        }

        return response()->json($responseData);

    }

    // Send PDF
    public function send(Proposal $proposal){
        $data = [
            'id' => $proposal->id,
            'work' => $proposal->work_to_be_performed,
            'customer' => $proposal->customer,
        ];

    
        Mail::to($proposal->send_proposal_to)->queue(new ProposalMail($data));


        // return Json response
        $responseData = [
            'message' => 'Proposal sent successfully',
            'success' => true // or false based on your logic
        ];
    
        return response()->json($responseData);
    }


    // View printable
    public function view_printable(Proposal $proposal){
        // return $proposal->base['area']['input_value'];
        return view('proposal.printable', ['proposal' => $proposal]);
    }


}
