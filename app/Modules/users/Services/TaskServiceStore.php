<?php

namespace Users\Services;

use App\Abstratctions\Service;
use App\Interfaces\ServiceStore;
use Illuminate\Http\Request;
use Users\Models\Task;
use Users\Repositories\TaskRepositoryShow;
use Users\Repositories\TaskRepositoryStore;

class TaskServiceStore extends Service implements ServiceStore
{
    public $repo;
    /**
     * @var TaskRepositoryStore
     */
    private $taskRepositoryStore;
    /**
     * @var TaskRepositoryShow
     */
    private $taskRepositoryShow;
    /**
     * @var Task
     */
    private $model;

    /**
     * Create a new Repository instance.
     *
     * @param TaskRepositoryStore $taskRepositoryStore
     * @param TaskRepositoryShow $taskRepositoryShow
     */
    public function __construct(TaskRepositoryStore $taskRepositoryStore, TaskRepositoryShow $taskRepositoryShow, Task $model)
    {
        $this->taskRepositoryStore = $taskRepositoryStore;
        $this->taskRepositoryShow = $taskRepositoryShow;
        $this->model = $model;
    }


    /**
     * Use save data into Repository
     *
     * @param Request $request
     * @return Boolean
     */
    public function save(Request $request)
    {
            $data = $request->only($this->model->getFillable());
            $task = $this->taskRepositoryStore->create($data);
            return $task;
    }

    /**
     * Use save data into Repository
     *
     * @param Request $request
     * @return Boolean
     */
    public function update($id, Request $request)
    {
            $data = $request->only($this->model->getFillable());
            $task = $this->taskRepositoryStore->update($id, $data);
            return $task;
    }

    /**
     * Remove data from the Repository
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
    public function delete(Request $request, $id = null)
    {
        $this->clean_request($request);
        $delete = $this->taskRepositoryStore->delete($id, $request->all());
        return $delete;
    }

    public function restore(Request $request, $id = null)
    {
        return $this->repo->restore($request, $id);
    }
}

