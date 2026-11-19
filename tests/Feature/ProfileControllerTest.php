<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_their_profile_separately_from_the_dashboard(): void
    {
        $user = User::factory()->create([
            'full_name' => 'Profile Owner',
            'username' => 'profile-owner',
            'email' => 'profile@example.com',
        ]);

        $this->actingAs($user)->get(route('profile.show'))
            ->assertSee('My Profile')
            ->assertSee('Profile Owner')
            ->assertSee('profile-owner')
            ->assertSee('profile@example.com')
            ->assertSee('User ID')
            ->assertSee('id="editProfileButton"', false);

        $this->actingAs($user)->get(route('dashboard'))
            ->assertSee('Account Overview')
            ->assertDontSee('profile@example.com')
            ->assertDontSee('id="profile-view"', false);
    }

    public function test_guest_is_redirected_to_login_from_profile(): void
    {
        $this->get(route('profile.show'))->assertRedirect(route('login'));
    }

    public function test_user_can_update_their_own_profile(): void
    {
        $user = User::factory()->create([
            'full_name' => 'Original Name',
            'username' => 'original-user',
            'email' => 'original@example.com',
        ]);

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'full_name' => 'Updated Name',
            'username' => 'updated-user',
            'email' => 'updated@example.com',
            'password' => '',
            'password_confirmation' => '',
        ]);

        $response->assertRedirect(route('profile.show').'#profile');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'full_name' => 'Updated Name',
            'username' => 'updated-user',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_invalid_profile_changes_are_not_saved_and_show_the_edit_form(): void
    {
        $user = User::factory()->create([
            'full_name' => 'Original Name',
            'username' => 'original-user',
            'email' => 'original@example.com',
        ]);

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'full_name' => '',
            'username' => 'original-user',
            'email' => 'original@example.com',
        ]);

        $response->assertRedirect(route('profile.show').'#profile-edit');
        $response->assertSessionHasErrors(['full_name']);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'full_name' => 'Original Name',
            'username' => 'original-user',
            'email' => 'original@example.com',
        ]);
    }
}
