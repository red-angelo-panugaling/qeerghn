<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeDataTableTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_real_employee_records_in_the_data_table(): void
    {
        Employee::create([
            'name' => 'Jordan Example',
            'position' => 'Lab Technician',
            'office' => 'Main Office',
            'age' => 31,
            'start_date' => '2024-01-15',
            'salary' => 54000,
        ]);

        $response = $this->actingAs(User::factory()->create(['role' => User::ROLE_ADMIN]))
            ->get(route('tables'));

        $response->assertSee('DataTable Example');
        $response->assertSee('Jordan Example');
        $response->assertSee('Lab Technician');
        $response->assertSee('$54,000.00');
    }

    public function test_regular_user_cannot_view_employee_data_table(): void
    {
        $this->actingAs(User::factory()->create(['role' => User::ROLE_USER]))
            ->get(route('tables'))
            ->assertForbidden();
    }
}
