<?php 

namespace App\Tests;

use App\Services\Register;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase as TestKernelTestCase;
use Symfony\Bundle\FrameworkBundle\Tests\KernelTestCase;

class RegisterTest extends TestKernelTestCase
{
    public function testEmailRegister(): void
    {
        $register = new Register();

    }
}