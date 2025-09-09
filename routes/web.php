<?php

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Auth\Login::class)->name('login');
Route::get('/super-admin', App\Livewire\SuperAdmin\Idx::class)->name('superadmin');

Route::get('/super-admin/university', \App\Livewire\SuperAdmin\University\Idx::class)->name('super-admin.university.idx');
Route::get('/super-admin/faculty', \App\Livewire\SuperAdmin\Faculty\Idx::class)->name('super-admin.faculty.idx');
Route::get('/super-admin/cluster', \App\Livewire\SuperAdmin\Cluster\Idx::class)->name('super-admin.cluster.idx');
Route::get('/super-admin/client', \App\Livewire\SuperAdmin\Client\Idx::class)->name('super-admin.client.idx');
Route::get('/client', \App\Livewire\Client\Idx::class)->name('client.idx');
Route::get('/client/data/basic', \App\Livewire\Client\Data\Basic\Idx::class)->name('client.data.basic');
Route::get('/client/program', \App\Livewire\Client\Program\Idx::class)->name('client.program');
Route::get('/program', \App\Livewire\Program\Idx::class)->name('program.idx');
Route::get('/program/data/activities', \App\Livewire\Program\Data\Activities\Idx::class)->name('program.data.activities.idx');
Route::get('/program/data/students', \App\Livewire\Program\Data\Students\Idx::class)->name('program.data.students.idx');
Route::get('/program/data/subjects', \App\Livewire\Program\Data\Subjects\Idx::class)->name('program.data.subjects.idx');
Route::get('/program/data/teachers', \App\Livewire\Program\Data\Teachers\Idx::class)->name('program.data.teachers.idx');
Route::get('/program/data/specialization', \App\Livewire\Program\Data\Specializations\Idx::class)->name('program.specialization.idx');
Route::get('/program/time/teachers', \App\Livewire\Program\Time\Teachers\Idx::class)->name('program.time.teachers.idx');

