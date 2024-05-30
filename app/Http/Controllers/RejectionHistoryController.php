<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRejectionHistoryRequest;
use App\Repositories\RejectionHistoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Traits\MakeFile;
use App\Models\User;
use App\Models\RejectionHistory;

use DB;

class RejectionHistoryController extends AppBaseController
{
    /** @var  RejectionHistoryRepository */
    private $rejectionHistoryRepository;
    use MakeFile;

    public function __construct(RejectionHistoryRepository $RejectionHistoryRepo)
    {
        $this->rejectionHistoryRepository = $RejectionHistoryRepo;
    }

    /**
     * Display a listing of the Event.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $rejectionHistory = $this->rejectionHistoryRepository->all();

        return view('events.index')
            ->with('events', $rejectionHistory);
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function store(CreateRejectionHistoryRequest $request)
    {
        $input = $request->all();


        $rejectionHistory = $this->rejectionHistoryRepository->create($input);

        Flash::success('rejectionHistory saved successfully.');

        return redirect(route('events.index'));
    }

    /**
     * Display the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
         
        $rejectionHistory = RejectionHistory::find($id);

        return view('reject_history.show')->with('rejectionHistory', $rejectionHistory);
    }

    /**
     * Show the rejectionHistory of one User.
     *
     * @param int $user_id
     *
     * @return Response
     */
     
    public function rejectionHistory($user_id)
    {
        $user = User::where('id', $user_id)->with('rejection_histories')->get();

        return view('reject_history.reject_history_table')->with('user', $user);
    }
     

}
