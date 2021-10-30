<?php

namespace App\Services;

final class Acl
{
    /*Roles*/
    const ROLE_ADMIN = 'admin';
    const ROLE_MANAGER = 'manager';
    const ROLE_SALES = 'sales';

    /*
    |--------------------------------------------------------------------------
    | Administration
    |--------------------------------------------------------------------------
    |
    | All Permissions related to Administration module
    |
    */

    /*Permissions*/
    const PERMISSION_SYNC_PERMISSIONS = 'sync permissions';
    const PERMISSION_VIEW_ROLE_PERMISSIONS = 'view role permissions';
    const PERMISSION_UPDATE_ROLE_PERMISSIONS = 'update role permissions';
    const PERMISSION_VIEW_USERS = 'view users';
    const PERMISSION_VIEW_STORES = 'view stores';
    const PERMISSION_VIEW_USER_PERMISSIONS = 'view user permissions';
    const PERMISSION_UPDATE_USER_PERMISSIONS = 'update user permissions';
    const PERMISSION_RECOVER_USER_PASSWORD = 'recover user password';
    const PERMISSION_DELETE_USER = 'delete user';
    const PERMISSION_BLOCK_USER = 'block user';
    const PERMISSION_VIEW_COMPANIES = 'view companies';
    const PERMISSION_VIEW_COMPANY_STORES = 'view company stores';
    const PERMISSION_CREATE_COMPANY = 'create company';
    const PERMISSION_CREATE_STORE = 'create store';
    const PERMISSION_CREATE_USER = 'create user';
    const PERMISSION_CREATE_FINANCIAL_ACCOUNT_TYPE = 'create financial account type';
    const PERMISSION_CREATE_UNIT_CATEGORY = 'create unit category';

    /*Menu permissions*/
    const PERMISSION_VIEW_MENU_ROLES = 'view menu roles';
    const PERMISSION_VIEW_MENU_PERMISSION = 'view menu permissions';
    const PERMISSION_VIEW_MENU_USERS = 'view menu users';
    const PERMISSION_VIEW_MENU_STORES = 'view menu stores';
    const PERMISSION_VIEW_MENU_COMPANIES = 'view menu companies';
    const PERMISSION_VIEW_MENU_FINANCIAL_ACCOUNT_TYPES = 'view menu financial account types';
    const PERMISSION_VIEW_MENU_UNIT_CATEGORIES = "view menu unit categories";


    /*
    |--------------------------------------------------------------------------
    | Product Management
    |--------------------------------------------------------------------------
    |
    | All Permissions related to product management module
    |
    */

    /*Menu permissions*/
    const PERMISSION_VIEW_MENU_PRODUCTS = 'view menu products';
    const PERMISSION_VIEW_MENU_REGISTER_PRODUCT = 'view menu register product';
    const PERMISSION_VIEW_MENU_PRODUCT_DASHBOARD = 'view menu products dashboard';
    const PERMISSION_VIEW_MENU_UNITS = 'view menu units';
    const PERMISSION_VIEW_MENU_ALL_PRODUCT = 'view menu all product';

    /*Permissions*/
    const PERMISSION_VIEW_PRODUCT_STORE = 'view product store';
    const PERMISSION_CREATE_PRODUCT = 'create product';
    const PERMISSION_UPDATE_PRODUCT = 'update product';
    const PERMISSION_VIEW_PRODUCT_SETTINGS = 'view product settings';
    const PERMISSION_VIEW_STORE_PRODUCT_CATEGORIES = 'view store product categories';
    const PERMISSION_VIEW_PRODUCT_CATEGORIES = 'view product categories';
    const PERMISSION_VIEW_PRODUCT_DETAILS = 'view product details';
    const PERMISSION_ADD_PRODUCT_UNIT = 'add product unit';
    const PERMISSION_CHANGE_PRODUCT_UNIT_STATUS = 'change product unit status';
    const PERMISSION_VIEW_STORE_PRODUCT_BRANDS = 'view store product brands';
    const PERMISSION_REGISTER_NEW_UNIT = 'register new unit';



    /*
    |--------------------------------------------------------------------------
    | Purchase Management
    |--------------------------------------------------------------------------
    |
    | All Permissions related to purchase management module
    |
    */

    /*Menu permissions*/
    const PERMISSION_VIEW_MENU_PURCHASES = 'view menu purchases';
    const PERMISSION_VIEW_MENU_REGISTER_PURCHASE = 'view menu register purchase';
    const PERMISSION_VIEW_MENU_RECENT_PURCHASES = 'view menu recent purchases';


    /*Permissions*/
    const PERMISSION_REGISTER_PURCHASE = 'register purchase';

}

