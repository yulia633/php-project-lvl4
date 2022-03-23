<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Label;

class LabelControllerTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    /**
     * Test of labels index.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    /**
     * Test of labels create.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertOk();
    }

    /**
     * Test of labels store.
     *
     * @return void
     */
    public function testStore()
    {
        /** @var array $data */
        $data = Label::factory()
            ->make()
            ->only(['name', 'description']);

        $response = $this->actingAs($this->user)->post(route('labels.store', $data));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    /**
     * Test of labels edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $label = Label::factory()->create();

        $response = $this->actingAs($this->user)->get(route('labels.edit', $label));
        $response->assertOk();
    }

    /**
     * Test of labels update.
     *
     * @return void
     */
    public function testUpdate()
    {
        $label = Label::factory()->create();

        /** @var array $data */
        $data = Label::factory()->make()
            ->only(['name', 'description']);

        $response = $this->actingAs($this->user)->patch(route('labels.update', $label), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('labels', $data);
    }

    /**
     * Test of labels delete.
     *
     * @return void
     */
    public function testDelete()
    {
        /** @var Label $label */
        $label = Label::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertModelMissing($label);
    }
}
