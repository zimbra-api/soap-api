<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Request;

use Zimbra\Admin\Struct\AttachmentIdAttrib as Attachment;
use Zimbra\Enum\DeployZimletAction as Action;

/**
 * DeployZimlet request class
 * Deploy Zimlet(s).
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class DeployZimlet extends Base
{
    /**
     * Constructor method for DeployZimlet
     * @param string $action Action - valid values : deployAll|deployLocal|status
     * @param Attachment $content The content
     * @param bool $flush Flag whether to flush the cache
     * @param bool $synchronous Synchronous flag
     * @return self
     */
    public function __construct(
        Action $action,
        Attachment $content = null,
        $flush = null,
        $synchronous = null
    )
    {
        parent::__construct();
        $this->setProperty('action', $action);
        if($content instanceof Attachment)
        {
            $this->setChild('content', $content);
        }
        if(null !== $flush)
        {
            $this->setProperty('flush', (bool) $flush);
        }
        if(null !== $synchronous)
        {
            $this->setProperty('synchronous', (bool) $synchronous);
        }
    }

    /**
     * Gets action
     *
     * @return Action
     */
    public function getAction()
    {
        return $this->getProperty('action');
    }

    /**
     * Sets action
     *
     * @param  Action $action
     * @return self
     */
    public function setAction(Action $action)
    {
        return $this->setProperty('action', $action);
    }

    /**
     * Gets the content.
     *
     * @return Attachment
     */
    public function getContent()
    {
        return $this->getChild('content');
    }

    /**
     * Sets the content.
     *
     * @param  Attachment $content
     * @return self
     */
    public function setContent(Attachment $content)
    {
        return $this->setChild('content', $content);
    }

    /**
     * Gets flush
     *
     * @return bool
     */
    public function getFlushCache()
    {
        return $this->getProperty('flush');
    }

    /**
     * Sets flush
     *
     * @param  bool $flush
     * @return self
     */
    public function setFlushCache($flush)
    {
        return $this->setProperty('flush', (bool) $flush);
    }

    /**
     * Gets synchronous
     *
     * @return bool
     */
    public function getSynchronous()
    {
        return $this->getProperty('synchronous');
    }

    /**
     * Sets synchronous
     *
     * @param  bool $synchronous
     * @return self
     */
    public function setSynchronous($synchronous)
    {
        return $this->setProperty('synchronous', (bool) $synchronous);
    }
}
