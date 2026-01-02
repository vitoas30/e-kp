<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use App\Models\User;
use App\Notifications\SystemNotification;
use Carbon\Carbon;

class CheckProjectDeadlines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'projects:check-deadlines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for project deadlines (H-1, Today, Overdue) and notify managers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking project deadlines...');

        // 1. Check H-1
        $tomorrow = Carbon::tomorrow()->toDateString();
        $h1Projects = Project::whereDate('end_date', $tomorrow)
                             ->whereNotIn('status', ['completed', 'cancelled'])
                             ->get();

        foreach ($h1Projects as $project) {
            $manager = User::find($project->manager_id);
            if ($manager) {
                $manager->notify(new SystemNotification(
                    'Project Deadline Reminder',
                    "Project '{$project->name}' is due tomorrow.",
                    'warning',
                    route('user.projects.index') // Or specific show route
                ));
            }
        }
        $this->info("H-1 Notifications sent: " . $h1Projects->count());

        // 2. Check Today (H-0)
        $today = Carbon::today()->toDateString();
        $h0Projects = Project::whereDate('end_date', $today)
                             ->whereNotIn('status', ['completed', 'cancelled'])
                             ->get();

        foreach ($h0Projects as $project) {
            $manager = User::find($project->manager_id);
            if ($manager) {
                $manager->notify(new SystemNotification(
                    'Project Deadline Today',
                    "Project '{$project->name}' deadline is TODAY.",
                    'danger',
                    route('user.projects.index')
                ));
            }
        }
        $this->info("Today Notifications sent: " . $h0Projects->count());

        // 3. Check Overdue (Past Deadline)
        // We might want to avoid spamming everyday, so maybe only check yesterday
        $yesterday = Carbon::yesterday()->toDateString();
        $overdueProjects = Project::whereDate('end_date', $yesterday)
                                  ->whereNotIn('status', ['completed', 'cancelled'])
                                  ->get();

        foreach ($overdueProjects as $project) {
            $manager = User::find($project->manager_id);
            if ($manager) {
                $manager->notify(new SystemNotification(
                    'Project Overdue',
                    "Project '{$project->name}' is overdue!",
                    'danger',
                    route('user.projects.index')
                ));
            }
        }
        $this->info("Overdue Notifications sent: " . $overdueProjects->count());

        $this->info('Done.');
    }
}
