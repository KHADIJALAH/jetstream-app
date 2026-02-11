<?php
namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ActivityForm extends Component
{
    public $name;
    public $description;
    public $location;
    public $price;
    public $duration;
    public $category;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|min:50',
        'location' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'duration' => 'required|integer|min:1',
        'category' => 'required|string|max:255'
    ];

    public function store()
    {
        $this->validate();

        try {
            Activity::create([
                'name' => $this->name,
                'slug' => $this->generateSlug(),
                'description' => $this->description,
                'location' => $this->location,
                'price' => $this->price,
                'duration' => $this->duration,
                'category' => $this->category
            ]);

            return redirect()->route('admin.activities.index')
                ->with('success', 'Activité créée avec succès !');

        } catch (QueryException $e) {
            $this->handleDatabaseError($e);
        }
    }

    private function generateSlug()
    {
        return Str::slug($this->name) . '-' . uniqid();
    }

    private function handleDatabaseError(QueryException $e)
    {
        if ($e->errorInfo[1] === 1062) {
            $this->addError('slug', 'Ce nom existe déjà. Veuillez le modifier légèrement.');
            return;
        }

        throw $e;
    }

    public function render()
    {
        return view('admin.activities.create');
    }
}