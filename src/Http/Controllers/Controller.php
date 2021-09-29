<?php

namespace Devloops\MasterCard\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * Class Controller
 *
 * @package Devloops\MasterCard\Http\Controllers
 * @date 29/09/2021
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class Controller extends BaseController
{

    use DispatchesJobs, ValidatesRequests;
}
