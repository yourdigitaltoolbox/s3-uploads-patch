<?php

namespace YDTBS3Patch\Providers;

use YDTBS3Patch\Interfaces\Provider;

class FunctionServiceProvider implements Provider
{
    public function register()
    {
        add_filter('s3_uploads_s3_client_params', function ($params) {
            $params['use_aws_shared_config_files'] = false;
            return $params;
        });
    }
}
