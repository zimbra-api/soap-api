<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Soap;

use Zimbra\Common\Soap\Header\AccountInfo;

/**
 * Header aware interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Soap
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface HeaderAwareInterface
{
    /**
     * Set auth token to soap request header.
     *
     * @param  string $token
     * @return self
     */
    function setAuthToken(string $token): self;

    /**
     * Set target account to soap request header.
     *
     * @param  AccountInfo $account
     * @return self
     */
    function setTargetAccount(AccountInfo $account): self;
}
