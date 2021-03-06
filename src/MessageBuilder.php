<?php

namespace Misakstvanu\DschrankaApi;

class MessageBuilder {
    private int $databox_id;

    public function __construct(int $databox_id){
        $this->databox_id = $databox_id;
    }

    private function getList(string $uri, bool $trashed = false, \DateTime $from = null, \DateTime $to = null): array{
        $response = HTTPClient::request('GET', $uri, [
            'trash' => $trashed,
            'from' => $from?->getTimestamp(),
            'to' => $to?->getTimestamp()
        ]);
        $list = [];
        foreach($response->json() as $message)
            $list[] = Message::fromArray($message);
        return $list;
    }

    /**
     * @return array<Message>
     */
    function received(bool $trashed = false, \DateTime $from = null, \DateTime $to = null): array{
        $uri = '/databox/'.$this->databox_id.'/messages/received';
        return $this->getList($uri, $trashed, $from, $to);
    }
    /**
     * @return array<Message>
     */
    function sent(bool $trashed = false, \DateTime $from = null, \DateTime $to = null): array{
        $uri = '/databox/'.$this->databox_id.'/messages/sent';
        return $this->getList($uri, $trashed, $from, $to);
    }


}
