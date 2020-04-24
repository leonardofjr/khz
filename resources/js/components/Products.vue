<template>
        <div>

            <hr>
            <h3 class="d-inline-block">Products</h3><router-link to="/product"> <button class="btn btn-primary" >Add New</button></router-link>
            <hr>
            <div class="form-group row">
                <label for="studioName" class="col-md-3 col-form-label">Studio Name</label>
                <div class="col-md-9">
                    <input id="studioName" type="text" class="form-control" v-model="this.$parent.studioName" name="studioName" required autocomplete="studioName" autofocus>
                </div>
            </div>
            
           
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
                    CKEDITOR.replace('studioDescription');
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
                            description : CKEDITOR.instances.studioDescription.getData(), 

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
