<?php

namespace App\Http\Controllers\Admin\CRM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CRM\ContractPaymentRequest;


use App\Models\CRM\ContractPayment;

class ContractPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @apiSuccess \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @apiSuccess \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @apiParam  \Illuminate\Http\Request  $request
     * @apiSuccess \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @apiParam  \App\Models\CRM\ContractPayment  $contractPayment
     * @apiSuccess \Illuminate\Http\Response
     */
    public function show(ContractPayment $contractPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @apiParam  \App\Models\CRM\ContractPayment  $contractPayment
     * @apiSuccess \Illuminate\Http\Response
     */
    public function edit(ContractPayment $contractPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @apiParam  \Illuminate\Http\Request  $request
     * @apiParam  \App\Models\CRM\ContractPayment  $contractPayment
     * @apiSuccess \Illuminate\Http\Response
     */
    public function update(Request $request, ContractPayment $contractPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @apiParam  \App\Models\CRM\ContractPayment  $contractPayment
     * @apiSuccess \Illuminate\Http\Response
     */
    public function destroy(ContractPayment $contractPayment)
    {
        //
    }
}
