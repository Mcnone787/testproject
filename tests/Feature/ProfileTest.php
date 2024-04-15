<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function rutahome(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
