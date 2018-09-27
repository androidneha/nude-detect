<?php

namespace Tests;

use \PHPUnit\Framework\TestCase;
use \NudeDetect\NudeDetect;

class Test extends TestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function test_nudityModel() {
        $client = new NudeDetect();
        $binaryFile = fopen(__DIR__ . '/assets/image.jpg', 'r');
        $output = $client
            ->check(['nudity'])
            ->set_url('https://i.pinimg.com/originals/a4/eb/d9/a4ebd97b1551183223851bad13fb466b.jpg');
        var_dump($output);
        $this->assertEquals('success', $output->status);
        $output2 = $client->check(['nudity'])->set_file(__DIR__ . '/assets/image.jpg');
        $this->assertEquals('success', $output2->status);
        $output3 = $client
            ->check(['nudity','wad','properties','type','faces', 'celebrities'])
            ->set_bytes($binaryFile);
        $this->assertEquals('success', $output3->status);
    }
}