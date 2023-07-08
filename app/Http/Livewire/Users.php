<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;

/**
 * Class Users
 *
 * This component handles the CRUD operations for managing users.
 *
 * @package App\Http\Livewire
 */
class Users extends Component
{
    /**
     * The list of users.
     *
     * @var User[]
     */
    public $users;
    
    /**
     * The name of the user.
     *
     * @var string
     */
    public $name;
    
    /**
     * The email of the user.
     *
     * @var string
     */
    public $email;
    
    /**
     * The ID of the user being updated.
     *
     * @var int|null
     */
    public $user_id;
    
    /**
     * Flag to indicate if the update mode is enabled.
     *
     * @var bool
     */
    public $updateMode = false;
    
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->users = User::all();
        return view('livewire.users');
    }

    /**
     * Reset the input fields.
     *
     * @return void
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
    }

    /**
     * Store a new user.
     *
     * @return void
     */
    public function store()
    {
        $validation = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);
        $validation['password'] = '$2a$12$onoOLz8W1GU694PWYjvWpevMY78yYxOj10A0twjE0HS787ZaSLyYC'; //password

        User::create($validation);

        session()->flash('message', 'User created successfully');

        $this->resetInputFields();
    }

    /**
     * Edit an existing user.
     *
     * @param int $id The ID of the user to edit.
     * @return void
     */
    public function edit(int $id)
    {
        $this->updateMode = true;

        $user = User::find($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    /**
     * Cancel the edit mode and reset the input fields.
     *
     * @return void
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    /**
     * Update an existing user.
     *
     * @return void
     */
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if($this->user_id)
        {
            $user = User::find($this->user_id);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            $this->updateMode = false;
            session()->flash('message', 'User updated successfully');

            $this->resetInputFields();
        }
    }

    /**
     * Set the user ID for deletion confirmation.
     *
     * @param int $id The ID of the user to delete.
     * @return void
     */
    public function deleteConfirm(int $id)
    {
        $this->user_id = $id;
    }

    /**
     * Delete a user.
     *
     * @return void
     */
    public function delete()
    {
        User::find($this->user_id)->delete();
        session()->flash('message', 'User deleted successfully');
    }
}