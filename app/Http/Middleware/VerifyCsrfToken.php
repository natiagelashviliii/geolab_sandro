<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'http://geolabsandro.test/admin/works/deletephoto',
        'http://geolabsandro.test/home/changemode',
        'http://geolabsandro.test/works/getProject',
        'http://geolabsandro.test/works/getProjectContent',
        'http://geolabsandro.test/works/loadProjects',
        'http://geolabsandro.test/works/getSiblingProjects'
    ];
}
