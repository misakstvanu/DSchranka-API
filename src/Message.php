<?php

namespace Misakstvanu\DschrankaApi;

class Message {
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
    private int $databox_id;
    private int $id;
    private bool $read;
    private string $type;
    private array $sender;
    private array $recipient;
    private string $subject;
    private int $status;
    private array $attachments;

    public function __construct($databox_id, $id){
        $this->databox_id = $databox_id;
        $this->id = $id;
    }

    public static function fromArray($array): self{
        $new = new self($array['databox_id'], $array['id']);
        foreach(self::FIELDS as $field){
            $new->$field = $array[$field];
        }
        return $new;
    }

    public function get(): self{
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id;
        $response = HTTPClient::request('GET', $uri);
        return self::fromArray($response->json());
    }

    public function downloadDeliveryInfo(): DeliveryInfoFile{
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id.'/delivery_info/download';
        $response = HTTPClient::request('GET', $uri);
        return new DeliveryInfoFile($response->json()['content']);
    }

    public function download(): MessageFile{
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id.'/download';
        $response = HTTPClient::request('GET', $uri);
        return new MessageFile($response->json()['content']);
    }

    public function markRead(): bool{
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id;
        $response = HTTPClient::request('PUT', $uri, ['read' => true]);
        return true;
    }

    public function markUnread(): bool{
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id;
        $response = HTTPClient::request('PUT', $uri, ['read' => false]);
        return true;
    }

    public function delete(): bool{
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id;
        $response = HTTPClient::request('DELETE', $uri);
        return true;
    }

    public function downloadAttachment($num = null): Attachment|array{
        $uri = '/databox/'.$this->databox_id.'/messages/'.$this->id.'/attachments/'.$num;
        $response = HTTPClient::request('GET', $uri);
        if($num != null) {
            $data = $response->json();
            return new Attachment($data['dmMimeType'], $data['dmFileDescr'], $data['dmEncodedContext']);
        } else {
            $list = [];
            foreach($response->json() as $item){
                $list[] = new Attachment($item['dmMimeType'], $item['dmFileDescr'], $item['dmEncodedContext']);
            }
            return $list;
        }
    }

    public function getStatusCode(): int{ return $this->status; }
    public function getStatus(): MessageStatus{ return new MessageStatus($this->status); }
    public function getStatusShort(): string{ return (new MessageStatus($this->status))->short(); }
    public function getStatusLong(): string{ return (new MessageStatus($this->status))->long(); }
    public function getSender(): MessageSender{ return new MessageSender($this->sender['name'], $this->sender['address'], $this->sender['type']); }
    public function getRecipient(): MessageRecipient{ return new MessageRecipient($this->recipient['name'], $this->recipient['address']); }
    public function getTypeCode(): string{ return $this->type; }
    public function getType(): string{ return self::TYPES[$this->type]; }

    public function getRead(): bool{ return $this->read; }
    public function getSubject(): string{ return $this->subject; }

    public function getAttachmentNames(): array{
        $list = [];
        foreach($this->attachments['dmFile'] as $attachment)
            $list[] = $attachment['dmFileDescr'];
        return $list;
    }


}
