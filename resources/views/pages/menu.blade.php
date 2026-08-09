@extends('web_master')
@section('title', 'Restaurant Management System')
@section('main_content')
    <style>
        html {
            scroll-behavior: smooth;
        }

        .foodcard {
            height: 100%;
            margin: 0 !important;
        }

        .scrollhere {
            margin: 40px 0
        }

        #menu_site_cart_item,
        #menu_site_cart_item_mobile {
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: transparent;
            border: 1px solid #9F784A;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        #menu_site_cart_item li,
        #menu_site_cart_item_mobile li {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #9F784A;
        }

        #menu_site_cart_item_mobile li:last-child,
        #menu_site_cart_item li:last-child {
            border-bottom: none;
        }

        #menu_site_cart_item_mobile .img,
        #menu_site_cart_item .img {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            overflow: hidden;
            border-radius: 4px;
            margin-right: 10px;
        }

        #menu_site_cart_item_mobile .img img,
        #menu_site_cart_item .img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #menu_site_cart_item_mobile .content,
        #menu_site_cart_item .content {
            flex: 1;
        }

        #menu_site_cart_item_mobile .content h4,
        #menu_site_cart_item .content h4 {
            margin: 0;
            font-size: 16px;
            color: #fff;
            font-weight: bold;
        }

        #menu_site_cart_item .content p,
        #menu_site_cart_item_mobile .content p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #f1f1f1;
        }

        #menu_site_cart_item_mobile .content .qty,
        #menu_site_cart_item .content .qty {
            font-weight: bold;
            color: #fff;
        }

        #menu_site_cart_item_mobile .action,
        #menu_site_cart_item .action {
            margin-left: 10px;
        }

        #menu_site_cart_item_mobile .action .remove,
        #menu_site_cart_item .action .remove {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        #menu_site_cart_item_mobile .action .remove:hover,
        #menu_site_cart_item .action .remove:hover {
            background-color: #c0392b;
        }
    </style>
    <div id="products" class="container-fluid">
        <div data-spy="scroll" data-target="#scrollingAuto" class="" data-offset="200">
            <div class="">
                <section class="menu-body foodmenu">
                    <div class="row">
                        <!--================Categories=================-->
                        <div class="col-lg-2 col-xl-2 d-none d-lg-block d-xl-block">
                            <div class="sticky-top categ-panel">
                                <nav class="nav flex-column" id="scrollingAuto" data-spy="scroll"
                                    data-target="#scrollingAuto" data-offset="250">
                                    <a v-for="(category, index) in categories" :key="category.id"
                                        class="nav-link catlink" :href="'#' + category.name">@{{ category.name }}</a>
                                </nav>
                            </div>
                        </div>
                        <!--================ mobile Categories=================-->
                        <div class="px-0 fixed-top col-md-12 d-xl-none d-lg-none" style="z-index:2;">
                            <div class="scrollmenu" id="scrollingAuto">
                                <a v-for="(category, index) in categories" class="catlink"
                                    :href="'#' + category.name">@{{ category.name }}</a>
                            </div>
                        </div>
                        <!--================ mobile Categories=================-->
                        <!--================Categories=================-->




                        <!--================Foods=================-->
                        <div class="mt-0 mt-md-4 col-xl-7 col-lg-6 col-md-12">

                            <!-- <div class="menu-download">
                                                <a href="download-menu/Indriya-Menu-2024.pdf" class="btn poibtn-outline" target="_blank">
                                                    Download Indriya Menu
                                                </a>

                                                <a href="download-menu/cocktails.pdf" class="btn poibtn-outline" target="_blank">
                                                    Download Cocktails Menu
                                                </a>

                                                <p>Download our PDF menus for offline use</p>
                                            </div>

                                            <h4 class="my-2 d-xl-none d-lg-none">Sorry! Shop is closed now.</h4> -->


                            <template v-for="(category, index) in categories">
                                <div class="scrollhere" :id="category.name"></div>
                                <h4 class="cat-title-Header mt-5">@{{ category.name }}</h4>
                                <p class="cat-title-desc"> <span class=""></span></p>

                                <div class="row my-4" style="gap: 15px 0;">
                                    <div v-if="category.rel_to_menus && category.rel_to_menus.length > 0"
                                        v-for="menu in category.rel_to_menus" :key="menu.id"
                                        class="col-12 col-xl-6">
                                        <div id="product_457"></div>
                                        <div class="foodcard" data-aos="fade-up" data-aos-delay="100">
                                            <div class="row p-2 " style="align-items: center;">
                                                <div class="col-4">
                                                    <img style="border-radius: 50%;" class="img-fluid p-2"
                                                        :src="menu.image" alt="" style="opacity:30%"
                                                        data-aos="fade-up" data-aos-delay="150">
                                                </div>
                                                <div class="col-8 p-md-2 p-1">

                                                    <div class="d-flex align-items-center justify-content-between mr-3">

                                                        <p class="text-left foodname mr-2">
                                                            @{{ menu.name.length > 25 ? menu.name.slice(0, 25) + '...' : menu.name }}
                                                        </p>

                                                        <button
                                                            @click="addToCart(menu.id, category.name, menu.name, menu.image, menu.sale_rate, 1)"
                                                            class="menubtn">Add</button>
                                                    </div>

                                                    <div class="descText">
                                                        <p>@{{ (menu.recipes ? menu.recipes.map(recipe => recipe.material.name).join(', ') : 'N/A') }}</p>
                                                    </div>

                                                    <p>£@{{ (parseFloat(menu.sale_rate) || 0).toFixed(0) }}</p>

                                                    <div class="d-flex align-items-center justify-content-start">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <!-- <h4 class="mb-2 mt-4 text-center">Offers and Charges</h4>

                                            <div class="col-12 d-flex flex-column flex-md-row justify-content-start">
                                            </div>
                                            <div class="container">
                                                <div class="p-2 mt-3">
                                                    <h4 class="mb-4 text-center">Allergy Information</h4>
                                                    <div class="flex-wrap row d-flex jusitfy-content-start">
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="{{ asset('frontend/storage/uploads/Dd_1723051658.png') }}" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Dairy
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="{{ asset('frontend/storage/uploads/Ee_1723051724.png') }}" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Egg
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="{{ asset('frontend/storage/uploads/Gg_1723051778.png') }}" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Gluten
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="{{ asset('frontend/storage/uploads/Ff_1723051797.png') }}" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Fish
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="{{ asset('frontend/storage/uploads/Nn_1723052088.png') }}" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Nuts
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="{{ asset('frontend/storage/uploads/GFgf_1723052111.png') }}" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Gluten Free
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="storage/uploads/MOmo_1723052141.png" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Molluscs
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="storage/uploads/MUmu_1723052208.png" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Mustard
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="storage/uploads/Cc_1723052300.png" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Crustaceans
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="storage/uploads/Vv_1723052335.png" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Vegetarian
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="pb-1 pr-1 d-flex flex-column align-items-center  col-xl-1 col-lg-2 col-md-2 col-3">
                                                            <img src="storage/uploads/VEve_1723052553.png" alt="" class="p-0 m-0"
                                                                style="max-width: 30px; height:auto;">
                                                            <p class="mb-0 text-center" style="font-size: 12px;">
                                                                Vegan
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> -->
                        </div>
                        <!--================Foods=================-->

                        <!--================cart=================-->
                        <div class="col-lg-4 col-xl-3 col-md-3 cart-panel">
                            <!--================search=================-->
                            <!--================search=================-->
                            <div class="pt-0 sticky-top d-none d-lg-block d-xl-block cart-wrapper" data-aos="fade-up">
                                {{-- <p class="mb-2">Opening hours: &nbsp; <strong>Thursday</strong>
                                <span>12:00 - 23:00</span>
                            </p>
                            <h4>Shop is closed now!</h4> --}}
                                <template v-if="cart.length > 0">
                                    <h4>Cart Items</h4>
                                    <ul id="menu_site_cart_item">
                                        <li v-for="(item, index) in cart" :key="item.menuId">
                                            <div class="img">
                                                <img :src="item.image" :alt="item.name">
                                            </div>
                                            <div class="content">
                                                <h4>@{{ item.name }}</h4>
                                                <p>£@{{ item.price }} x <span
                                                        class="qty">@{{ item.quantity }}</span>
                                                </p>
                                                <p>£@{{ item.total }}</p>
                                            </div>
                                            <div class="action">
                                                <button class="remove" @click="removeCartItem(index)">X</button>
                                            </div>
                                        </li>
                                    </ul>
                                    <a style="display: block; text-align:center; margin:10px 0;"
                                        href="{{ route('checkout') }}" class="menubtn">Checkout</a>
                                </template>
                                <template v-else>
                                    <h4>No Item Found</h4>
                                </template>
                            </div>

                        </div>
                        <!--================cart=================-->
                    </div>
                </section>
            </div>
        </div>

        <div class="d-xl-none d-lg-none">
            <nav class="mobnav">
                <button class="btn mobnav-item slide-toggle cart-mobnav-btn" style="margin: 0px;">
                    <span class="mob-Count">
                        <i class="fas fa-shopping-cart"></i>
                        @{{ cart.length > 0 ? cart.length : '' }}
                    </span>
                </button>
                <div class="mob-total d-flex align-items-center justify-content-between">
                    <h6 class="mb-0 mobnav-item total-nav-section" style="font-weight:bold;"> Total:
                        £@{{ totalPrice }}</h6>
                    <a href="{{ route('checkout') }}" class="mobnav-item">Checkout</a>
                    </a>

                </div>
            </nav>
        </div>

        <div class="d-xl-none d-lg-none">
            <div class="mobcart">

                <div class="p-3 mt-2  sticky-top mobCart-wrapper">

                    <h4 class="text-center">Orders</h4>
                    <hr class="mb-0">
                    <template v-if="cart.length > 0">
                        <h4>Cart Items</h4>
                        <ul id="menu_site_cart_item_mobile">
                            <li v-for="(item, index) in cart" :key="item.menuId">
                                <div class="img">
                                    <img :src="item.image" :alt="item.name">
                                </div>
                                <div class="content">
                                    <h4>@{{ item.name }}</h4>
                                    <p>£@{{ item.price }} x <span class="qty">@{{ item.quantity }}</span>
                                    </p>
                                    <p>£@{{ item.total }}</p>
                                </div>
                                <div class="action">
                                    <button class="remove" @click="removeCartItem(index)">X</button>
                                </div>
                            </li>
                        </ul>
                        <a style="display: block; text-align:center; margin:10px 0;" href="{{ route('checkout') }}"
                            class="menubtn">Checkout</a>
                    </template>
                    <template v-else>
                        <div class="mt-2 alert alert-warning">
                            <h5 class="m-0 text-center">No Item Found</h5>
                            {{-- <h5 class="m-0 text-center">Sorry, Shop is closed now!</h5> --}}
                        </div>
                    </template>



                    {{-- <div class="mt-4 form-group">
                        <form class="form-inline" method="POST"
                            action="https://indriyabarandrestaurant.com/menu/coupon/submit">
                            <input type="hidden" name="_token" value="7PzbPjf8dLQfHPCwLlipaRjkc5TB60ssteJjKayE">
                            <div class="row">
                                <div class="m-0 col-8">
                                    <input type="text" class="form-control" name='coupcode' placeholder="coupon code"
                                        required>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-sm btngrey">Apply</button>
                                </div>
                            </div>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('backend') }}/js/vue/axios.min.js"></script>

    <script>
        new Vue({
            el: '#products',
            data() {
                return {
                    categories: [],
                    menus: [],
                    selectedCategoryIndex: -1,
                    cart: [],
                }
            },
            async created() {
                await this.getCategories();
                this.getMenus();
                this.getCartItem();
            },
            computed: {
                totalPrice() {
                    return this.cart.reduce((total, item) => total + item.price * item.quantity, 0).toFixed(2);
                },
                totalUniteRate() {
                    return this.cart.reduce((total, item) => (item.quantity * item.price), 0).toFixed(2);
                },
            },
            methods: {
                getMenus() {
                    axios.get("/get-menus").then(res => {
                        this.menus = res.data;
                        this.menus.forEach(menu => {
                            Vue.set(menu, 'showOverlay', false);
                        });
                    }).catch(error => {
                        console.error("Error fetching menu:", error);
                    });
                },
                getCategories() {
                    axios.get("/get-categories").then(res => {
                        this.categories = res.data;
                        this.categories.forEach(category => {
                            if (category.rel_to_menus && category.rel_to_menus.length > 0) {
                                category.rel_to_menus.forEach(menu => {
                                    Vue.set(menu, 'showOverlay', false);
                                });
                            }
                        });
                    }).catch(error => {
                        console.error("Error fetching categories:", error);
                    });
                },
                async getCartItem() {
                    let storeCheck = JSON.parse(localStorage.getItem('cart'));
                    if (storeCheck != null) {
                        this.cart = storeCheck.sort((a, b) => b.sl - a.sl);
                    }
                },
                async addToCart(menuId, category, name, image, price, quantity) {
                    let menu = {
                        sl: 0,
                        menuId: menuId,
                        category: category,
                        name: name,
                        image: image,
                        price: price,
                        quantity: quantity,
                        total: parseFloat(quantity * price).toFixed(2)
                    };

                    let findInd = this.cart.findIndex(item => item.menuId == menu.menuId);

                    if (findInd > -1) {
                        menu.quantity += this.cart[findInd].quantity;
                        menu.total = (parseFloat(menu.total) + parseFloat(this.cart[findInd].total)).toFixed(2);
                        this.cart.splice(findInd, 1);
                    }
                    this.cart.push(menu);
                    // Update serial numbers for all items
                    this.cart.forEach((item, index) => {
                        item.sl = index + 1; // Increment serial number
                    });
                    localStorage.setItem('cart', JSON.stringify(this.cart));
                    Toast.fire({
                        icon: 'success',
                        title: menu.name + ' added to cart successfully',
                    });
                    this.getCartItem();
                },
                setActiveCategory(index) {
                    this.selectedCategoryIndex = index;
                    this.toggleOverlay(0);
                },
                removeCartItem(index) {
                    this.cart.splice(index, 1);
                    this.saveCart();
                    getCartItem();
                },
                saveCart() {
                    localStorage.setItem('cart', JSON.stringify(this.cart));
                },
                toggleOverlay(menuId) {

                    this.menus.forEach(menu => {
                        if (menuId != menu.id) {
                            menu.showOverlay = false;
                        }
                    });

                    const menuToToggle = this.menus.find(m => m.id === menuId);

                    this.categories.forEach(category => {
                        if (category.rel_to_menus && category.rel_to_menus.length > 0) {
                            category.rel_to_menus.forEach(menu => {
                                if (menuId === menu.id) {
                                    menu.showOverlay = !menu.showOverlay;
                                } else {
                                    menu.showOverlay = false;
                                }
                            });
                        }
                    });

                    if (!menuToToggle.showOverlay) {
                        menuToToggle.showOverlay = true;
                    } else {
                        menuToToggle.showOverlay = false;
                    }
                }
            }
        });
    </script>
@endpush
