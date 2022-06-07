<?php

namespace Misakstvanu\DschrankaApiLaravel;

class DSchrankaDatabox {
    const FIELDS = ['username', 'name', 'created_at', 'updated_at', 'type'];
    private $databox_id;
    private $username;
    private $name;
    private $created_at;
    private $updated_at;
    private $type;

    public function __construct($databox_id){
        $this->databox_id = $databox_id;
    }

    public static function fromArray($array){
        $new = new self($array['databox_id']);
        foreach(self::FIELDS as $field){
            $new->$field = $array[$field];
        }
        return $new;
    }

    public function messages($id = null){
        if($id)
            return new DschrankaMessage($this->databox_id, $id);
        else
            return new DschrankaMessageBuilder($this->databox_id);
    }

    public function drafts($id = null){
        if($id){
            $draft = new DSchrankaDraft($this->databox_id);
            $draft->setDraftId($id);
            return $draft;
        } else return new DSchrankaDraftBuilder($this->databox_id);
    }

    public function get(){
        $uri = '/databox/'.$this->databox_id;
        $response = DSchrankaHTTPClient::request('GET', $uri);
        return self::fromArray($response->json());
    }

    public function delete(){
        $uri = '/databox/'.$this->databox_id;
        $response = DSchrankaHTTPClient::request('DELETE', $uri);
        return true;
    }

    public function updatePassword($password){
        $uri = '/databox/'.$this->databox_id;
        $response = DSchrankaHTTPClient::request('PUT', $uri, ['password' => $password]);
        return true;
    }

    public function findAddress($query, $type = null){
        $uri = '/databox/'.$this->databox_id.'/address/search';
        $response = DSchrankaHTTPClient::request('GET', $uri, ['query' => $query, 'type' => $this->type]);
        $list = [];
        foreach($response->json() as $address)
            array_push($list, DSchrankaAddress::fromArray($address));
        return $list;
    }

    public function createMessage($recipient = null, $subject = null, $personalDelivery = null, $publishIdentity = null, $textMessage = null, $toHands = null,
                           $senderRef = null, $senderIdent = null, $recipientRef = null, $recipientIdent = null,
                           $lawTitleNum = null, $lawYear = null, $lawSection = null, $lawParagraph = null, $lawPoint = null,
                           $attachments = []){
        return new DSchrankaDraft($this->databox_id, $recipient, $subject, $personalDelivery, $publishIdentity, $textMessage, $toHands,
                                    $senderRef, $senderIdent, $recipientRef, $recipientIdent,
                                    $lawTitleNum, $lawYear, $lawSection, $lawParagraph, $lawPoint,
                                    $attachments);
    }

    public function getId(){ return $this->databox_id; }
    public function getName(){ return $this->name; }
    public function getType(){ return $this->type; }
    public function getUsername(){ return $this->username; }
    public function getCreatedAt(){ return new \DateTime($this->created_at); }
    public function getUpdatedAt(){ return $this->updated_at ? new \DateTime($this->created_at) : null; }

}
