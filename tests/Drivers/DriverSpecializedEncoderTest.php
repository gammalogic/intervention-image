<?php

declare(strict_types=1);

namespace Intervention\Image\Tests\Drivers;

use Intervention\Image\Drivers\DriverSpecializedEncoder;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\Interfaces\DriverInterface;
use Intervention\Image\Tests\TestCase;
use Mockery;

/**
 * @covers \Intervention\Image\Drivers\DriverSpecializedEncoder
 *
 * @internal
 */
class DriverSpecializedEncoderTest extends TestCase
{
    public function testGetBuffered(): void
    {
        $encoder = Mockery::mock(DriverSpecializedEncoder::class)->makePartial();
        $result = $encoder->getBuffered(function () {
            echo 'result';
        });
        $this->assertEquals('result', $result);
    }

    public function testGetAttributes(): void
    {
        $encoder = Mockery::mock(DriverSpecializedEncoder::class, [
            new JpegEncoder(quality: 10),
            Mockery::mock(DriverInterface::class),
        ])->makePartial();

        $this->assertEquals(10, $encoder->quality);
    }
}