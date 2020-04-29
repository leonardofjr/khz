<template>
        <div>
            <hr>
            <h3>Order Details</h3>
            <hr>
                <div class="row">
                    <div class="col-md-4">
                        <ul class="list-unstyled ">
                            <li>{{fname + ' ' + lname}}</li>
                            <li>{{shipmentAddress}}</li>
                            <li>{{city + ', ' + province}}</li>
                            <li>{{country}}</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled ">
                            <li>Payment Method</li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-unstyled ">
                            <li>{{price}}</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul class="list-unstyled">
                        </ul>
                    </div>
                </div>

        </div>
</template>

<script>
import { create } from 'domain';

    export default {
            props: {
                id: {
                    type: String,
                    default: 'Leo',
                },
            },
            data() { return {
                fname: undefined,
                lname: undefined,
                shipmentAddress: undefined,
                city: undefined,
                country: undefined,
                province: undefined,
                price: undefined,
            }
        },
        mounted() {
            axios
            .get('/user/order_details/' + this.id)
            .then((response) => {
                console.log(response);
                this.fname = response.data.order.user.fname;
                this.lname = response.data.order.user.lname;
                this.shipmentAddress = response.data.order.shipment_address.address_1;
                this.city = response.data.order.shipment_address.city;
                this.province = response.data.order.shipment_address.province;
                this.country = response.data.order.shipment_address.country;
                this.price = response.data.product.price;
            })
        },
        methods: {
        }
    }
</script>
