<?php
namespace SlackApprove\Slack;

class SlackClient {
    
    public function __construct(public string $webhookURL) {}

    /**
     * Send a message to slack
     *
     * @param string $text
     * @return boolean
     */
    public function sendMessage(string $text): bool {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->webhookURL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(compact('text')));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        
        return (bool)curl_exec($ch);
    }
}