<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Schedule::command('check:crearte-contribution')
    ->monthly()
    ->withoutOverlapping(); 
Schedule::call(function () {
    $directory = storage_path('app/public/livewire-tmp');
    if (is_dir($directory)) {
        collect(glob($directory . '/*'))->filter(fn($file) => filemtime($file) < now()->subHours(24)->timestamp)->each(fn($file) => unlink($file));}})->daily()->name('clean-livewire-tmp');
