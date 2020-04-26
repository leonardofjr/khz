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
                                    <li v-if="role == 'producer' || 'admin'"><router-link to="/products" exact>Products</router-link></li>
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
                    this.lname = response.data.lname;
                    this.email = response.data.email;
                    this.role = response.data.roles[0].name;
                    this.address1 = response.data.address.address_1;
                    this.address2 = response.data.address.address_2;
                    this.city = response.data.address.city;
                    this.province = response.data.address.province;
                    this.postal_code = response.data.address.postal_code;
                    this.country = response.data.address.country;
                    authUser.role = response.data.roles[0].name;
                    authUser.authenticated = response.data.authenticated;
                    window.localStorage.setItem('nsUser', JSON.stringify(authUser));

                })
            },
          }


     
    }
</script>
