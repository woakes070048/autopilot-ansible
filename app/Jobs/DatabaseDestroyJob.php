<?php

namespace App\Jobs;

use App\Playbooks\DatabaseDestroyPlaybook;
use Exception;
use App\Database;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DatabaseDestroyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The database instance.
     *
     * @var Database
     */
    public $database;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 360;

    /**
     * Create a new job instance.
     *
     * @param Database $database
     * @return void
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->database->isProvisioning()) {
            return $this->delete();
        }

        if ($this->database->server->isReady() && !$this->database->isBusy()) {
            $this->database->markAsDestroying();

            $task = $this->database->run(
                new DatabaseDestroyPlaybook($this->database)
            );

            if ($task->successful()) {
                $this->database->markAsDestroyed();
                $this->database->forceDelete();
                return $this->delete();
            }

            $this->database->markAsError();
        }

        $this->release(30);
    }

    /**
     * Handle a job failure.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed($exception)
    {
        $this->database->markAsError();
    }
}
