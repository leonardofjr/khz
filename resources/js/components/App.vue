<template>

            <div class="row">
                    <aside class="col-12 col-lg-3">
                        <nav class=" navbar-dark ">
                            <div class="nav-header">
                                <div class="brand">
                                    Navigation
                                </div>

                                <div class="hamburger-button  d-xs-block d-lg-none">
                                       <button class="navbar-toggler toggle"  data-target="#nav-items" data-collapsed="off" type="button">
                                            <span class="navbar-toggler-icon"></span>
                                        </button>
                                </div>
                            </div>
                            <ul id="nav-items" class="nav-items">
                                    <!-- use router-link component for navigation. -->
                                    <!-- specify the link by passing the `to` prop. -->
                                    <!-- `<router-link>` will be rendered as an `<a>` tag by default -->
                                <li><router-link to="/" exact>Dashboard</router-link></li>
                                <li v-if="role == 'admin'"><router-link to="/users" exact>Users</router-link></li>
                                <li><router-link to="/account" exact>Account</router-link>
                                <ul class="nav-items">
                                    <li><router-link exact to="/account/profile">Profile</router-link></li>
                                    <li><router-link exact to="/account/orders">Orders</router-link></li>
                                    <li><router-link exact to="/account/shipping-address">Shipping Address</router-link></li>
                                    <li><router-link exact to="/account/billing-address">Billing Address</router-link></li>
                                </ul>
                                </li>
                                <li><router-link to="/store" exact>Store</router-link>
                                <ul class="nav-items">
                                    <li v-if="role == 'producer' || 'admin'"><router-link to="/store/products" exact>Products</router-link></li>
                                </ul>
                                </li>
                            </ul>
                        </nav>
                    </aside>
                <main class="col-12 col-lg-9">
                    <router-view></router-view>
                </main>
            </div>
</template>

<script>

    export default {
            data() { return {
                firstName: '',
                lastName: '',
                email: '',
                studioName: '',
                address1: '',
                address2: '',
                city: '',
                province: '',
                postal_code: '',
                country: '',
                shipment_address1: '',
                shipment_address2: '',
                shipment_city: '',
                shipment_province: '',
                shipment_postal_code: '',
                shipment_country: '',
                billing_address1: '',
                billing_address2: '',
                billing_city: '',
                billing_province: '',
                billing_postal_code: '',
                billing_country: '',
                role: '',

            }
        },
        mounted() {
            this.getUserData();
        },

          methods: {
            getUserData() {
                let url = 'http://localhost:8000/user';
                let authUser = {};
                axios
                .get(url)
                .then(response => {
                    console.log(response);
                    this.firstName = response.data.fname;
                    this.lastName = response.data.lname;
                    this.email = response.data.email;
                    this.role = response.data.roles[0].name;
                    this.address1 = response.data.address.address_1;
                    this.address2 = response.data.address.address_2;
                    this.city = response.data.address.city;
                    this.province = response.data.address.province;
                    this.postal_code = response.data.address.postal_code;
                    this.country = response.data.address.country;

                    this.shipment_address1 = response.data.address.shipment_address.address_1;
                    this.shipment_address2 = response.data.address.shipment_address.address_2;
                    this.shipment_city = response.data.address.shipment_address.city;
                    this.shipment_province = response.data.address.shipment_address.province;
                    this.shipment_postal_code = response.data.address.shipment_address.postal_code;
                    this.shipment_country = response.data.address.shipment_address.country;

                    this.billing_address1 = response.data.address.billing_address.address_1;
                    this.billing_address2 = response.data.address.billing_address.address_2;
                    this.billing_city = response.data.address.billing_address.city;
                    this.billing_province = response.data.address.billing_address.province;
                    this.billing_postal_code = response.data.address.billing_address.postal_code;
                    this.billing_country = response.data.address.billing_address.country;

                    authUser.role = response.data.roles[0].name;
                    authUser.authenticated = response.data.authenticated;
                    window.localStorage.setItem('nsUser', JSON.stringify(authUser));

                })
            },
          }


     
    }
</script>
