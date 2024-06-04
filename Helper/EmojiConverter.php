<?php
/**
 * Copyright (c) 2023. Taurus. All rights reserved
 */

namespace TaurusMedia\Emojis\Helper;

class EmojiConverter
{
    /**
     * Converts the string with Emoji
     * to the string with the hexadecimal presentation of Emoji.
     *
     * @param string $original
     * @return string
     */
    public function convertToHexadecimal(string $original)
    {
         return preg_replace_callback(
            "%(?:\xF0[\x90-\xBF][\x80-\xBF]{2} | [\xF1-\xF3][\x80-\xBF]{3} | \xF4[\x80-\x8F][\x80-\xBF]{2})%xs",
            function($emoji){
                $emojiStr = mb_convert_encoding($emoji[0], 'UTF-32', 'UTF-8');
                return strtoupper(preg_replace("/^[0]+/","&#x",bin2hex($emojiStr))).';';
            },
            $original
        );
    }
}
