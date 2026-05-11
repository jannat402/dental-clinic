<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('users:archive-inactive')->daily();
Schedule::command('notifications:send-reminders')->dailyAt('08:00');
Schedule::command('appointments:reallocate')->dailyAt('06:00');
