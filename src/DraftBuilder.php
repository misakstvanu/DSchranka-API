<?php

namespace Misakstvanu\DschrankaApi;

class DraftBuilder {
    private int $databox_id;

    public function __construct($databox_id){
        $this->databox_id = $databox_id;
    }

    private function getList($uri, \DateTime $from = null, \DateTime $to = null): array{
        $response = HTTPClient::request('GET', $uri, [
            'from' => $from?->getTimestamp(),
            'to' => $to?->getTimestamp()
        ]);
        $list = [];
        foreach($response->json() as $draft)
            $list[] = Draft::fromArray($draft);
        return $list;
    }

    public function list(\DateTime $from = null, \DateTime $to = null): array{
        $uri = '/databox/'.$this->databox_id.'/drafts';
        return $this->getList($uri, $from, $to);
    }


}
