@extends('web_master')
@section('title', 'Restaurant Management System')
@section('main_content')
    <style>
        .navbar.scrolled,
        .navbar {
            position: fixed !important;
            right: 0;
            left: 0;
            top: 0;
            /* margin-top: -130px; */
            background: #404044 !important;
            -webkit-box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
        }

        .cart-container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .cart-table th,
        .cart-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .cart-table th {
            background-color: transparent;
            font-weight: bold;
            color: #fff;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: start;
        }

        .quantity-controls button {
            padding: 5px 10px;
            font-size: 12px;
            background-color: transparent;
            border: 1px solid #9F784A;
            cursor: pointer;
            color: #fff;
        }

        .quantity-controls input[type="number"] {
            width: 50px;
            text-align: center;
            border: 1px solid #9F784A;
            margin: 0 5px;
            padding: 5px;
            color: #fff;
            background: transparent
        }

        .remove {
            background-color: #e74c3c;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            line-height: 30px;
            text-align: center;
            border: none;
            cursor: pointer;
        }

        .total-checkout-container {
            display: flex;
            justify-content: space-between;
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .checkout a {
            background-color: #9F784A;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .checkout a:hover {
            background-color: #9F784A;
        }

        .cart-img img {
            border-radius: 50%;
            width: 50px;
        }

        #emptyCart {
            text-align: center;
            margin: 20px 0;
        }

        #emptyCart .empty-cart img {
            width: 150px;
        }

        #emptyCart .empty-cart a {
            background-color: #ffb300c2;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #emptyCart .empty-cart a:hover {
            background-color: #ffb400;
        }

        input[type="number"]:focus {
            outline: none;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* For Firefox */
        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Basic Styling */
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
        }

        .cart-table th,
        .cart-table td {
            padding: 12px 15px;
            border: 1px solid #9F784A;
        }

        .cart-table th {
            background-color: transparent;
            font-weight: bold;
        }

        /* Responsive Table */
        .cart-table-container {
            width: 100%;
            overflow-x: auto;
        }

        .cart-table {
            min-width: 600px;
        }

        @media (max-width: 768px) {
            .cart-table {
                border: 0;
            }

            .cart-table thead {
                display: none;
            }

            .cart-table tr {
                display: block;
                margin-bottom: 10px;
            }

            .cart-table td {
                display: block;
                text-align: left;
                font-size: 14px;
                border-bottom: 1px solid #9F784A;
            }

            .cart-table td::before {
                content: attr(data-label);
                float: left;
                text-transform: uppercase;
                font-weight: bold;
            }
        }


        @media (max-width: 600px) {
            .cart-table {
                overflow-x: scroll;
            }

            .cart-table th,
            .cart-table td {
                padding: 10px;
            }

            .quantity-controls button,
            .quantity-controls input[type="number"] {
                padding: 5px;
                font-size: 14px;
            }

            .total-checkout-container {
                flex-direction: column;
                align-items: stretch;
            }

            .checkout a {
                width: 100%;
                text-align: center;
                padding: 12px 0;
                margin-top: 10px;
            }
        }
    </style>
    <div class="container-fluid top-menu-section"
        style="background-image: linear-gradient(to bottom,rgba(255, 255, 255, 0.2), rgba(41, 46, 49, 1)), url('{{ asset('frontend/img/common-bg.jpg') }}')">
    </div>
    <div id="checkout" class="page-blend">
        <div class="container mt-5">
            <div class="p-3 mt-2 mb-4 cartCard">
                <div class="d-flex align-items-center justify-content-between">
                    <h4>Your Items</h4>
                    <a class="poi-link" href="{{ route('menu') }}">Add more</a>
                </div>
                <hr class="mb-0">
                <div>
                    <div v-if="cart.length > 0" id="cart">
                        <div class="container">
                            <div class="cart-table-container">
                                <table class="cart-table">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Name</th>
                                            <th>Menu</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in cart" :key="index">
                                            <td>@{{ index + 1 }}</td>
                                            <td>
                                                <span class="cart-img me-2"><img :src="item.image"
                                                        alt=""></span>
                                                @{{ item.name }}
                                            </td>
                                            <td>@{{ item.category }}</td>
                                            <td>
                                                <div class="quantity-controls">
                                                    <button @click="decrementQuantity(index)">-</button>
                                                    <input type="number" v-model="item.quantity" min="1"
                                                        @change="updateCartItem(index)">
                                                    <button @click="incrementQuantity(index)">+</button>
                                                </div>
                                            </td>
                                            <td>£@{{ item.total }}</td>
                                            <td><button class="remove" @click="removeCartItem(index)">X</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="total-checkout-container">
                                    <div class="total">
                                        <span>Total:</span>
                                        <span>£@{{ totalPrice }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div v-else id="emptyCart" class="content-bottom">
                        <div class="mt-2">
                            <h5 class="m-0 text-center">Sorry, No Item Found!</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 mb-5 cartCard">
                <div class="section-intro">
                    <h3>Checkout</h3>
                </div>
                <hr class="mt-0">

                <form @submit.prevent="confirmOrder">
                    <h5>Personal Information</h5>
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <input type="text" class="form-control" v-model="order.customer_first_name"
                                placeholder="First Name">
                        </div>
                        <div class="mb-2 col-md-6">
                            <input type="text" class="form-control" v-model="order.customer_last_name"
                                placeholder="Last Name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <input type="email" class="form-control" placeholder="Email" v-model="order.customer_email">
                        </div>
                        <div class="mb-2 col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">+44</span>
                                <input type="tel" class="form-control" placeholder="Phone Number (11 digits)"
                                    pattern="[0-9]{11}" v-model="order.customer_phone" required>
                            </div>
                        </div>
                    </div>
                    <p v-if="!authcheck">
                        <a href="{{ route('customerLogin') }}" class="poi-link">Login</a> /
                        <a href="{{ route('register') }}" class="poi-link">Register</a> for a more convenient checkout.
                    </p>
                    <hr>
                    <h5>Billing Information</h5>
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <input type="text" class="form-control" v-model="order.customer_address"
                                placeholder="Address Line 1">
                        </div>
                        <div class="mb-2 col-md-6">
                            <input type="text" class="form-control" v-model="order.customer_address_II"
                                placeholder="Address Line 2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <input type="text" class="form-control" v-model="order.customer_city" placeholder="City">
                        </div>
                        <div class="mb-2 col-md-6">
                            <input type="text" class="form-control" v-model="order.customer_state"
                                placeholder="State/Province/Region">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-2 col-md-6">
                            <input type="text" class="form-control" v-model="order.customer_zip"
                                placeholder="ZIP/Postal Code">
                        </div>
                    </div>
                    <div class="mt-2">
                        <textarea class="form-control" v-model="order.comment" placeholder="Additional Comments" rows="4"></textarea>
                    </div>
                    <hr>
                    <div class="mt-2 col-md-12">
                        <div class="form-check">
                            <input type="checkbox" v-model="termAccept" class="form-check-input" id="materialUnchecked">
                            <label class="form-check-label" for="materialUnchecked">
                                I accept the <a href="#">Terms & Conditions</a> and wish to proceed with my order.
                            </label>
                        </div>
                    </div>
                    <div class="mt-2 col-md-12">
                        <p>Payment Option:</p>
                        <div class="d-flex align-items-center flex-wrap">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="cash" value="cod"
                                    v-model="order.order_type">
                                <label class="form-check-label" for="cash">Cash On Delivery</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="ta" value="ta"
                                    v-model="order.order_type">
                                <label class="form-check-label" for="ta">Take Away</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="dine_in" value="dine_in"
                                    v-model="order.order_type">
                                <label class="form-check-label" for="dine_in">Dine-In</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mt-3" v-if="order.order_type === 'ta'">
                                    <label for="time">Time:</label>
                                    <input type="time" id="time" class="form-control" v-model="order.time">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 order-btn-wrapper">
                        <button v-if="cart.length > 0" type="submit" class="btn btn-lg poibtn">Place Order</button>
                        <p v-else>Please add items to the cart and select your order type.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{ asset('backend') }}/js/vue/axios.min.js"></script>

    <script>
        new Vue({
            el: '#checkout',
            data() {
                return {
                    cart: [],
                    order: {
                        customer_first_name: '',
                        customer_last_name: '',
                        customer_email: '',
                        customer_phone: '',
                        customer_address: '',
                        customer_address_II: '',
                        customer_city: '',
                        customer_state: '',
                        customer_zip: '',
                        order_type: 'cod',
                        comment: '',
                        time: '',
                        subtotal: 0,
                        total: 0,
                    },
                    termAccept: false,
                    onProgress: false,
                    confirmation: false,
                    authcheck: "{{ Auth::guard('customer')->check() }}",
                };
            },
            computed: {
                totalPrice() {
                    return this.cart.reduce((total, item) => total + item.price * item.quantity, 0).toFixed(2);
                },
                totalUniteRate() {
                    return this.cart.reduce((total, item) => (item.quantity * item.price), 0).toFixed(2);
                },
            },
            async created() {


                await this.getCartItem();
                await this.getCustomers();
                console.log(this.order.subtotal);
            },
            methods: {
                getCustomers() {
                    axios.get("/get-current-customer").then(res => {
                        if (res.data != '') {
                            this.order = {
                                customer_first_name: res.data.first_name,
                                customer_last_name: res.data.last_name,
                                customer_email: res.data.email,
                                customer_phone: res.data.phone,
                                customer_address: res.data.address,
                                customer_address_II: res.data.address_line_II,
                                customer_city: res.data.city,
                                customer_state: res.data.state,
                                customer_zip: res.data.zip,
                            }
                        }
                    }).catch(error => {
                        console.error("Error fetching categories:", error);
                    });
                },
                getCartItem() {
                    const storedCart = JSON.parse(localStorage.getItem('cart')) || [];
                    this.cart = storedCart;
                    this.order.subtotal = storedCart.reduce((sum, item) => sum + parseFloat(item.total), 0)
                        .toFixed(2);
                    this.order.total = storedCart.reduce((sum, item) => sum + parseFloat(item.total), 0)
                        .toFixed(2);
                },
                updateCartItem(index) {
                    this.saveCart();
                },
                incrementQuantity(index) {
                    this.cart[index].quantity++;
                    this.updateCartItem(index);
                    this.editCart(index);
                },
                decrementQuantity(index) {
                    if (this.cart[index].quantity > 1) {
                        this.cart[index].quantity--;
                        this.updateCartItem(index);
                        this.editCart(index);
                    }
                },
                async editCart(sl) {
                    if (this.cart[sl].quantity == 0) {
                        this.cart[sl].quantity = 1;
                    }
                    this.cart.map(item => {
                        item.total = parseFloat(item.price * item.quantity).toFixed(2)
                        return item;
                    })
                    localStorage.removeItem('cart');
                    localStorage.setItem('cart', JSON.stringify(this.cart));
                },
                removeCartItem(index) {
                    this.cart.splice(index, 1);
                    this.saveCart();
                    getCartItem();
                },
                saveCart() {
                    localStorage.setItem('cart', JSON.stringify(this.cart));
                },
                confirmOrder() {
                    // if (!this.order.customer_first_name || !this.order.customer_last_name) {
                    //     alert('First and Last Name are required.');
                    //     return;
                    // }
                    if (!this.order.customer_phone) {
                        alert('Phone are required.');
                        return;
                    }
                    if (this.order.order_type == 'ta') {
                        if (this.order.time == '') {
                            Toast.fire({
                                icon: 'error',
                                title: 'Take Away Time required!',
                            });
                            return;
                        }
                    }
                    // if (!this.authcheck) {
                    //     axios.post('/checkoutCustomerCheck', {
                    //         order: this.order
                    //     })
                    //     .then(res => {
                    //         console.log(res.message);
                    //     });
                    // }
                    if (!this.termAccept) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Accept Term & Condition',
                        });
                        return;
                    }
                    this.order.subtotal = this.cart.reduce((sum, item) => sum + parseFloat(item.total), 0).toFixed(
                        2);
                    this.order.total = this.order.subtotal;
                    axios.post('/confirm-order', {
                            order: this.order,
                            carts: this.cart,
                            _token: document.querySelector('meta[name="csrf-token"]').content
                        })
                        .then(res => {
                            // console.log(res);
                            // return;
                            if (res.data.status == true) {
                                Toast.fire({
                                    icon: 'success',
                                    title: res.data.message,
                                });
                                localStorage.removeItem('cart');
                                this.cart = [];
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: res.data.message,
                                });
                                return;
                            }
                            this.confirmation = true;
                            setTimeout(() => {
                                location.href = '/';
                            }, 1500);
                        });
                },
            },
        });
    </script>
@endpush
