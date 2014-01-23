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
use Zimbra\Soap\Request;

/**
 * ConfigureZimlet request class
 * Configure Zimlet.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConfigureZimlet extends Request
{
    /**
     * Constructor method for ConfigureZimlet
     * @param Attachment $content Content
     * @return self
     */
    public function __construct(Attachment $content)
    {
        parent::__construct();
        $this->child('content', $content);
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
}
