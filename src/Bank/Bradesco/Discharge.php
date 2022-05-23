<?php

namespace QuataInvestimentos\Bank\Bradesco;

use QuataInvestimentos\Bank\Common;
use QuataInvestimentos\Bank\Bradesco\Discharge\Init;
use QuataInvestimentos\Bank\Bradesco\Discharge\Header;
use QuataInvestimentos\Bank\Bradesco\Discharge\Transaction2;
use QuataInvestimentos\Bank\Bradesco\Discharge\Transaction3;
use QuataInvestimentos\Bank\Bradesco\Discharge\Footer;

class Discharge {
    use 
    Common,
    Init,
    Header,
    Transaction1,
    Transaction3,
    Footer;
}