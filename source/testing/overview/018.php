<?php

use CodeIgniter\Test\CIUnitTestCase;

final class SomeTest extends CIUnitTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $model = new MockUserModel();
        Factories::injectMock('models', 'App\Models\UserModel', $model);
    }
}
