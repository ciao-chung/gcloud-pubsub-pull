<?php

namespace App\Console\Commands;

use Google\Cloud\PubSub\Message;
use Illuminate\Console\Command;
use Google\Cloud\PubSub\PubSubClient;

class PushMessage extends Command
{
    protected $serviceAccountKeyPath, $topicName, $subscription;
    protected $signature = 'push-message
{topic : 訂閱項目名稱}
{--path= : service account金鑰路徑}
';
    protected $description = 'Push gCloud Pub/Sub訊息';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->topicName = $this->argument('topic');
        $this->serviceAccountKeyPath = $this->option('path');
        $this->push();
    }

    protected function push()
    {
        $pubSub = new PubSubClient([
            'keyFilePath' => $this->serviceAccountKeyPath,
        ]);
        $topic = $pubSub->topic($this->topicName);
        $this->line('開始Push訊息');
        $result = $topic->publish([
            'data' => 'data...',
            'attributes' => [
                'time' => now()->format('Y-m-d H:i:s'),
            ]
        ]);
        $this->question('訊息Push完成');
        dd($result);
    }
}
