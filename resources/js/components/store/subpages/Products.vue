<template>
        <div>
            <hr>
            <h3 class="d-inline-block">Products</h3><router-link to="/store/product"> <button class="btn btn-primary" >Add New</button></router-link>
            <hr>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">SKU</th>
                <th scope="col">Stock</th>
                <th scope="col">Price</th>
                <th scope="col">Categories</th>
                <th scope="col">Tags</th>
                </tr>
            </thead>
            <tbody>
                <template v-for="product in this.products">
                    <tr>
                        <th scope="row">{{product.id}}</th>
                        <td>{{product.name}}</td>
                        <td>{{product.sku}}</td>
                        <td>{{product.stock_status}}</td>
                        <td>{{product.price}}</td>
                        <td>
                            <template v-for="cat in product.product_cats">
                                {{cat.name}},
                            </template>
                        </td>
                        <td>{{product.tags}}</td>
                    </tr>
                </template>

            </tbody>
            </table>
        </div>
</template>

<script>
    export default {
        data() {
            return {
                product_cats : undefined,
                products: undefined,
                _token: this._token = $('meta[name="csrf-token"').attr('content')

            }
        },
        mounted() {
            this.getProducts();

        },
        methods: {
            getProducts() {
               axios({
                        method: 'get',
                        url : '/user_cpanel/product',
                      
                    }).then((response) => {
                        this.products = response.data;
                    })
            },
    
        }
    
    }
</script>
