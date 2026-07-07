<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Portal/beranda publik dapat diakses tanpa login.
     */
    public function test_beranda_dapat_diakses(): void
    {
        $this->get('/')->assertStatus(200)->assertSee('Akses Layanan');
    }
}
