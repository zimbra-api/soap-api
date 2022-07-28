<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

/**
 * BatchResponseInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface BatchResponseInterface extends SoapResponseInterface
{
    /**
     * Add a soap response
     *
     * @param  SoapResponseInterface $response
     * @return self
     */
    function addResponse(SoapResponseInterface $response): self;

    /**
     * Get soap responses
     *
     * @return array
     */
    function getResponses(): array;
}
