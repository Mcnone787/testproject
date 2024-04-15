<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Curso;
use App\Models\Recurso;

class AdriaTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/testAjax');

        $response->assertStatus(200);
    }
    public function test_admin_panel_can_create_user(): void
    {
        $Curso = Curso::factory()->create();

        $response =  $this->post('/createcurso', [
            'nombre' => "nombre curso testchanged",
            'etapa' => "teest",
            'descripcion' => "ddescripciontest",
            'visible' => 1,
            
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'success' => true,

            'message' => [
                'nombre' => "nombre curso testchanged",
            'etapa' => "teest",
            'descripcion' => "ddescripciontest",
            'visible' => 1,
            ]
        ]);
    }

}
