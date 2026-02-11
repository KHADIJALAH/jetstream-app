//namespace App\Http\Livewire;

//use Livewire\Component;
//use Illuminate\Support\Facades\Auth;

//class NotificationsIndicator extends Component
//{
    // public $notifications = [];

//     public function mount()
//     {
//         if (Auth::check()) {
//             // On supprime le dd()
//             $this->notifications = Auth::user()->notifications()->latest()->take(5)->get();
//         } else {
//             $this->notifications = [];
//         }
//     }

//     public function render()
//     {
//         return view('livewire.notifications-indicator');
//     }
// }
