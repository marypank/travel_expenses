<?php

namespace App\Models\Enum;

enum SourceExpenseEnum: int
{
    case CARD = 0;
    
    case CASH = 1;
}