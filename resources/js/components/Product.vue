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
                    <input  type="number" class="form-control" v-model="this.$parent.productPrice" name="productPrice[]" autocomplete="productPrice" autofocus placeholder="$50/HR">
                </div>
            </div>
             
            <button class="btn btn-primary float-right" type="submit" v-on:click='submit()'>Save</button>

        </div>
</template>

<script>
    export default {
        data() {
            return {
                selectedService: "",
                studioDescription : '',
                    studioServiceDropdown: [
                    { name : '--Select Service--', value : '' },
                    { name : 'Recording', value : 'recording' },
                    { name : 'Mixing', value : 'mixing' },
                    { name : 'Recording & Mixing', value : 'recording_mixing' },
                    { name : 'Mixing & Mastering', value : 'mixing_mastering' },
                    { name : 'Video & Editing', value : 'video_editing' }
                ],
                lat: '',
                lon: '',
                promise: undefined,
                _token: this._token = $('meta[name="csrf-token"').attr('content')

            }
        },
        mounted() {
                    CKEDITOR.replace('productDescription');
        },
        methods: {
            submit() {
   

               
                    this.setData();
                axios({
                        method: 'post',
                        url : '/user_cpanel/studio',
                        headers: {
                            'X-CSRF' : this._token
                        },
                        data: {
                            name : $('input[name="studioName"]').val(), 
                            phone : $('input[name="phone"]').val(), 
                            phone : $('input[name="phone"]').val(), 
                            street_address : $('input[name="streetAddress"]').val(), 
                            city : $('input[name="city"]').val(), 
                            postal_code : $('input[name="postal_code"]').val(), 
                            territory : $('input[name="territory"]').val(), 
                            country : $('input[name="countryy"]').val(), 
                            description : CKEDITOR.instances.productDescription.getData(), 

                        }
                    }).then((response) => {
                        console.log(response);
                    })
            },
            setData() {
            },
            openSearchModal() {
                $('#searchModal').modal('show');
            }
            ,
            
            search() {
                    let query =  $('input[name="streetAddress"]').val();
                    console.log(query);
                    let params = 'format=json&addressdetails=1&limit=1&polygon_svg=1';
                    const osmUrl = 'https://nominatim.openstreetmap.org/search/' + query + '?' + params;

                    this.promise = axios
                    .get(osmUrl)
                    .then(response => {
                        console.log(response);
                        $('input[name="city"]').val(response.data[0].address.city);
                        $('input[name="territory"]').val(response.data[0].address.state);
                        $('input[name="country"]').val(response.data[0].address.country);
                        return  response.data[0];
                    });
                    this.destroyMapElement();
                    this.createMapElement();
                    this.renderMap();
       
            },

            renderMap() {     
                this.promise.then(data => {
                    this.mymap = L.map('mapid').setView([data.lat, data.lon], 13);
                    // this.mymap.locate({setView: true, maxZoom: 16});
        
                    const attribution = '&copy; <a href="https:///openstreetmap.org/copyright">OpenStreetMap</a> contributors';
                    const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

                    let tiles = L.tileLayer(tileUrl, {attribution});
                    tiles.addTo(this.mymap)
                    this.createUserMarker();
                });

            },
            createUserMarker() {
                    this.promise.then(data => {
                        
                    let LeafIcon = L.Icon.extend({
                    options: { 
                        //   shadowUrl: 'leaf-shadow.png',
                            iconSize:     [50, 50], // size of the icon
                            shadowSize:   [50, 64], // size of the shadow
                            iconAnchor:   [25, 25], // point of the icon which will correspond to marker's location
                            shadowAnchor: [4, 62],  // the same for the shadow
                            popupAnchor:  [-0, -25], // point from which the popup should open relative to the iconAnchor
                        }
                    });
                    let greenIcon = new LeafIcon({iconUrl: 'leaf-green.png'}),
                    redIcon = new LeafIcon({iconUrl: 'leaf-red.png'}),
                    orangeIcon = new LeafIcon({iconUrl: 'leaf-orange.png'});

                    L.marker(
                        [ data.lat, data.lon ], 
                        { icon: greenIcon, draggable: true, autoPan: true })
                        .addTo(this.mymap)
                        .bindPopup('<span class="font-weight-bold">' + this.name + '</span>' + '<br>Come Chill');
                })

                                        

            },

    

            createMapElement() {
                $('#mapContainer').append('<div id="mapid"></div>');
            },

            destroyMapElement() {
                $('#mapid').remove();
            },
            getCurrentUserLocation() {
                if (navigator.geolocation) {
                    // Utilizing HTML Geolocation API to locate user's position
                    return navigator.geolocation.getCurrentPosition(this.updateUserPosition);
                } else {
                    alert("Geolocation is not supported by this browser.");
                }
            },


    
        }
    
    }
</script>
