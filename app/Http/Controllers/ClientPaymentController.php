<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientPaymentRequest;
use App\Http\Requests\UpdateClientPaymentRequest;
use App\Repositories\ClientPaymentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ClientPaymentController extends AppBaseController
{
    /** @var  ClientPaymentRepository */
    private $clientPaymentRepository;

    public function __construct(ClientPaymentRepository $clientPaymentRepo)
    {
        $this->clientPaymentRepository = $clientPaymentRepo;
    }

    /**
     * Display a listing of the ClientPayment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $clientPayments = $this->clientPaymentRepository->all();

        return view('client_payments.index')
            ->with('clientPayments', $clientPayments);
    }

    /**
     * Show the form for creating a new ClientPayment.
     *
     * @return Response
     */
    public function create()
    {
        return view('client_payments.create');
    }

    /**
     * Store a newly created ClientPayment in storage.
     *
     * @param CreateClientPaymentRequest $request
     *
     * @return Response
     */
    public function store(CreateClientPaymentRequest $request)
    {
        $input = $request->all();

        $clientPayment = $this->clientPaymentRepository->create($input);

        Flash::success('Client Payment saved successfully.');

        return redirect(route('clientPayments.index'));
    }

    /**
     * Display the specified ClientPayment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clientPayment = $this->clientPaymentRepository->find($id);

        if (empty($clientPayment)) {
            Flash::error('Client Payment not found');

            return redirect(route('clientPayments.index'));
        }

        return view('client_payments.show')->with('clientPayment', $clientPayment);
    }

    /**
     * Show the form for editing the specified ClientPayment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clientPayment = $this->clientPaymentRepository->find($id);

        if (empty($clientPayment)) {
            Flash::error('Client Payment not found');

            return redirect(route('clientPayments.index'));
        }

        return view('client_payments.edit')->with('clientPayment', $clientPayment);
    }

    /**
     * Update the specified ClientPayment in storage.
     *
     * @param int $id
     * @param UpdateClientPaymentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientPaymentRequest $request)
    {
        $clientPayment = $this->clientPaymentRepository->find($id);

        if (empty($clientPayment)) {
            Flash::error('Client Payment not found');

            return redirect(route('clientPayments.index'));
        }

        $clientPayment = $this->clientPaymentRepository->update($request->all(), $id);

        Flash::success('Client Payment updated successfully.');

        return redirect(route('clientPayments.index'));
    }

    /**
     * Remove the specified ClientPayment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clientPayment = $this->clientPaymentRepository->find($id);

        if (empty($clientPayment)) {
            Flash::error('Client Payment not found');

            return redirect(route('clientPayments.index'));
        }

        $this->clientPaymentRepository->delete($id);

        Flash::success('Client Payment deleted successfully.');

        return redirect(route('clientPayments.index'));
    }
}
