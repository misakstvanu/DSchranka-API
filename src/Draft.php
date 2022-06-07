<?php

namespace Misakstvanu\DschrankaApiLaravel;

class Draft {
    private int $databox_id;
    private int $draftId;
    private array $data;

    public function __construct($databox_id,
                                $recipient = null, $subject = null, $personalDelivery = null, $publishIdentity = null, $textMessage = null, $toHands = null,
                                $senderRef = null, $senderIdent = null, $recipientRef = null, $recipientIdent = null,
                                $lawTitleNum = null, $lawYear = null, $lawSection = null, $lawParagraph = null, $lawPoint = null,
                                $attachments = null){
        $this->databox_id = $databox_id;
        $this->data = [
            'address' => $recipient,
            'subject' => $subject,
            'personal_delivery' => $personalDelivery,
            'publish_identity' => $publishIdentity,
            'text' => $textMessage,
            'to_hands' => $toHands,
            'sender_ref' => $senderRef,
            'sender_ident' => $senderIdent,
            'recipient_ref' => $recipientRef,
            'recipient_ident' => $recipientIdent,
            'law' => [
                'number' => $lawTitleNum,
                'year' => $lawYear,
                'section' => $lawSection,
                'paragraph' => $lawParagraph,
                'point' => $lawPoint,
            ],
            'attachments' => $attachments
        ];
    }
    public static function fromArray($array): self{
        $recipient = [
            'id' => $array['recipient_id'] ?? null,
            'type' => $array['recipient_type'] ?? null,
            'name' => $array['recipient_name'] ?? null,
        ];
        $draft = new self($array['databox_id'],
                        $recipient, $array['subject'] ?? null , $array['personal_delivery'] ?? null, $array['publish_identity'] ?? null, $array['text_message'] ?? null, $array['to_hands'] ?? null,
                        $array['sender_ref'] ?? null, $array['sender_ident'] ?? null, $array['recipient_ref'] ?? null, $array['recipient_ident'] ?? null,
                        $array['law_title_num'] ?? null, $array['law_year'] ?? null, $array['law_section'] ?? null, $array['law_paragraph'] ?? null, $array['law_point'] ?? null,
                        $array['attachments'] ?? null);
        $draft->setDraftId($array['id']);
        return $draft;
    }

    public function setDraftId($id): void{
        $this->draftId = $id;
    }

    public function get(): self{
        $uri = '/databox/'.$this->databox_id.'/drafts/'.$this->draftId;
        $response = HTTPClient::request('GET', $uri);
        return Draft::fromArray($response->json());
    }

    public function send(){
        return $this->data; //todo this
    }

    public function save(): self{
        $data = $this->data;
        if($data['address'] instanceof Address){
            $data['address'] = $data['address']->toArray();
        } else {
            $id = $data['address'];
            $data['address'] = ['id' => $id, 'name' => '', 'type' => ''];
        }
        $data['draft_id'] = $this->draftId;

        $uri = '/databox/'.$this->databox_id.'/drafts';
        $response = HTTPClient::request('POST', $uri, $data);
        return self::fromArray($response->json());
    }

    public function delete(): bool{
        $uri = '/databox/'.$this->databox_id.'/drafts/'.$this->draftId;
        $response = HTTPClient::request('DELETE', $uri);
        return true;
    }
}
