<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Serializer;

/**
 * SerializerSettings class.
 * 
 * @package    Zimbra
 * @subpackage Common
 * @category   Serializer
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
final class SerializerSettings
{
    /**
     * List of visitor factories.
     *
     * @var array
     */
    private $visitorFactories = [];

    /**
     * Activate debug mode
     *
     * @var bool
     */
    private $debug = FALSE;

    /**
     * @var string
     */
    private $cacheDir;
}