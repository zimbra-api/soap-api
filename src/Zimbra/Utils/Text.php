<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Utils;

/**
 * Text class
 * @package   Zimbra
 * @category  Utils
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by iWay Vietnam. (http://www.iwayvietnam.com)
 */
class Text
{
    public static function isRgb($rgb)
    {
        //return (bool) preg_match('/^#?+[0-9a-f]{3}(?:[0-9a-f]{3})?$/i', $rgb);
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
        $headers = array();
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
