<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common;

/**
 * Text class
 *
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Text
{

    /**
     * Returns true if the $haystack string begins with $needle, false otherwise.
     *
     * @param  string $haystack.
     * @param  string $needle.
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        return $needle === '' || strpos($haystack, $needle) === 0;
    }

    /**
     * Returns true if the $haystack string ends with $needle, false otherwise.
     *
     * @param  string $haystack.
     * @param  string $needle.
     * @return bool
     */
    public function endsWith($haystack, $needle)
    {
        return $needle === '' || substr($haystack, -strlen($needle)) === $needle;
    }

    /**
     * Check the string is rgb.
     *
     * @param  string $tag The rgb string.
     * @return bool
     */
    public static function isRgb($rgb)
    {
        return (bool) preg_match('/^#([a-f0-9]{3}){1,2}$/iD', $rgb);
    }

    /**
     * Check the tag is valid.
     *
     * @param  string $tag The tag name.
     * @return bool
     */
    public static function isValidTagName($tag)
    {
        $pattern = '/^[a-z_]+[a-z0-9\:\-\.\_]*[^:]*$/i';
        return preg_match($pattern, $tag, $matches) and $matches[0] == $tag;
    }

    /**
     * Extract header string to array.
     *
     * @param  string $headerString Header string.
     * @return array
     */
    public static function extractHeaders($headerString = '')
    {
        $parts = explode("\r\n", $headerString);
        $headers = [];
        foreach ($parts as $part)
        {
            $pos = strpos($part, ':');
            if($pos)
            {
                $name = trim(substr($part, 0, $pos));
                $value = trim(substr($part, ($pos + 1)));
                $headers[$name] = $value;
            }
        }
        return $headers;        
    }

    /**
     * Convert bool value to string.
     *
     * @param  string $tag The tag name.
     * @return string
     */
    public static function boolToString($value)
    {
        $value = $value === true ? 'true' : $value;
        $value = $value === false ? 'false' : $value;
        return $value;
    }
}
