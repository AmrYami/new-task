<?php

namespace Users\Http\Controllers;

use Users\Http\Controllers\Response;
use Users\Http\Requests\CreateTaskRequest;
use Users\Http\Requests\UpdateTaskRequest;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Users\Services\TaskServiceShow;
use Users\Services\TaskServiceStore;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Users\Services\UserServiceShow;

class TaskController extends BaseController
{

    /**
     * @var TaskServiceShow
     */
    private $serviceShow;
    /**
     * @var TaskServiceStore
     */
    private $taskServiceStore;
    private $userserviceShow;

    public function __construct(TaskServiceShow $serviceShow, TaskServiceStore $taskServiceStore, UserServiceShow $userserviceShow)
    {
        $this->serviceShow = $serviceShow;
        $this->taskServiceStore = $taskServiceStore;
        $this->userserviceShow = $userserviceShow;
    }

    /**
     * Display a listing of the Task.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Renderable
    {
        $tasks = $this->serviceShow->find_by($request);
        return view('users::tasks.index')
            ->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new Task.
     *
     * @return Response
     */
    public function create(): Renderable
    {
        return view('users::tasks.create', [
            'action' => 'create',
            'active' => 'Users Tasks',
        ]);
    }

    /**
     * Store a newly created Task in storage.
     *
     * @param CreateChannelRequest $request
     *
     * @return Response
     */
    public function store(CreateTaskRequest $request): RedirectResponse
    {
        $task = $this->taskServiceStore->save($request);
        if ($task) {
            return redirect()->route('tasks.index')->with('created', __('messages.Created', ['thing' => 'User Task']));
        } else {
            return back()->withErrors(__('common.Sorry But You Should Select Permission To Task'));
        }


    }

    /**
     * Display the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified Task.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $task = $this->serviceShow->find($id, $request);
        $users = $this->userserviceShow->all($request);
        return view('users::tasks.edit', [
            'task' => $task,
            'users' => $users,
            'action' => 'edit',
            'active' => 'Users Tasks',
        ]);
    }

    /**
     * Update the specified Task in storage.
     *
     * @param int $id
     * @param UpdateChannelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTaskRequest $request)
    {
        try {
            $task = $this->taskServiceStore->update($id, $request);
            if ($task) {
                return redirect()->route('tasks.index')->with('updated', __('messages.Updated', ['thing' => 'User Task']));
            } else {
                return back()->withErrors(__('common.Sorry But there Was an issue in saving Data please try again'));
            }
        } catch (\Exception $exception) {
            return false;
        }

    }

    /**
     * Remove the specified Task from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy(Request $request, $id)
    {
        $delete = $this->taskServiceStore->delete($request, $id);
        if ($delete) {
            return redirect()->route('tasks.index')->with('deleted', __('messages.Deleted', ['thing' => 'User Task']));
        } else {
            return redirect()->route('tasks.index')->with('deleted', __('messages.You can\'t delete task that has users!!'));
        }
    }
}
