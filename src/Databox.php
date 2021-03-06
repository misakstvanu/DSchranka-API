<?php

namespace Misakstvanu\DschrankaApi;

class Databox {
    const FIELDS = ['username', 'name', 'created_at', 'updated_at', 'type'];
    private int $databox_id;
    private string $username;
    private string $name;
    private string $created_at;
    private string $updated_at;
    private string $type;

    public function __construct(int $databox_id){
        $this->databox_id = $databox_id;
    }

    public function login(){
        $uri = '/databox/'.$this->databox_id.'/login';
        $response = HTTPClient::request('GET', $uri);
        return $response->json()['url'];
    }

    public static function fromArray(array $array): self{
        $new = new self($array['databox_id']);
        foreach(self::FIELDS as $field){
            $new->$field = $array[$field];
        }
        return $new;
    }

    public function messages(int $id = null): Message|MessageBuilder{
        if($id)
            return new Message($this->databox_id, $id);
        else
            return new MessageBuilder($this->databox_id);
    }

    public function drafts(int $id = null): Draft|DraftBuilder{
        if($id){
            $draft = new Draft($this->databox_id);
            $draft->setDraftId($id);
            return $draft;
        } else return new DraftBuilder($this->databox_id);
    }

    public function get(): self{
        $uri = '/databox/'.$this->databox_id;
        $response = HTTPClient::request('GET', $uri);
        return self::fromArray($response->json());
    }

    public function delete(): bool{
        $uri = '/databox/'.$this->databox_id;
        $response = HTTPClient::request('DELETE', $uri);
        return true;
    }

    public function updatePassword(string $password): bool{
        $uri = '/databox/'.$this->databox_id;
        $response = HTTPClient::request('PUT', $uri, ['password' => $password]);
        return true;
    }

    public function findAddress(string $query, string $type = null): array{
        $uri = '/databox/'.$this->databox_id.'/address/search';
        $response = HTTPClient::request('GET', $uri, ['query' => $query, 'type' => $this->type]);
        $list = [];
        foreach($response->json() as $address)
            array_push($list, new Address($address['name'], $address['type'], $address['id']));
        return $list;
    }

    public function createMessage(string|Address $recipient = null, string $subject = null, bool $personalDelivery = null, bool $publishIdentity = null, string $textMessage = null, string $toHands = null,
                           string $senderRef = null, string $senderIdent = null, string $recipientRef = null, string $recipientIdent = null,
                           string $lawTitleNum = null, string $lawYear = null, string $lawSection = null, string $lawParagraph = null, string $lawPoint = null,
                           array $attachments = []): Draft{
        return new Draft($this->databox_id, $recipient, $subject, $personalDelivery, $publishIdentity, $textMessage, $toHands,
                                    $senderRef, $senderIdent, $recipientRef, $recipientIdent,
                                    $lawTitleNum, $lawYear, $lawSection, $lawParagraph, $lawPoint,
                                    $attachments);
    }

    public function getId(): int{ return $this->databox_id; }
    public function getName(): string{ return $this->name; }
    public function getType(): string{ return $this->type; }
    public function getUsername(): string{ return $this->username; }
    public function getCreatedAt(): \DateTime{ return new \DateTime($this->created_at); }
    public function getUpdatedAt(): ?\DateTime{ return $this->updated_at ? new \DateTime($this->created_at) : null; }

}
