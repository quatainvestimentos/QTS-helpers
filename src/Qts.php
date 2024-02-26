<?php

namespace QuataInvestimentos;

use QuataInvestimentos\QtsApi;
use QuataInvestimentos\QtsHelpers;
use QuataInvestimentos\QtsBankSlipHelpers;
use QuataInvestimentos\QtsIndexer;
use QuataInvestimentos\QtsUsers;
use QuataInvestimentos\QtsEs512;
use QuataInvestimentos\QiTech;
use QuataInvestimentos\AwsApi;
use QuataInvestimentos\Permissions\FileNavigator;

/**
 * V01 Integration
 */

use QuataInvestimentos\V01\QtsV01;
use QuataInvestimentos\V01\InstructionController;
use QuataInvestimentos\V01\RemittanceController;
use QuataInvestimentos\V01\UploadController;
use QuataInvestimentos\V01\DischargeController;

class Qts {
    use QtsApi,
    QtsHelpers,
    QtsBankSlipHelpers,
    QtsUsers,
    QtsEs512,
    QiTech,
    AwsApi,
    QtsV01,
    QtsIndexer,
    InstructionController,
    RemittanceController,
    UploadController,
    DischargeController,
    FileNavigator
}