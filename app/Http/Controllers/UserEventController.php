<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserEventRequest;
use App\Http\Requests\UpdateUserEventRequest;
use App\Repositories\UserEventRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class UserEventController extends AppBaseController
{
    /** @var  UserEventRepository */
    private $userEventRepository;

    public function __construct(UserEventRepository $userEventRepo)
    {
        $this->userEventRepository = $userEventRepo;
    }

    /**
     * Display a listing of the UserEvent.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $userEvents = $this->userEventRepository->all();

        return view('user_events.index')
            ->with('userEvents', $userEvents);
    }

    /**
     * Show the form for creating a new UserEvent.
     *
     * @return Response
     */
    public function create()
    {
        return view('user_events.create');
    }

    /**
     * Store a newly created UserEvent in storage.
     *
     * @param CreateUserEventRequest $request
     *
     * @return Response
     */
    public function store(CreateUserEventRequest $request)
    {
        $input = $request->all();

        $userEvent = $this->userEventRepository->create($input);

        Flash::success('User Event saved successfully.');

        return redirect(route('userEvents.index'));
    }

    /**
     * Display the specified UserEvent.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $userEvent = $this->userEventRepository->find($id);

        if (empty($userEvent)) {
            Flash::error('User Event not found');

            return redirect(route('userEvents.index'));
        }

        return view('user_events.show')->with('userEvent', $userEvent);
    }

    /**
     * Show the form for editing the specified UserEvent.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $userEvent = $this->userEventRepository->find($id);

        if (empty($userEvent)) {
            Flash::error('User Event not found');

            return redirect(route('userEvents.index'));
        }

        return view('user_events.edit')->with('userEvent', $userEvent);
    }

    /**
     * Update the specified UserEvent in storage.
     *
     * @param int $id
     * @param UpdateUserEventRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserEventRequest $request)
    {
        $userEvent = $this->userEventRepository->find($id);

        if (empty($userEvent)) {
            Flash::error('User Event not found');

            return redirect(route('userEvents.index'));
        }

        $userEvent = $this->userEventRepository->update($request->all(), $id);

        Flash::success('User Event updated successfully.');

        return redirect(route('userEvents.index'));
    }

    /**
     * Remove the specified UserEvent from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $userEvent = $this->userEventRepository->find($id);

        if (empty($userEvent)) {
            Flash::error('User Event not found');

            return redirect(route('userEvents.index'));
        }

        $this->userEventRepository->delete($id);

        Flash::success('User Event deleted successfully.');

        return redirect(route('userEvents.index'));
    }
}
