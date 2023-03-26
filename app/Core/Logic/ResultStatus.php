<?php

namespace App\Core\Logic;

enum ResultStatus
{
    case Pending;
    case Resolved;
    case Rejected;
}
