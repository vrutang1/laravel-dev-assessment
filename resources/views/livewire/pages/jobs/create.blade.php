<div>
    <div class="container mx-auto py-4">
        <div class="flex justify-between items-center py-8">
            <h1 class="text-2xl font-bold">Create new job posting</h1>
        </div>
        <form wire:submit.prevent="create">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-8 w-full">
                    <div class="bg-white border dark:bg-gray-800 shadow sm:rounded-lg p-4 space-y-4">
                        <h1 class="text-xl font-semibold">Job details</h1>
                        <div class="flex flex-col space-y-2">
                            <label for="title" class="text-sm font-medium">Title</label>
                            <input type="text" id="name" class="rounded-lg border border-gray-300" wire:model="title" placeholder="Job Posting Title" />
                            @error('title')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="description" class="text-sm font-medium">Description</label>
                            <textarea  id="description" rows="3" class="rounded-lg border border-gray-300" wire:model="description" placeholder="Job Posting Description" />
                            </textarea>
                            @error('description')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex w-full space-x-4">
                            <div class="flex flex-col space-y-2 w-1/2">
                                <label for="experience" class="text-sm font-medium">Experience</label>
                                <input type="text" id="name" class="rounded-lg border border-gray-300" wire:model="experience" placeholder="Eg. 1-2 Yrs" />
                                @error('experience')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col space-y-2 w-1/2">
                                <label for="salary" class="text-sm font-medium">Salary</label>
                                <input type="text" id="name" class="rounded-lg border border-gray-300" wire:model="salary" placeholder="Eg. 4-5 Lacs PA" />
                                @error('salary')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex w-full space-x-4">
                            <div class="flex flex-col space-y-2 w-1/2">
                                <label for="location" class="text-sm font-medium">Location</label>
                                <input type="text" id="name" class="rounded-lg border border-gray-300" wire:model="location" placeholder="Eg. Remote / Pune" />
                                @error('location')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col space-y-2 w-1/2">
                                <label for="extra_info" class="text-sm font-medium">Extra Info</label>
                                <input type="text" id="name" class="rounded-lg border border-gray-300" wire:model="extra_info" placeholder="Eg. Full Time/ Part Time, Flexible" />
                                @error('extra_info')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 space-y-4">
                    <div class="bg-white border dark:bg-gray-800 shadow sm:rounded-lg p-4 space-y-4">
                        <h1 class="text-xl font-semibold">Company details</h1>
                        <div class="flex flex-col space-y-2">
                            <label for="company_name" class="text-sm font-medium">Name</label>
                            <input type="text" id="name" class="rounded-lg border border-gray-300" wire:model="company_name" placeholder="Company Name" />
                            @error('company_name')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-2">
                            <label for="logo" class="text-sm font-medium">Logo</label>
                            <input type="file" id="logo" class="" wire:model="logo"/>
                        </div>
                    </div>
                    <div class="bg-white border dark:bg-gray-800 shadow sm:rounded-lg p-4 space-y-4">
                        <h1 class="text-xl font-semibold">Skills</h1>
                        @foreach ($skills as $skill)
                            <div class="flex items-center">
                                <input type="checkbox" value="{{ $skill->id }}" wire:model="selectedSkills" id="skill-{{ $skill->id }}"
                                    class="w-5 h-5 text-blue-600 border-gray-300 rounded-md focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer">
                                <label for="skill-{{ $skill->id }}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">{{ $skill->name }}</label>
                            </div>
                        @endforeach
                        @error('selectedSkills')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
