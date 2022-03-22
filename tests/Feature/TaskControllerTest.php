<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Label;
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
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.show', ['task' => $task]));
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
        /** @var array $task */
        $task = Task::factory()->make()->only(['name', 'description', 'status_id', 'assigned_to_id']);

        /** @var Label $label */
        $label = Label::factory()->create();

        $response = $this->actingAs($this->user)
            ->post(route('tasks.store'), array_merge($task, ['labels' => [$label->id]]));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->get(route('tasks.index'))->assertSee($task['name']);
        $this->assertDatabaseHas('tasks', array_merge($task, ['created_by_id' => $this->user->id]));
    }

    /**
     * Test of tasks edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $task = Task::factory()->create();

        $response = $this->actingAs($this->user)->get(route('tasks.edit', ['task' => $task]));
        $response->assertOk();
    }

    /**
     * Test of tasks update.
     *
     * @return void
     */
    public function testUpdate()
    {
        /** @var Label $label */
        $label = Label::factory()->create();

        /** @var Task $task */
        $task = Task::factory()->create();

        /** @var array $taskData */
        $taskData = Task::factory()
            ->make()
            ->only(['name', 'description', 'status_id', 'assigned_to_id']);

        $data = array_merge($taskData, ['labels' => [$label->id]]);

        $response = $this->actingAs($this->user)->patch(route('tasks.update', ['task' => $task]), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', $taskData);
        $this->assertDatabaseHas('label_task', [
            'label_id' => $label->id,
            'task_id' => $task->id,
        ]);
    }

    /**
     * Test of tasks delete.
     *
     * @return void
     */
    public function testDelete()
    {
        $task = Task::factory()->create();

        /** @var Task $task */
        $user = $task->creator;

        $response = $this->actingAs($user)->delete(route('tasks.destroy', $task));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertModelMissing($task);
    }
}
