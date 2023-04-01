<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Spatie\GitHubWebhooks\Models\GitHubWebhookCall;

class Deploy implements ShouldQueue
{
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public GitHubWebhookCall $gitHubWebhookCall;

    public function __construct(
        public GitHubWebhookCall $webhookCall
    )
    {
    }

    public function handle()
    {
        try {
            if ($this->webhookCall->payload()['action'] === "closed"
                && !empty($this->webhookCall->payload()['pull_request']['base']['label'])
                // ToDo probably remove/change label to be in env
                && $this->webhookCall->payload()['pull_request']['base']['label'] === "AiAe:main"
                && $this->webhookCall->payload()['pull_request']['merged'] === true) {
                Log::info('Deploying!');
                exec(config('app.jobs_deploy_path'), $output);

                Log::info(implode(PHP_EOL, $output));
                Log::info('Deploy finished');
            }
        } catch (\Exception $exception) {
            Log::error("Failed to deploy");
            Log::error($exception->getMessage());
        }
    }
}
