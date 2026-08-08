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

        <!-- Module Header -->
        <div style="margin-bottom: 20px; padding: 0 5px 12px; border-bottom: 1px solid #e5e7eb;">
            <div style="display: inline-block;">
                <h3 style="margin: 0; font-size: 22px; font-weight: 600; color: #2c3e50;">
                    <i class="ace-icon fa fa-globe" style="margin-right: 8px; color: #4b3f72;"></i>
                    Website Module
                </h3>
                <div style="margin-top: 5px; font-size: 12px; color: #8a8f98;">
                    Manage your website content, pages, and dynamic elements
                </div>
            </div>
        </div>

        <!-- About Page -->
        @if (checkAccess('about'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/about" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-file-person"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">About Page</div>
                            <div class="admin-module-subtitle">Manage about section</div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Lunch Items -->
        @if (checkAccess('lunch'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/lunch" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-cutlery"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">Lunch Items</div>
                            <div class="admin-module-subtitle">Manage lunch menu</div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Catering Details -->
        @if (checkAccess('lunch'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/catering" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon mdi mdi-food-turkey"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">Catering Details</div>
                            <div class="admin-module-subtitle">Manage catering page</div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Slider Entry -->
        @if (checkAccess('slider'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/slider" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-image"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">Slider Entry</div>
                            <div class="admin-module-subtitle">Manage sliders</div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Blog Entry -->
        @if (checkAccess('blog'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="{{ route('blog.create') }}" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="fa fa-pencil-square-o"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">Blog Entry</div>
                            <div class="admin-module-subtitle">Manage blogs/articles</div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Cocktails Entry -->
        @if (checkAccess('cocktail'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="{{ route('cocktails.create') }}" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-glass"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">Cocktails Entry</div>
                            <div class="admin-module-subtitle">Add new cocktails</div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Cocktails Desc -->
        @if (checkAccess('cocktail'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="{{ route('cocktaileDesc') }}" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon fa fa-glass"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">Cocktails Desc</div>
                            <div class="admin-module-subtitle">Cocktail details</div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Gallery Entry -->
        @if (checkAccess('gallery'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/gallery" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon bi bi-images"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">Gallery Entry</div>
                            <div class="admin-module-subtitle">Manage gallery</div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Privacy Policy -->
        @if (checkAccess('privacy_policy'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/privacy_policy" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon mdi mdi-file-document-alert-outline"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">Privacy Policy</div>
                            <div class="admin-module-subtitle">Manage policy content</div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Terms & Conditions -->
        @if (checkAccess('terms_and_conditions'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/terms_and_conditions" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon mdi mdi-file-document-check"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">Terms & Conditions</div>
                            <div class="admin-module-subtitle">Manage terms & conditions</div>
                        </div>
                        <div class="admin-module-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        <!-- Messages -->
        @if (checkAccess('website_messages'))
            <div class="col-md-2 col-sm-4 col-xs-6" style="padding: 7px;">
                <a href="/messages" style="text-decoration: none; color: inherit;">
                    <div class="admin-module-card">
                        <div class="admin-module-icon">
                            <i class="menu-icon mdi mdi-message-processing-outline"></i>
                        </div>
                        <div class="admin-module-content">
                            <div class="admin-module-title">
                                Messages
                                @php
                                    $cnt = App\Models\WebsiteMessage::where('is_read', 'd')->count();
                                @endphp
                                @if ($cnt > 0)
                                    <span class="badge notify"
                                        style="background-color: #d9534f; color: #fff; font-size: 10px; margin-left: 4px;">{{ $cnt }}</span>
                                @endif
                            </div>
                            <div class="admin-module-subtitle">Contact messages</div>
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
