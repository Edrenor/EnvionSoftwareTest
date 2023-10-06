<?php

namespace App\Traits;

trait ConverterTrait
{
    public function arrayToXml($data, &$xml)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $subNode = $xml->addChild($key);
                $this->arrayToXml($value, $subNode);
            } else {
                $xml->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
}
