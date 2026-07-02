<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Attendees;

class Sidebar extends Component
{
    public function render()
    {
        return view('livewire.sidebar', [
            'totalAttendees' => Attendees::count(),
        ]);
    }
}
?>

