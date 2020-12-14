<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Google\Cloud\PubSub\PubSubClient;

class PullMessages extends Command
{
    protected $serviceAccountKeyPath, $topicName, $subscriptionName;
    protected $signature = 'pull-messages
{topic : 訂閱項目名稱}
{--path= : service account金鑰路徑}
{--sub= : 訂閱項目名稱}
';
    protected $description = 'Pull gCloud Pub/Sub訊息';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->line('開始Pull');
        $this->topicName = $this->argument('topic');
        $this->subscriptionName = $this->option('sub');
        $this->serviceAccountKeyPath = $this->option('path');
        $this->pull();
    }

    protected function pull()
    {
        $pubSub = new PubSubClient([
            'keyFilePath' => $this->serviceAccountKeyPath,
        ]);
        $subscription = $pubSub->subscription($this->subscriptionName);
        $messages = $subscription->pull();
        dd($messages);
    }
}
