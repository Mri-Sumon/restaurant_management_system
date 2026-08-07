        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="col-md-12 header">
                        <h3> Website Module </h3>
                    </div>
                    @if (checkAccess('about'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/about">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-file-person"></i>
                                    </div>
                                    <div class="textModule">
                                        About Page
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('lunch'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/lunch">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-cutlery"></i>
                                    </div>
                                    <div class="textModule">
                                        Lunch Items
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('lunch'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/catering">
                                    <div class="logo">
                                        <i class="menu-icon mdi mdi-food-turkey"></i>
                                    </div>
                                    <div class="textModule">
                                        Catering Details
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('slider'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/slider">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-image"></i>
                                    </div>
                                    <div class="textModule">
                                        Slider Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('blog'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('blog.create') }}">
                                    <div class="logo">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </div>
                                    <div class="textModule">
                                        Blog Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('cocktail'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('cocktails.create') }}">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-glass"></i>
                                    </div>
                                    <div class="textModule">
                                        Cocktails Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('cocktail'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="{{ route('cocktaileDesc') }}">
                                    <div class="logo">
                                        <i class="menu-icon fa fa-glass"></i>
                                    </div>
                                    <div class="textModule">
                                        Cocktails Des..
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('gallery'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/gallery">
                                    <div class="logo">
                                        <i class="menu-icon bi bi-images"></i>
                                    </div>
                                    <div class="textModule">
                                        Gallery Entry
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if (checkAccess('privacy_policy'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/privacy_policy">
                                    <div class="logo">
                                        <i class="menu-icon mdi mdi-file-document-alert-outline"></i>
                                    </div>
                                    <div class="textModule">
                                        Privacy Policy
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (checkAccess('terms_and_conditions'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/terms_and_conditions">
                                    <div class="logo">
                                        <i class="menu-icon mdi mdi-file-document-check"></i>
                                    </div>
                                    <div class="textModule">
                                        Term Condition
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                    @if (checkAccess('website_messages'))
                        <div class="col-md-2 col-xs-6 ">
                            <div class="col-md-12 section20">
                                <a href="/messages">
                                    <div class="logo">
                                        <i class="menu-icon mdi mdi-message-processing-outline"></i>
                                    </div>
                                    <div class="textModule">
                                        @php
                                            $cnt = App\Models\WebsiteMessage::where('is_read', 'd')->count();
                                        @endphp
                                        Messages @if ($cnt > 0)
                                            <span class="badge notify">{{ $cnt }}</span>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
