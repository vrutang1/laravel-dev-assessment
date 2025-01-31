<?php

namespace App\Livewire\Pages\Jobs;
use App\Models\Job;
use App\Models\Skill;
use App\Models\JobSkill;
use Livewire\WithFileUploads;
use Auth;
use Livewire\Component;

class Edit extends Component
{
    use WithFileUploads;

    public $jobId;
    public $job;
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
        'extra_info' => 'nullable|string|max:255',
        'company_name' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        'selectedSkills' => 'required|array|min:1'
    ];

    public function mount($jobId)
    {
        $this->job = Job::with('jobSkills')->findOrFail($jobId);
        $this->title = $this->job->title;
        $this->description = $this->job->description;
        $this->experience = $this->job->experience;
        $this->salary = $this->job->salary;
        $this->location = $this->job->location;
        $this->extra_info = $this->job->extra_info;
        $this->company_name = $this->job->company_name;
        $this->selectedSkills = $this->job->jobSkills->pluck('skill_id')->toArray();
        $this->skills = Skill::all();
    }

    public function render()
    {
        return view('livewire.pages.jobs.edit');
    }

    public function update()
    {

        $this->validate();
        \DB::beginTransaction();
        try {
            $userId = Auth::id();
            $this->job->update([
                'title' => $this->title,
                'description' => $this->description,
                'experience' => $this->experience,
                'salary' => $this->salary,
                'location' => $this->location,
                'extra_info' => $this->extra_info,
                'company_name' => $this->company_name,
            ]);

            if ($this->logo) {
                $logoPath = $this->logo->store('company_logos', 'public');
                $this->job->logo = $logoPath;
            }

            JobSkill::where('job_id', $this->job->id)->delete();

            foreach ($this->selectedSkills as $skillId) {
                JobSkill::create([
                    'job_id' => $this->job->id,
                    'skill_id' => $skillId,
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]);
            }
            \DB::commit();
            session()->flash('success', 'Job updated successfully!');
            $this->reset();
            return redirect()->to('/admin/jobs');
        } catch (\Exception $e) {
            \DB::rollBack();
            session()->flash('error', 'Something went wrong. Please try again.');
        }
    }
}
