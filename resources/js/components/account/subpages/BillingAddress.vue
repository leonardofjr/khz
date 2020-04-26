<template>
        <div>
            <hr>
            <h3>Billing Address</h3>
            <hr>
            <div class="form-group row">
                <label for="address_1" class="col-md-3 col-form-label">Address 1</label>
                <div class="col-md-9">
                    <input id="address_1" type="text" class="form-control" v-model="this.$parent.$parent.billing_address1" required autocomplete="address_1" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="address_1" class="col-md-3 col-form-label">Address 2</label>
                <div class="col-md-9">
                    <input id="address_1" type="text" class="form-control" v-model="this.$parent.$parent.billing_address2" required autocomplete="address_1" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-md-3 col-form-label">City</label>
                <div class="col-md-9">
                    <input id="city" type="text" class="form-control" v-model="this.$parent.$parent.billing_city" required autocomplete="city" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="province" class="col-md-3 col-form-label">Province</label>
                <div class="col-md-9">
                    <input id="province" type="text" class="form-control" v-model="this.$parent.$parent.billing_province" required autocomplete="province" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="postal_code" class="col-md-3 col-form-label">Postal Code</label>
                <div class="col-md-9">
                    <input id="postal_code" type="text" class="form-control" v-model="this.$parent.$parent.billing_postal_code" required autocomplete="postal_code" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="country" class="col-md-3 col-form-label">Country</label>
                <div class="col-md-9">
                    <input id="country" type="text" class="form-control" v-model="this.$parent.$parent.billing_country" required autocomplete="country" autofocus>
                </div>
            </div>

        </div>
</template>

<script>
import { create } from 'domain';

    export default {
            data() { return {

            }
        },
        mounted() {
            
        },
        methods: {

           
        }
    }
</script>
