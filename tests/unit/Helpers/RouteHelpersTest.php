<?php

namespace A17\Twill\Tests\Unit\Helpers;

use A17\Twill\Facades\RouteHelpers;
use A17\Twill\Tests\Unit\TestCase;

class RouteHelpersTest extends TestCase
{
    public function testGetAuthRedirectPath()
    {
        config(['twill.auth_login_redirect_path' => null, 'twill.admin_app_url' => null, 'twill.admin_app_path' => null]);

        $this->assertEquals(RouteHelpers::getAuthRedirectPath(), '/admin');

        config(['twill.admin_app_path' => 'twill']);

        $this->assertEquals(RouteHelpers::getAuthRedirectPath(), '/twill');

        config(['twill.admin_app_url' => 'https://admin.example.com/']);

        $this->assertEquals(RouteHelpers::getAuthRedirectPath(), 'https://admin.example.com/twill');

        config(['twill.auth_login_redirect_path' => '/redirect']);

        $this->assertEquals(RouteHelpers::getAuthRedirectPath(), '/redirect');
    }
}
