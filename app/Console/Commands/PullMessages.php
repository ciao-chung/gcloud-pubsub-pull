<?php

namespace App\Console\Commands;

use Google\Cloud\PubSub\Message;
use Illuminate\Console\Command;
use Google\Cloud\PubSub\PubSubClient;

class PullMessages extends Command
{
    protected $serviceAccountKeyPath, $subscription, $subscriptionName;
    protected $signature = 'pull-messages
{sub : 訂閱項目名稱}
{--path= : service account金鑰路徑}
';
    protected $description = 'Pull gCloud Pub/Sub訊息';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->subscriptionName = $this->argument('sub');
        $this->serviceAccountKeyPath = $this->option('path');
        $this->pull();
    }

    protected function pull()
    {
        $pubSub = new PubSubClient([
            'keyFilePath' => $this->serviceAccountKeyPath,
        ]);
        $this->subscription = $pubSub->subscription($this->subscriptionName);
        $this->line('開始Pull');
        $messages = $this->subscription->pull();
        foreach ($messages as $index => $message) {
            $this->processMessage($index, $message);
        }
        $this->question('訊息Pull完成');
    }

    protected function processMessage(int $index, Message $message)
    {
        $no = $index+1;
        $this->question("正在讀取第{$no}筆訊息");
        $this->line("messageId: {$message->id()}");
        $this->line("attributes: ".json_encode($message->attributes(), true));

        // 確認(Ack)
        $this->line('正在確認(Ack)訊息');
        $this->subscription->acknowledge($message);
    }
}
