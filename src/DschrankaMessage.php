<?php

namespace App\Helpers;

class DschrankaMessage {
    const FIELDS = ['type', 'sender', 'read', 'recipient', 'subject', 'status', 'attachments'];
    const TYPES = [
        'V' => 'Veřejná zpráva (adresát nebo odesílatel je OVM)',
        'K' => 'Komerční Poštovní datová zpráva smluvní',
        'I' => 'Komerční Poštovní datová zpráva smluvní, která iniciuje použití Odpovědní PDZ',
        'Y' => 'Komerční Poštovní datová zpráva smluvní, která iniciuje použití ODZ, již využitá pro odeslání ODZ',
        'X' => 'Komerční Poštovní datová zpráva smluvní, která iniciuje použití ODZ, nevyužitá leč exspirovaná',
        'A' => 'Komerční Poštovní datová zpráva dotovaná, která iniciuje použití Odpovědní PDZ',
        'B' => 'Komerční Poštovní datová zpráva dotovaná, která iniciuje použití ODZ, již využitá pro odeslání ODZ',
        'C' => 'Komerční Poštovní datová zpráva dotovaná, která iniciuje použití ODZ, nevyužitá leč exspirovaná',
        'O' => 'Odpovědní PDZ; zasílaná zdarma na účet odesílatele iniciační PDZ',
        'G' => 'PDZ zaslaná v režimu Dotování jinou schránkou na účet schránky donátora.',
        'E' => 'PDZ odeslaná pomocí předplacení (kreditu).',
    ];
    private $databox_id;
    private $id;
    private $read;
    private $type;
    private $sender;
    private $recipient;
    private $subject;
    private $status;
    private $attachments;

    public function __construct($databox_id, $id){
        $this->databox_id = $databox_id;
        $this->id = $id;
    }

    public static function fromArray($array){
        $new = new self($array['databox_id'], $array['id']);
        foreach(self::FIELDS as $field){
            $new->$field = $array[$field];
        }
        return $new;
    }

    public function get(){
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id;
        $response = DSchrankaHTTPClient::request('GET', $uri);
        return self::fromArray($response->json());
    }

    public function downloadDeliveryInfo(){
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id.'/delivery_info/download';
        $response = DSchrankaHTTPClient::request('GET', $uri);
        return new DSchrankaDeliveryInfoFile($response->json()['content']);
    }

    public function download(){
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id.'/download';
        $response = DSchrankaHTTPClient::request('GET', $uri);
        return new DSchrankaMessageFile($response->json()['content']);
    }

    public function markRead(){
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id;
        $response = DSchrankaHTTPClient::request('PUT', $uri, ['read' => true]);
        return true;
    }

    public function markUnread(){
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id;
        $response = DSchrankaHTTPClient::request('PUT', $uri, ['read' => false]);
        return true;
    }

    public function delete(){
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id;
        $response = DSchrankaHTTPClient::request('DELETE', $uri);
        return true;
    }

    public function downloadAttachment($num = null){
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id.'/attachments/'.$num;
        $response = DSchrankaHTTPClient::request('GET', $uri);
        if($num != null) return new DSchrankaAttachment($response->json());
        else {
            $list = [];
            foreach($response->json() as $item){
                array_push($list, new DSchrankaAttachment($item));
            }
            return $list;
        }
    }

    public function getStatusCode(){ return $this->status; }
    public function getStatus(){ return new DSchrankaMessageStatus($this->status); }
    public function getStatusShort(){ return (new DSchrankaMessageStatus($this->status))->short(); }
    public function getStatusLong(){ return (new DSchrankaMessageStatus($this->status))->long(); }
    public function getSender(){ return new DSchrankaMessageSender($this->sender['name'], $this->sender['address'], $this->sender['type']); }
    public function getRecipient(){ return new DSchrankaMessageRecipient($this->recipient['name'], $this->recipient['address']); }
    public function getTypeCode(){ return $this->type; }
    public function getType(){ return self::TYPES[$this->type]; }

    public function getRead(){ return $this->read; }
    public function getSubject(){ return $this->subject; }

    public function getAttachmentNames(){
        $list = [];
        foreach($this->attachments['dmFile'] as $attachment)
            array_push($list, $attachment['dmFileDescr']);
        return $list;
    }


}
