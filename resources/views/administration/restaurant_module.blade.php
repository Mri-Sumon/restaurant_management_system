<style>
    .admin-module-card {
        position: relative;
        min-height: 105px;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        padding: 16px 12px;
        overflow: hidden;
        transition: all 0.2s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .admin-module-card:hover {
        border-color: #4b3f72;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .admin-module-icon {
        width: 42px;
        height: 42px;
        line-height: 42px;
        text-align: center;
        float: left;
        margin-right: 11px;
        border-radius: 4px;
        background: #f2f0f8;
        color: #4b3f72;
        font-size: 20px;
    }

    .admin-module-content {
        padding-top: 2px;
        padding-right: 15px;
        overflow: hidden;
    }

    .admin-module-title {
        font-size: 13px;
        font-weight: 600;
        color: #344054;
        line-height: 18px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-module-subtitle {
        margin-top: 5px;
        font-size: 11px;
        color: #98a2b3;
        line-height: 15px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-module-arrow {
        position: absolute;
        right: 10px;
        bottom: 9px;
        color: #c4c8ce;
        font-size: 13px;
        transition: all 0.2s ease;
    }

    .admin-module-card:hover .admin-module-arrow {
        color: #4b3f72;
        right: 8px;
    }

    .admin-module-card:hover .admin-module-icon {
        background: #4b3f72;
        color: #fff;
    }

    @media (max-width: 767px) {
        .admin-module-card {
            min-height: 95px;
            padding: 13px 10px;
        }

        .admin-module-icon {
            width: 36px;
            height: 36px;
            line-height: 36px;
            font-size: 17px;
            margin-right: 8px;
        }

        .admin-module-title {
            font-size: 12px;
        }

        .admin-module-subtitle {
            font-size: 10px;
        }
    }
</style>

<div class="row">
    <div class="col-md-12 col-xs-12">

        <div class="col-md-10 col-md-offset-1 col-xs-12">

            <!-- Module Header -->
            <div
                style="
                margin-bottom: 20px;
                padding: 0 5px 12px;
                border-bottom: 1px solid #e5e7eb;
            ">
                <div style="display: inline-block;">
                    <h3
                        style="
                        margin: 0;
                        font-size: 22px;
                        font-weight: 600;
                        color: #2c3e50;
                    ">
                        <i class="ace-icon bi bi-shop" style="margin-right: 8px; color: #4b3f72;"></i>
                        Restaurant Module
                    </h3>

                    <div
                        style="
                        margin-top: 5px;
                        font-size: 12px;
                        color: #8a8f98;
                    ">
                        Manage orders, menus, table bookings, inventory, and material purchases
                    </div>
                </div>
            </div>

            <!-- Order Entry -->
            @if (checkAccess('order'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/order" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-building-add"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Order Entry
                                </div>
                                <div class="admin-module-subtitle">
                                    Create new order
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Pay First -->
            @if (checkAccess('payFirst'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/payFirst" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-cash-stack"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Pay First
                                </div>
                                <div class="admin-module-subtitle">
                                    Advance payment
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Pending Order -->
            @if (checkAccess('pendingOrder'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/pendingOrder" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-card-checklist"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Pending Order
                                </div>
                                <div class="admin-module-subtitle">
                                    Pending queue
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Order List -->
            @if (checkAccess('orderList'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/orderList" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-card-checklist"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Order List
                                </div>
                                <div class="admin-module-subtitle">
                                    View all orders
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Table Booking List -->
            @if (checkAccess('tableBooking'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/tableBooking" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-list-ul"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Table Booking
                                </div>
                                <div class="admin-module-subtitle">
                                    Booking records
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Menu Entry -->
            @if (checkAccess('menu'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/menu" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-egg-fried"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Menu Entry
                                </div>
                                <div class="admin-module-subtitle">
                                    Add food items
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Menu List -->
            @if (checkAccess('menuList'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/menuList" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-list-ul"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Menu List
                                </div>
                                <div class="admin-module-subtitle">
                                    View food menu
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Menu Category -->
            @if (checkAccess('menuCategory'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/menu-category" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-boxes"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Menu Category
                                </div>
                                <div class="admin-module-subtitle">
                                    Food categories
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Production List -->
            @if (checkAccess('productionList'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/productionList" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-card-checklist"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Production List
                                </div>
                                <div class="admin-module-subtitle">
                                    Kitchen records
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Material Purchase -->
            @if (checkAccess('materialPurchase'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/materialPurchase" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-shopping-cart"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Material Purchase
                                </div>
                                <div class="admin-module-subtitle">
                                    Buy materials
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Material Purchase List -->
            @if (checkAccess('materialPurchaseList'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/materialPurchaseList" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-list-ul"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Purchase List
                                </div>
                                <div class="admin-module-subtitle">
                                    Purchase logs
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Material Entry -->
            @if (checkAccess('material'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/material" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-building-gear"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Material Entry
                                </div>
                                <div class="admin-module-subtitle">
                                    Add material
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Requisition Entry -->
            @if (checkAccess('requisition'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/requisition" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon fa fa-cart-plus"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Requisition Entry
                                </div>
                                <div class="admin-module-subtitle">
                                    New requisition
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Requisition List -->
            @if (checkAccess('requisitionList'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/requisitionList" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-list-ul"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Requisition List
                                </div>
                                <div class="admin-module-subtitle">
                                    Request logs
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- Unit Entry -->
            @if (checkAccess('unit'))
                <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                    <a href="/unit" style="text-decoration: none; color: inherit;">
                        <div class="admin-module-card">
                            <div class="admin-module-icon">
                                <i class="menu-icon bi bi-unity"></i>
                            </div>
                            <div class="admin-module-content">
                                <div class="admin-module-title">
                                    Unit Entry
                                </div>
                                <div class="admin-module-subtitle">
                                    Measurement units
                                </div>
                            </div>
                            <div class="admin-module-arrow">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

        </div>
    </div>
</div>
