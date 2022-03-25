<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskStatus;

class TaskControllerTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        TaskStatus::factory()->create();
    }
    /**
     * Test of tasks index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    /**
     * Test of tasks show.
     *
     * @return void
     */
    public function testShow()
    {
        $taskData = Task::factory()->create();

        $response = $this->get(route('tasks.show', ['task' => $taskData]));
        $response->assertOk();
    }

    /**
     * Test of tasks create.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertOk();
    }

    /**
     * Test of tasks store.
     *
     * @return void
     */
    public function testStore()
    {
        /** @var array $taskData */
        $taskData = Task::factory()->make()->only(['name', 'description', 'status_id', 'assigned_to_id']);

        $response = $this->actingAs($this->user)->post(route('tasks.store'), $taskData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $taskData);
    }

    /**
     * Test of tasks edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $taskData = Task::factory()->create();

        $response = $this->actingAs($this->user)->get(route('tasks.edit', ['task' => $taskData]));
        $response->assertOk();
    }

    /**
     * Test of tasks update.
     *
     * @return void
     */
    public function testUpdate()
    {
        $taskData = Task::factory()->create();
        $updatedTaskData = Task::factory()
            ->make()
            ->only(['name', 'description', 'status_id', 'assigned_to_id']);

        $response = $this->actingAs($this->user)->patch(route('tasks.update', ['task' => $taskData]), $updatedTaskData);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $updatedTaskData);
    }

    /**
     * Test of tasks delete.
     *
     * @return void
     */
    public function testDelete()
    {
        /** @var Task $taskData */
        $taskData = Task::factory()->create(['created_by_id' => $this->user->id]);

        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $taskData));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertModelMissing($taskData);
    }
}
