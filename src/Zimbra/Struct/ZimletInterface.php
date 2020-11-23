<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use Zimbra\Common\SimpleXML;

/**
 * ZimletInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface ZimletInterface
{
    function setZimletContext(ZimletContextInterface $zimletContext): self;
    function setZimlet(ZimletDesc $zimlet): self;
    function setZimletConfig(ZimletConfigInfo $zimletConfig): self;

    function getZimletContext(): ZimletContextInterface;
    function getZimlet(): ZimletDesc;
    function getZimletConfig(): ZimletConfigInfo;
}
