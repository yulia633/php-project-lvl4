<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusControllerTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * Test of task statuses index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }
    /**
     * Test of task statuses create.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));
        $response->assertOk();
    }

    /**
     * Test of task statuses store.
     *
     * @return void
     */
    public function testStore()
    {
        /** @var array $data */
        $data = TaskStatus::factory()
        ->make()
        ->only(['name']);

        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), $data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    /**
     * Test of task statuses edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $status = TaskStatus::factory()->create();

        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', $status));
        $response->assertOk();
    }

    /**
     * Test of task statuses update.
     *
     * @return void
     */
    public function testUpdate()
    {
        $status = TaskStatus::factory()->create();

        /** @var array $data */
        $data = TaskStatus::factory()
        ->make()
        ->only(['name']);

        $response = $this->actingAs($this->user)->patch(route('task_statuses.update', $status), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('task_statuses', $data);
    }

    /**
     * Test of task statuses delete.
     *
     * @return void
     */
    public function testDelete()
    {
        /** @var TaskStatus $taskStatus */
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->actingAs($this->user)
            ->delete(route('task_statuses.destroy', ['task_status' => $taskStatus]));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertModelMissing($taskStatus);
    }
}
