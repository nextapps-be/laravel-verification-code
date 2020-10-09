<?php

namespace NextApps\VerificationCode\CodeTypes;

class Numeric extends CodeType
{
    /**
     * Get the characters of the code type.
     *
     * @return array
     */
    public function getCharacters()
    {
        return '0123456789';
    }
}