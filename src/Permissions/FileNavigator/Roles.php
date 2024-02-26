<?php 

namespace QuataInvestimentos\Permissions\FileNavigator;

use QuataInvestimentos\Permissions\FileNavigator;

trait Roles 
{
    public static function getAdminPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getAcquisitionPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getBackofficePermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getCheckingPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getCommercialPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getCreditPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getDeveloperPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => ['*'],
            'docs' => ['*'],
            'fileserver' => ['*'],
            'frontend' => ['*'],
            'reports' => ['*'],
            'users' => ['*'],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getDigitalPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getFinancialPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getGroPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getHumanResourcesPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getLegalPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getMiddlePermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getMopPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }

    public static function getStructuringPermissions($profile){
        // Role Default Permissions
        $role_permissions = [
            'bank-slips' => [],
            'docs' => [],
            'fileserver' => [],
            'frontend' => [],
            'reports' => [],
            'users' => [],
        ];
        // Profile Permissions
        switch($profile) {
            case md5('LEADER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('ASSISTANT'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('COORDINATOR'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            case md5('MANAGER'): $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
            //OPERATOR
            default: $profile_permissions = [
                'bank-slips' => [],
                'docs' => [],
                'fileserver' => [],
                'frontend' => [],
                'reports' => [],
                'users' => [],
            ]; break;
        }

        return FileNavigator::mergePermission($role_permissions, $profile_permissions);
    }
}