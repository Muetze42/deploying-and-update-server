<?php

namespace App\Jobs\Release;

use App\Mail\Releases\PublishFailed;
use App\Mail\Releases\PublishSuccessful;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Release;
use Illuminate\Support\Facades\Storage;
use VirusTotal;
use Illuminate\Support\Facades\Mail;

class VirusScanBeforeActivate implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The Release instance.
     *
     * @var \App\Models\Release
     */
    protected Release $release;

    /**
     * Sleep in seconds between each VirusTotal API request.
     *
     * @var int
     */
    protected int $apiSleep = 20;

    /**
     * Create a new job instance.
     */
    public function __construct(Release $release)
    {
        $this->release = $release;
    }

    /**
     * Execute the job.
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \NormanHuth\VirusTotal\Exceptions\VirusTotalApiException
     */
    public function handle(): void
    {
        set_time_limit(0);
        $file = Storage::disk('releases')
            ->path($this->release->app->getKey() . '/' . $this->release->filename);

        $upload = VirusTotal::scanFile($file);
        $analysisId = $upload['data']['id'];
        sleep($this->apiSleep);
        $this->release->forceFill(['virus_total_id' => $analysisId])->save();
        $this->analyseFile($analysisId);
    }

    /**
     * Check file analysis.
     *
     * @param string $analysisId
     *
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function analyseFile(string $analysisId): void
    {
        $result = VirusTotal::analyseUrlOrFile($analysisId);
        $status = $result['data']['data']['attributes']['status'];

        if ($status != 'completed') {
            sleep($this->apiSleep);
            $this->analyseFile($analysisId);
            return;
        }

        $stats = $result['data']['data']['attributes']['stats'];
        $success = !$stats['harmless'] && !$stats['malicious'] && !$stats['suspicious'];

        $this->release->forceFill([
            'active' => $success,
            'virus_total_stats' => $stats
        ])->save();

        $mailable = $success ? new PublishSuccessful($this->release) : new PublishFailed($this->release);
        Mail::to($this->release->author)->send($mailable);
    }
}
