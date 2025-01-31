<?php

namespace App\Livewire\Pages\Jobs;
use App\Models\Skill;
use App\Models\Job;
use App\Models\JobSkill;
use Livewire\WithFileUploads;
use Auth;
use Livewire\Component;

class Create extends Component
{
    use WithFileUploads;
    public $skills = [];
    public $selectedSkills = [];
    public $title;
    public $description;
    public $experience;
    public $salary;
    public $location;
    public $extra_info;
    public $company_name;
    public $logo;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'experience' => 'required|string|max:255',
        'salary' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'extra_info' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        'selectedSkills' => 'required|array|min:1'
    ];

    public function mount()
    {
        $this->skills = Skill::all();
    }

    public function render()
    {
        return view('livewire.pages.jobs.create');
    }

    public function create()
    {
        $this->validate();
        \DB::beginTransaction();
        try {
            $userId = Auth::id();
            $job = Job::create([
                'title' => $this->title,
                'description' => $this->description,
                'experience' => $this->experience,
                'salary' => $this->salary,
                'location' => $this->location,
                'extra_info' => $this->extra_info,
                'company_name' => $this->company_name,
                'created_by' => $userId,
                'updated_by' => $userId,
            ]);

            if ($this->logo) {
                $logoPath = $this->logo->store('company_logos', 'public');
                $job->logo = $logoPath;
                $job->save();
            }

            foreach ($this->selectedSkills as $skillId) {
                JobSkill::create([
                    'job_id' => $job->id,
                    'skill_id' => $skillId,
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]);
            }
            \DB::commit();
            session()->flash('success', 'Job posting created successfully!');
            return redirect()->to('/admin/jobs');
            $this->reset();
        } catch (\Exception $e) {
            \DB::rollBack();
            session()->flash('error', 'Something went wrong. Please try again.');
        }
    }
}
