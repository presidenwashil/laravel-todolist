<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "raihan",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Presiden"
                ],
                [
                    "id" => "2",
                    "todo" => "Washil"
                ]
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("Presiden")
            ->assertSeeText("2")
            ->assertSeeText("Washil");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "raihan"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "raihan"
        ])->post("/todolist", [
                    "todo" => "Presiden"
                ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "raihan",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Presiden"
                ],
                [
                    "id" => "2",
                    "todo" => "Washil"
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect("/todolist");
    }


}
