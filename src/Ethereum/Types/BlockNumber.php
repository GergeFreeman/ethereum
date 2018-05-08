<?php

namespace Ethereum\Types;

/**
 * Class BlockNumber
 * @package Ethereum\Types
 */
class BlockNumber
{
    /**
     * @var string
     */
    private $tag;

    /**
     * BlockNumber constructor.
     * @param string $tag
     */
    public function __construct($tag = 'latest')
    {
        if (is_numeric($tag)) {
            $tag = '0x' . dechex($tag);
        } else {
            if (!in_array($tag, ['latest', 'earliest', 'pending'])) {
                throw new \InvalidArgumentException('wrong BlockNumber');
            }
        }
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->tag;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->tag;
    }
}
