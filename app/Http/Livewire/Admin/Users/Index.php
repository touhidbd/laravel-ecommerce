<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $userId;

    public function deleteUser($userId)
    {
        $this->userId = $userId;
    }

    public function destroyCategory()
    {
        $user = User::findOrFail($this->userId)->first();

        if($this->userId == auth()->user()->id)
        {
            session()->flash('status', 'You can\'t delete your own profile!');
            $this->dispatchBrowserEvent('close-modal');
        }
        else
        {
            $user->delete();
            session()->flash('status', 'User deleted successfully!');
            $this->dispatchBrowserEvent('close-modal');            
        }
    }

    public function render()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.users.index', [
            'users' => $users
        ]);
    }
}
