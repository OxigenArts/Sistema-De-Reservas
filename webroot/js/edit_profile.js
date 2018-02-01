function guid() {
    function s4() {
      return Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
    }
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
      s4() + '-' + s4() + s4() + s4();
  }

var editprofile = new Vue({
    el: "#edit",
    created: function() {
        this.fetch();
    },
    data: {
        profile_data: {},
        formData: {},
        profile_photo: ""
    },
    methods: {
        fetch: function() {
            this.$http.get("../profile/edit.json").then(function(response) {
                console.log(response.body);
                //this.profile_data = JSON.parse(response.body.json);
                this.profile_photo = response.body.photo.url;
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
        }
    }
});