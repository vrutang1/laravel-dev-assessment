<div>
    <div class="container mx-auto py-4">
        <div class="absolute right-0">
            @if (session()->has('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 1000)" x-show="show"
                    class="bg-green-500 text-white p-3 rounded-md shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 1000)" x-show="show"
                    class="bg-red-500 text-white p-3 rounded-md shadow-md">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="flex justify-between items-center py-8">
            <h1 class="text-2xl font-bold">Skills</h1>
        </div>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-8 w-full">
            @if (count($skills) > 0)
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-blue-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Name</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skills as $skill)
                                <tr class="border-b dark:border-gray-700">
                                    <th scope="row" class="px-4 py-3 font-semibold text-gray-900 whitespace-nowrap dark:text-white">{{ $skill->name }}</th>
                                    <td class="px-4 py-3 flex items-center justify-end">
                                        <button wire:click="editSkill({{$skill->id}})" class="text-sm px-3 py-1.5 rounded hover:bg-slate-100 transition-colors text-blue-700">Edit</button>
                                        <button wire:click="deleteSkill({{$skill->id}})" class="text-sm px-3 py-1.5 rounded hover:bg-slate-100 transition-colors text-red-600">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            </div>
            <div class="col-span-4">
                <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-4">
                    <div class="flex justify-between items-center py-8">
                        <h1 class="text-2xl font-bold">Add New SKill</h1>
                    </div>
                    <div class="flex flex-col space-y-2">
                        <label for="name" class="text-sm font-medium">Name</label>
                        <input type="text" id="name" class="rounded-lg border border-gray-300" wire:model="name" placeholder="Skill name" />
                        @error('name')
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <button wire:click="saveSkill" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        @if($skill_id)
                            Update
                        @else
                            Save
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
