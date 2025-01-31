<?php

namespace App\Livewire\Pages\Jobs;
use App\Models\Job;
use App\Models\JobSkill;
use Livewire\Component;

class Index extends Component
{
    public array $jobs = [];

    public function mount()
    {
        $this->jobs = Job::with('jobSkills.skill')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.pages.jobs.index');
    }

    public function deleteJob($id)
    {
        try{
            $job = Job::find($id);
            JobSkill::where('job_id', $id)->delete();
            $job->delete();
            session()->flash('success',"Job Deleted Successfully!!");
            return redirect()->to('/admin/jobs');
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}
