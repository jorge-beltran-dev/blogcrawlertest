<?php
namespace JsonWriter;

use Blog\Link;

class JsonWriter
{
    protected $links;
    
    public function __construct(array $links)
    {
        $this->links = $links;
    }

    public function getJson(): string
    {
        $json = [
            'results' => [],
            'total' => 0,
        ];
        foreach ($this->links as $link) {
            $this->addLinkToJson($json, $link);
        }

        $json['total'] = (string) round($json['total'], 1);
        $json['total'] .= 'kb';
        return json_encode($json);
    }

    protected function addLinkToJson(array &$json, Link &$link)
    {
        $linkData = $link->getData();
        $json['results'][] = $linkData;
        $json['total'] += (float) str_replace('kb', '', $linkData['filesize']);
    }
}
