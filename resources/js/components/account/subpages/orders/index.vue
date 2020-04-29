<template>
        <div>
            <hr>
            <h3>Orders</h3>
            <hr>    

            <template v-for="product in products">
                <div class="row">
                    <div class="col-md-9">
                        <ul class="list-unstyled ">
                            <li>{{product.name}}</li>
                            <li class="text-danger">{{product.price}}</li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul class="list-unstyled">
                            <li class="text-danger"><router-link :to="{ path: 'orders/' + product.id }"><button>Order Details</button></router-link></li>
                        </ul>
                    </div>
                </div>
            </template>

        </div>
</template>

<script>
import { create } from 'domain';

    export default {

            data() { return {
                products: undefined
            }
        },
        mounted() {
            axios
            .get('/user/products')
            .then((response) => {
                this.products = response.data.data;
                console.log(response);
            })
        },
        methods: {

           
        }
    }
</script>
