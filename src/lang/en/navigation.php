<?php
/**
 * Created by PhpStorm.
 * User: fakhar
 * Date: 04/12/2017
 * Time: 3:54 PM
 */

return [

    'Administration|ti-server' => [
        'User Management' => [
            'User Types'  => 'usertypes.index',
            'Users'       => 'users.index',
            'Permissions' => 'permissions.index',
            'Roles'       => 'roles.index',
        ],
        'Companies'       => 'companies.index',
        'Offices'         => 'offices.index',
        'Countries'       => 'countries.index',
        'Cities'          => 'cities.index',
        'Departments'     => 'departments.index',
        'Sections'        => 'sections.index',
        'Stores'          => 'stores.index'

    ],
    'General Ledger|ti-layout-width-default' =>
        [
            'Setup' => [
                'Chart of Accounts'  => 'accounts.index',
                'Account Class'      => 'types.index',
                'Account Group'      => 'accountgroups.index',
                'Voucher Types'      => 'vouchertypes.index',
            ],
            'Transactions' => [
                'Opening Balance'    => 'opening_balance',
                'Voucher Entry'      => 'vouchers.index',
            ],
            'Reports' => [
                'Voucher Printing'   => 'voucher.printing',
                'Listing'            => 'voucher.listing',
                'General Ledger'     => 'voucher-ledger-criteria',
                'Trial Balance'      => 'voucher.trialBalanceCriteria',
            ],
        ],
    'Inventory | ti-layout-width-default' =>[
        'Setup' => [
            'Main Category'          => 'categories.index',
            'Sub Category'           => 'subcategories.index',
            'Brand'                  => 'brands.index',
            'Product'                => 'products.index',
            'Product Sizes'          =>  'product_sizes.index',
            'Packing'                => 'packing.index',
            'Item For'               => 'itemsforid.index',
            'Item Type'              => 'itemtype.index',
            'H.S.Code'               =>  'hscode.index',
            'Category Callout'       =>  'categorycallout.index',
            'Colors'                 =>  'colors.index',
            'Units'                  =>   'units.index',
            'Currency'               =>   'currency.index',
            'Suppliers'              =>   'supplier.index',
            'Purchase Order Type'    =>   'purchase-order-type.index',
        ],
        'Reports' => [
                'Listings' => [
                    'Product Listings' => 'products_listing'
                ]
        ],
        'Purchase Order' => [
                'Purchase Order Direct' => 'purchaseOrder.index'
        ],
        'Material Demand Note' => 'demandnotices.index',
        'Issue Note'           => 'issuenotes.index',
    ],
    'Local Purchase|ti-credit-card' => [],
    'Local Sale|ti-shopping-cart' => [],
];