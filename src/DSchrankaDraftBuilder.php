<?php

namespace App\Helpers;

use App\Models\Drafts;

class DSchrankaDraftBuilder {
    private $databox_id;

    public function __construct($databox_id){
        $this->databox_id = $databox_id;
    }

    private function getList($uri, \DateTime $from = null, \DateTime $to = null){
        $response = DSchrankaHTTPClient::request('GET', $uri, [
            'from' => $from?->getTimestamp(),
            'to' => $to?->getTimestamp()
        ]);
        $list = [];
        foreach($response->json() as $draft)
            array_push($list, DSchrankaDraft::fromArray($draft));
        return $list;
    }

    public function list(\DateTime $from = null, \DateTime $to = null){
        $uri = '/databox/'.$this->databox_id.'/drafts';
        return $this->getList($uri, $from, $to);
    }


}
