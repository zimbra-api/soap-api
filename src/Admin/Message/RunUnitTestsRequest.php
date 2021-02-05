<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlList, XmlRoot};
use Zimbra\Soap\Request;

/**
 * RunUnitTestsRequest request class
 * Runs the server-side unit test suite.
 * If <test>'s are specified, then run the requested tests (instead of the standard test suite).
 * Otherwise the standard test suite is run.
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="RunUnitTestsRequest")
 */
class RunUnitTestsRequest extends Request
{
    /**
     * Test names - each entry of form: className[#testName[+testName]*]
     * 
     * @Accessor(getter="getTests", setter="setTests")
     * @SerializedName("test")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "test")
     */
    private $tests;

    /**
     * Constructor method for RunUnitTestsRequest
     *
     * @param  array  $tests
     * @return self
     */
    public function __construct(array $tests = [])
    {
        $this->setTests($tests);
    }

    /**
     * Add a dl test
     *
     * @param  string $test
     * @return self
     */
    public function addTest(string $test): self
    {
        $test = trim($test);
        if (!empty($test) && !in_array($test, $this->tests)) {
            $this->tests[] = $test;
        }
        return $this;
    }

    /**
     * Sets test sequence
     *
     * @param  array $tests Tests
     * @return self
     */
    public function setTests(array $tests): self
    {
        $this->tests = [];
        foreach ($tests as $test) {
            $this->addTest($test);
        }
        return $this;
    }

    /**
     * Gets test sequence
     *
     * @return array
     */
    public function getTests(): array
    {
        return $this->tests;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof RunUnitTestsEnvelope)) {
            $this->envelope = new RunUnitTestsEnvelope(
                new RunUnitTestsBody($this)
            );
        }
    }
}