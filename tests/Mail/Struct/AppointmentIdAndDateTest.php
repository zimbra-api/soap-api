<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AppointmentIdAndDate;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AppointmentIdAndDate.
 */
class AppointmentIdAndDateTest extends ZimbraTestCase
{
    public function testAppointmentIdAndDate()
    {
        $id = $this->faker->uuid;
        $date = $this->faker->randomNumber;

        $data = new AppointmentIdAndDate(
            $id, $date
        );
        $this->assertSame($id, $data->getId());
        $this->assertSame($date, $data->getDate());

        $data = new AppointmentIdAndDate();
        $data->setId($id)
            ->setDate($date);
        $this->assertSame($id, $data->getId());
        $this->assertSame($date, $data->getDate());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" d="$date" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($data, 'xml'));
        $this->assertEquals($data, $this->serializer->deserialize($xml, AppointmentIdAndDate::class, 'xml'));
    }
}
