<?php
$menu = [
    'mainHeader' => [
        'label' => __('MAIN'),
        'type' => $this->MenuLte::ITEM_TYPE_HEADER, // or 'header'
    ],
    // 'startPages' => [
    //     'label' => __('Start Pages'),
    //     'icon' => 'fas fa-tachometer-alt',
    //     'dropdown' => [
    //         'activePage' => [
    //             'label' => __('Home'),
    //             'uri' => ['controller' => 'Pages', 'action' => 'display', 'home', 'plugin' => false, 'prefix' => false],
    //         ],
    //         // 'inactivePage' => [
    //         //     'label' => __('Inactive Page'),
    //         //     'uri' => '#',
    //         // ],
    //     ],
    // ],
    'customPages' => [
        'label' => __('Custom Pages'),
        'icon' => 'fas fa-book',
        'uri' => ['controller' => 'CustomPages', 'action' => 'index'],
    ],  
    'Prodotti' => [
        'label' => __('Prodotti'),
        'icon' => 'fab fa-product-hunt',
        'uri' => ['controller' => 'Products', 'action' => 'index'],
    ],  
    'Coupon' => [
        'label' => __('Coupon'),
        'icon' => 'fas fa-gift',
        'uri' => ['controller' => 'Coupons', 'action' => 'index'],
    ],  
];

$superuser_menu = [
    'user-menu' => [
        'label' => __('Utenti'),
        'uri' => ['controller' => 'Users', 'action' => 'index'],
        'icon' => 'fas fa-users',
    ],
    'simpleLink' => [
        'label' => 'Logout',
        'uri' => ['controller' => 'Users', 'action' => 'logout'],
        'icon' => 'fas fa-users text-danger',
        'show' => function () {
            // logic condition to show item, return a bool
            return true;
        }
    ],
];

$manager_menu = [
    'simpleLink' => [
        'label' => 'Logout',
        'uri' => ['controller' => 'Users', 'action' => 'logout'],
        'icon' => 'fas fa-users text-danger',
        'show' => function () {
            // logic condition to show item, return a bool
            return true;
        }
    ],
];

if($user->role_id == 1){
    $menu = array_merge($menu, $superuser_menu);
}else{
    $menu = array_merge($menu, $manager_menu);

}
echo $this->MenuLte->render($menu);

/*
- To activate an item, you can pass the `active` variable, or use method `activeItem` from the template
    Example: 
        $this->MenuLte->activeItem('startPages.activePage');

- It is also possible to create the menu using the html code
    <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Active Page</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inactive Page</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
            </p>
        </a>
    </li>
*/
