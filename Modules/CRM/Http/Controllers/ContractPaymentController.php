<?php

namespace Modules\CRM\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\CRM\Http\Requests\ContractPaymentRequest;


use Modules\CRM\Entities\ContractPayment;

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
     * @apiParam  \Modules\CRM\Entities\ContractPayment  $contractPayment
     * @apiSuccess \Illuminate\Http\Response
     */
    public function show(ContractPayment $contractPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @apiParam  \Modules\CRM\Entities\ContractPayment  $contractPayment
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
     * @apiParam  \Modules\CRM\Entities\ContractPayment  $contractPayment
     * @apiSuccess \Illuminate\Http\Response
     */
    public function update(Request $request, ContractPayment $contractPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @apiParam  \Modules\CRM\Entities\ContractPayment  $contractPayment
     * @apiSuccess \Illuminate\Http\Response
     */
    public function destroy(ContractPayment $contractPayment)
    {
        //
    }
}
