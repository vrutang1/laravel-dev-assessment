<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Jobs\{Index,Create,Edit};
use App\Livewire\Pages\Skills\{Index as SkillsIndex};
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', '/admin/dashboard');

// Dashboard
Route::get('/dashboard', Dashboard::class)->name('dashboard');

// Skills
Route::get('/skills', SkillsIndex::class)->name('skills.index');

// Jobs
Route::get('/jobs', Index::class)->name('jobs.index');
Route::get('/jobs/create', Create::class)->name('jobs.create');
Route::get('/jobs/{jobId}/edit', Edit::class)->name('jobs.edit');

