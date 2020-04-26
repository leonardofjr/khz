<template>
        <div>
            <hr>
            <h3>Store</h3>
            <hr>
            <div class="form-group row">
                <label for="firstName" class="col-md-3 col-form-label">First Name</label>
                <div class="col-md-9">
                    <input id="firstName" type="text" class="form-control" v-model="this.$parent.firstName" name="firstName" required autocomplete="firstName" autofocus>
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
