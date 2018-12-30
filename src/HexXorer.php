<?php

namespace Kronthto\AOEncrypt;

class HexXorer
{
    /** @var string */
    protected $key;

    public function __construct(string $hexkex)
    {
        $this->key = $hexkex;
    }

    public function doXor(string $data): string
    {
        $hexStr = unpack('H*', $data)[1];
        $length = \strlen($hexStr);
        $keyLength = \strlen($this->key);

        $newStr = '';

        for ($i = 0; $i < $length; $i++) {
            $newStr[$i] = dechex(hexdec($hexStr[$i]) ^ hexdec($this->key[$i % $keyLength]));
        }

        return pack('H*', $newStr);
    }
}
