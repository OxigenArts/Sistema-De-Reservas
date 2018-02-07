function guid() {
    function s4() {
      return Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
    }
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
      s4() + '-' + s4() + s4() + s4();
  }

var Photoshop = VueColor.Chrome;



Vue.component("selector-map", {
    template: "<div class='map-container'></div>",
    props: {
        lat: {
            default: 55.01657628017477
        },
        lon: {
            default: -7.309233337402361
        },
        pos: {
        }
    },
    data: function() {
        return {
            latitude: this.lat,
            longitude: this.lon
        }
    },
    mounted: function() {

        
        var myLatlng = new google.maps.LatLng(this.lat, this.lon);
      // Options
      var mapOptions = {
        zoom: 12,
        center: myLatlng
      };

      console.log(myLatlng, this.latitude, this.longitude, mapOptions);
      // Apply options
      var map = new google.maps.Map(this.$el, mapOptions);
      // Add marker
      var marker = new google.maps.Marker({
        position: myLatlng,
        map: map
      });
      marker.setMap(map);
      var self = this;
      google.maps.event.addListener(map, "center_changed", function() {
        var lat = map.getCenter().lat();
        var lon = map.getCenter().lng();
        var newLatLng = {lat: lat, lng: lon};
        marker.setPosition(newLatLng);
        editprofile.locationUpdated(newLatLng);
        //self.$emit('locationUpdated', newLatLng);
      });

    }
});

var editprofile = new Vue({
    el: "#edit",
    created: function() {
        this.fetch();
        moment().locale('es');
    },
    components: {
        'color-picker':Photoshop
    },
    data: {
        profile_data: {
        },
        formData: {},
        profile_photo: "",
        gallery_photos: [],
        background_photo: ""
    },
    methods: {
        fetch: function() {
            this.$http.get("../profile/edit.json").then(function(response) {
                console.log(response);
                if (response.body.profile.json == "") {
                    this.profile_data = {
                        location: {
                            lat: -5.129491,
                            lng: 1.203920
                        },
                        toolbar: {
                            color: {
                                hex: '#194d33',
                                hsl: { h: 150, s: 0.5, l: 0.2, a: 1 },
                                hsv: { h: 150, s: 0.66, v: 0.30, a: 1 },
                                rgba: { r: 25, g: 77, b: 51, a: 1 },
                                a: 1
                            },
                            textcolor: {
                                hex: '#194d33',
                                hsl: { h: 150, s: 0.5, l: 0.2, a: 1 },
                                hsv: { h: 150, s: 0.66, v: 0.30, a: 1 },
                                rgba: { r: 25, g: 77, b: 51, a: 1 },
                                a: 1
                            }
                        }
                    };
                } else {
                    this.profile_data = JSON.parse(response.body.profile.json);
                    if (!this.profile_data.toolbar) {
                        this.profile_data.toolbar = {
                            color: {
                                hex: '#194d33',
                                hsl: { h: 150, s: 0.5, l: 0.2, a: 1 },
                                hsv: { h: 150, s: 0.66, v: 0.30, a: 1 },
                                rgba: { r: 25, g: 77, b: 51, a: 1 },
                                a: 1
                            },
                            textcolor: {
                                hex: '#194d33',
                                hsl: { h: 150, s: 0.5, l: 0.2, a: 1 },
                                hsv: { h: 150, s: 0.66, v: 0.30, a: 1 },
                                rgba: { r: 25, g: 77, b: 51, a: 1 },
                                a: 1
                            }
                        }

                        this.save();
                    }

                    
                }

                
                this.profile_photo = response.body.profile.photo.url;
                
                if (response.body.profile.bgphoto) {
                    this.background_photo = response.body.profile.bgphoto.url;
                }
                this.gallery_photos = response.body.profile.gallery;
                //console.log(this.profile_data);
            });
        },
        save: function() {
            this.$http.post("../profile/edit.json", {json: JSON.stringify(this.profile_data)}).then(function(response) {
                this.fetch();
                this.formData.key = "";
                this.formData.value = "";
            })
        },
        addContact: function() {
            if (!this.profile_data.contact) {
                this.profile_data.contact = [];
            }

            if (this.formData.key != "" && this.formData.value != "") {
                this.profile_data.contact.push({
                    key: this.formData.key,
                    value: this.formData.value
                });

                this.save();
            }
            
        },
        removeContact: function(name) {
            var newContact = [];
            this.profile_data.contact.forEach(function(item, index) {
                if (item.key != name) {
                    newContact.push(item);
                }
            });

            this.profile_data.contact = newContact;
            this.save();
        },
        setPhoto: function(data) {
            var photo = this.$refs.profilePhoto.files[0];
            var formData = new FormData();
            formData.append('url', photo, guid()+'.jpg');
            this.$http.post("uploadprofilephoto.json", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response) {
                console.log(response);
                this.fetch();
            });
        },
        setBackgroundPhoto: function(data) {
            console.log("hello world");
            var photo = this.$refs.backgroundPhoto.files[0];
            var formData = new FormData();
            formData.append('url', photo, guid()+'.jpg');
            this.$http.post("uploadbackgroundphoto.json", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response) {
                console.log(response);
                this.fetch();
            });
        },
        addToGallery: function(data) {
            var photo = this.$refs.newGalleryPhoto.files[0];
            var formData = new FormData();

            formData.append('url', photo, guid()+'.jpg');
            this.$http.post('addtogallery.json', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response) {
                console.log("addToGallery: ",response);
                this.fetch();
            });
        },
        removeFromGallery: function(id) {
            this.$http.post("removefromgallery/"+id+".json").then(function(response) {
                console.log("removeFromGallery: ", response);
                this.fetch();
            });
        },
        locationUpdated: function(loc) {
            this.profile_data.location = loc;
        }
    }
});