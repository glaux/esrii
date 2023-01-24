<?php

namespace Triangle\Core;

class HTML
{
    protected $tag = 'p';
    protected $props = [];

    public static function create()
    {
        return new static();
    }

    public function tag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    public function props($props)
    {
        $this->props = $props;
        return $this;
    }

    public function wrap($string)
    {
        $r['open'] = '<' . $this->tag . ' ' . $this->joinProps() . '>';
        $r['string'] = $string;
        $r['close'] = '</' . $this->tag . '>';
        return join('', $r);
    }

    public function single()
    {
        return '<' . $this->tag . ' ' . $this->joinProps() . '/>';
    }

    public function joinProps()
    {
        // @see https://stackoverflow.com/questions/11427398/ -
        // This above doesn't work with spaces in the file name:
        // $props = urldecode(http_build_query($this->props, '', ', '));
        // We loop manually instead

        $props = $this->props;
        foreach ($this->props as $key => $value) {
            $props[$key] = $key . '=' . '"' . $value . '"';
        }
        return join(' ', $props);
    }
}
