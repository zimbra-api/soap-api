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
use Zimbra\Soap\Request;

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
class DeployZimlet extends Request
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
        $this->property('action', $action);
        if($content instanceof Attachment)
        {
            $this->child('content', $content);
        }
        if(null !== $flush)
        {
            $this->property('flush', (bool) $flush);
        }
        if(null !== $synchronous)
        {
            $this->property('synchronous', (bool) $synchronous);
        }
    }

    /**
     * Gets or sets action
     *
     * @param  Action $action
     * @return Action|self
     */
    public function action(Action $action = null)
    {
        if(null === $action)
        {
            return $this->property('action');
        }
        return $this->property('action', $action);
    }

    /**
     * Gets or sets content
     *
     * @param  Attachment $content
     * @return Attachment|self
     */
    public function content(Attachment $content = null)
    {
        if(null === $content)
        {
            return $this->child('content');
        }
        return $this->child('content', $content);
    }

    /**
     * Gets or sets flush
     *
     * @param  bool $flush
     * @return bool|self
     */
    public function flush($flush = null)
    {
        if(null === $flush)
        {
            return $this->property('flush');
        }
        return $this->property('flush', (bool) $flush);
    }

    /**
     * Gets or sets synchronous
     *
     * @param  bool $synchronous
     * @return bool|self
     */
    public function synchronous($synchronous = null)
    {
        if(null === $synchronous)
        {
            return $this->property('synchronous');
        }
        return $this->property('synchronous', (bool) $synchronous);
    }
}
