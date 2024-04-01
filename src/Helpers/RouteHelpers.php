<?php

namespace A17\Twill\Helpers;

class RouteHelpers
{
    public function getAuthRedirectPath(): string
    {
        return config('twill.auth_login_redirect_path')
            ?? rtrim(config('twill.admin_app_url') ?: '', '/') . '/' . ltrim(config('twill.admin_app_path') ?? 'admin', '/');
    }
}
