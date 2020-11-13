<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Zimbra\Common;

/**
 * Text class
 *
 * @package   Zimbra
 * @category  Common
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
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
        return preg_match($pattern, (string) $tag, $matches) && $matches[0] == $tag;
    }

    /**
     * Convert bool value to string.
     *
     * @param  bool $value
     * @return string
     */
    public static function boolToString($value) {
        $value = $value === TRUE ? 'true' : $value;
        $value = $value === FALSE ? 'false' : $value;
        return $value;
    }

    /**
     * Convert string value to bool.
     *
     * @param  string $value
     * @return bool
     */
    public static function stringToBoolean($value) {
        $value = (string) $value;
        if ('true' === strtolower($value) || '1' === $value) {
            $value = TRUE;
        }
        elseif ('false' === strtolower($value) || '0' === $value) {
            $value = FALSE;
        }
        else {
            throw new \RuntimeException(
                sprintf('Could not convert data to boolean. Expected "true", "false", "1" or "0", but got %s.', json_encode($data))
            );
        }
        return $value;
    }
}
