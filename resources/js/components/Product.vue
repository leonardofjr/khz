<template>
        <div>
            <hr>
            <h3>Add New Product</h3>
            <hr>
            <div class="form-group row">
                <label for="productName" class="col-md-3 col-form-label">Product Name</label>
                <div class="col-md-9">
                    <input id="productName" type="text" class="form-control" v-model="this.$parent.productName" name="productName" required autocomplete="productName" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="productSlug" class="col-md-3 col-form-label">Slug</label>
                <div class="col-md-9">
                    <input id="productSlug" type="text" class="form-control" v-model="this.$parent.productSlug" name="productSlug" required autocomplete="productSlug" autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="productSku" class="col-md-3 col-form-label">SKU</label>
                <div class="col-md-9">
                    <input id="productSku" type="text" class="form-control" v-model="this.$parent.productSku" name="productSku" required autocomplete="productSku" autofocus>
                </div>
            </div>

            <div class="form-group row">
            <label for="productStockStatus" class="col-md-3 col-form-label">Stock Status</label>
                <div class="col-md-9">
                    <select id="productStockStatus" name="productStockStatus" class="form-control"  required autocomplete="productStockStatus" autofocus>
                        <option selected>Choose...</option>
                        <option value="in_stock">In Stock</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="exampleFormControlFile1"  class="col-md-3 col-form-label">Track Filename</label>
                <div class="col-md-9">
                    <input type="file" accept=".mp3,audio/wav" class="form-control-file" id="exampleFormControlFile1">
                </div>
            </div>
            <div class="form-group row">
                <label class="form-check-label col-md-3">
                    Categories
                </label>
                <template v-for="cat in this.product_cats">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"  name="cats[]" :value="cat.name">
                        <label class="form-check-label" :for="cat.name">
                            {{cat.name}}
                        </label>
                    </div>
                </template>
  
            </div>

            <div class="form-group row">
                <label for="productDetails" class="col-md-3 col-form-label">Details</label>
                <div class="col-md-9">
                    <input id="productDetails" type="text" class="form-control" v-model="this.$parent.productDetails" name="productDetails" required autocomplete="productDetails" autofocus>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="productDescription" class="col-md-3 col-form-label">Description</label>
                <div class="col-md-9">
                      <textarea name="productDescription"></textarea>
                </div>
            </div>
         
            <div class="form-group row">
                <label for="productPrice" class="col-md-3 col-form-label">Price</label>
                <div class="col-md-9">
                    <input  type="number" class="form-control" v-model="this.$parent.productPrice" name="productPrice" autocomplete="productPrice" autofocus placeholder="$50">
                </div>
            </div>
            <div class="custom-control custom-switch">
                 <input type="checkbox" class="custom-control-input" id="customSwitch1" name="featured">
                  <label class="custom-control-label" for="customSwitch1">Featured</label>
            </div>

            <button class="btn btn-primary float-right" type="submit" v-on:click='submit()'>Add</button>

        </div>
</template>

<script>
    export default {
        data() {
            return {
                product_cats : undefined,
                _token: this._token = $('meta[name="csrf-token"').attr('content')

            }
        },
        mounted() {
                    CKEDITOR.replace('productDescription');

                    

            
            axios({
                method: 'get',
                url: '/user_cpanel/product/cats'
            }). then((response)=> {
                console.log(response);
                this.product_cats = response.data;
            })

        },
        methods: {
            submit() {
                let selected_cats = []
                $.each($('input[name="cats[]"]:checked'), function(e) {
                                selected_cats.push($(this).val()) ;
                })

                axios({
                        method: 'post',
                        url : '/user_cpanel/product/store',
                        headers: {
                            'X-CSRF' : this._token
                        },
                        data: {
                            name : $('input[name="productName"]').val(), 
                            slug : $('input[name="productSlug"]').val(), 
                            sku : $('input[name="productSku"]').val(), 
                            stockStatus : $('select[name="productStockStatus"]').val(), 
                            details : $('input[name="productDetails"]').val(), 
                            cats : selected_cats, 
                            tags : $('input[name="tags"]').val(), 
                            price : $('input[name="productPrice"]').val(), 
                            featured : $('input[name="featured"]').val(), 
                            description : CKEDITOR.instances.productDescription.getData(), 
                        }
                    }).then((response) => {
                        this.$router.back()
                    })
            },
         }
    }
</script>
