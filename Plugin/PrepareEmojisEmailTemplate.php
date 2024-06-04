<?php
/**
 * Copyright (c) 2023. Taurus. All rights reserved
 */

namespace TaurusMedia\Emojis\Plugin;

use TaurusMedia\Emojis\Helper\EmojiConverter;
use Magento\Email\Model\BackendTemplate;

class PrepareEmojisEmailTemplate
{
    /**
     * Fields in Email Template
     * in which we replace Emoji
     * to the Hexadecimal string.
     *
     * @var array|string[]
     */
    private array $fields = [
        'template_subject',
        'template_text'
    ];

    /**
     * @var EmojiConverter
     */
    private EmojiConverter $emojiConverter;

    /**
     * @param EmojiConverter $emojiConverter
     */
    public function __construct(EmojiConverter $emojiConverter)
    {
        $this->emojiConverter = $emojiConverter;
    }

    /**
     * @param BackendTemplate $subject
     * @param array|string $key
     * @param mixed $value
     * @return array
     */
    public function beforeSetData(BackendTemplate $subject, $key, $value = null): array
    {
        if (is_string($key) &&
            in_array($key, $this->fields)
        ) {
            return [$key, $this->emojiConverter->convertToHexadecimal($value)];
        }

        return [$key, $value];
    }
}
