<?php
namespace Blog;

class Link
{
    protected $url;

    protected $link;

    protected $meta_description;

    protected $keywords;

    protected $filesize;

    public function getData(): array
    {
        return [
            'url' => $this->url,
            'link' => $this->link,
            'meta description' => $this->meta_description,
            'keywords' => $this->keywords,
            'filesize' => $this->filesize,
        ];
    }

    public function setData(array $data)
    {
        $this->url = isset($data['url']) ? $data['url'] : null;
        $this->link = isset($data['link']) ? $data['link'] : null;
        $this->meta_description = isset($data['meta description']) ? $data['meta description'] : null;
        $this->keywords = isset($data['keywords']) ? $data['keywords'] : null;
        $this->filesize = isset($data['filesize']) ? $data['filesize'] : null;
    }
}
