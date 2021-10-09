<?php

namespace Devloops\MasterCard\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class Controller.
 *
 * @date 29/09/2021
 *
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Controller extends BaseController
{
    use DispatchesJobs;
    use ValidatesRequests;
}
