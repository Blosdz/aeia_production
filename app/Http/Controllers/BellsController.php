<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBellsRequest;
use App\Http\Requests\UpdateBellsRequest;
use App\Repositories\BellsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\Models\Bells;
use Illuminate\Support\Facades\Auth;

class BellsController extends AppBaseController
{
    /** @var  BellsRepository */
    private $bellsRepository;

    public function __construct(BellsRepository $bellsRepo)
    {
        $this->bellsRepository = $bellsRepo;
    }

    /**
     * Display a listing of the Bells.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $bells = $this->bellsRepository->all();

        return view('bells.index')
            ->with('bells', $bells);
    }

    /**
     * Show the form for creating a new Bells.
     *
     * @return Response
     */
    public function create()
    {
        return view('bells.create');
    }

    /**
     * Store a newly created Bells in storage.
     *
     * @param CreateBellsRequest $request
     *
     * @return Response
     */
    public function store(CreateBellsRequest $request)
    {
        $input = $request->all();

        $bells = $this->bellsRepository->create($input);

        Flash::success('Bells saved successfully.');

        return redirect(route('bells.index'));
    }

    /**
     * Display the specified Bells.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bells = $this->bellsRepository->find($id);

        if (empty($bells)) {
            Flash::error('Bells not found');

            return redirect(route('bells.index'));
        }

        return view('bells.show')->with('bells', $bells);
    }

    /**
     * Show the form for editing the specified Bells.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bells = $this->bellsRepository->find($id);

        if (empty($bells)) {
            Flash::error('Bells not found');

            return redirect(route('bells.index'));
        }

        return view('bells.edit')->with('bells', $bells);
    }

    /**
     * Update the specified Bells in storage.
     *
     * @param int $id
     * @param UpdateBellsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBellsRequest $request)
    {
        $bells = $this->bellsRepository->find($id);

        if (empty($bells)) {
            Flash::error('Bells not found');

            return redirect(route('bells.index'));
        }

        $bells = $this->bellsRepository->update($request->all(), $id);

        Flash::success('Bells updated successfully.');

        return redirect(route('bells.index'));
    }

    /**
     * Remove the specified Bells from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bells = $this->bellsRepository->find($id);

        if (empty($bells)) {
            Flash::error('Bells not found');

            return redirect(route('bells.index'));
        }

        $this->bellsRepository->delete($id);

        Flash::success('Bells deleted successfully.');

        return redirect(route('bells.index'));
    }

    public function bells()
    {
        // verifyNotification recibe $user_id, $row => campo de la base de datos, $value => true/false
        //$notification = $this->verifyNotification(1,'document', true);
        $notification = Bells::where('user_id', Auth::user()->id)->first();
        $response = [
            'userId' => Auth::user()->id,
            'notification' => $notification
        ];
        return response()->json($response);
    }
}
