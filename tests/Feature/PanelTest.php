<?php

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\Pages\ListUsers;
use App\Models\User;

use function Pest\Laravel\be;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

beforeEach(function () {
    be($this->user = User::factory()->create());
});

it('will load', function () {
    get(UserResource::getUrl())->assertSuccessful();
});

it('shows users', function () {
    $users = User::factory(5)->create();

    livewire(ListUsers::class)
        ->assertSuccessful()
        ->assertCanSeeTableRecords($users)
        ->assertSee($users->first()->name);
});
