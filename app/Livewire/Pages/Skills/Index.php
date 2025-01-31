<?php

namespace App\Livewire\Pages\Skills;
use App\Models\Skill;
use Auth;
use Livewire\Component;

class Index extends Component
{
    public $skills;
    public $skill_id;
    public $name;
    protected $listeners = ['clearError' => 'clearFieldError'];

    public function mount()
    {
        $this->skills = Skill::all();
    }

    public function render()
    {
        return view('livewire.pages.skills.index');
    }

    public function clearFieldError($field)
    {
        $this->resetErrorBag($field);
    }

    public function saveSkill()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);
        try {
            $userId = Auth::id();
            if ($this->skill_id) {
                $skill = Skill::find($this->skill_id);
                $skill->name = $this->name;
                $skill->updated_by = $userId;
                $skill->save();
                session()->flash('success','Skill Updated Successfully!!');
            } else {
                if (Skill::where('name', $this->name)->exists()) {
                    session()->flash('error', 'Skill already exists!');
                    return;
                }
                $skill = new Skill();
                $skill->name = $this->name;
                $skill->created_by = $userId;
                $skill->updated_by = $userId;
                $skill->save();
                // Skill::create(['name' => $this->name, 'created_by' => $userId , 'updated_by' => $userId]);
                session()->flash('success','Skill Created Successfully!!');
            }
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }
        $this->skills = Skill::all();
        $this->resetInputFields();
    }

    public function editSkill($id)
    {
        $skill = Skill::find($id);
        $this->skill_id = $skill->id;
        $this->name = $skill->name;
    }

    public function deleteSkill($id)
    {
        try{
            $skill = Skill::find($id);
            $skill->delete();
            session()->flash('success',"Skill Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
        $this->skills = Skill::all();
    }

    private function resetInputFields()
    {
        $this->skill_id = null;
        $this->name = '';
    }
}
