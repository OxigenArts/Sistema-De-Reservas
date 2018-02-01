function guid() {
    function s4() {
      return Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
    }
    return s4() + s4() + '-' + s4() + '-' + s4() + '-' +
      s4() + '-' + s4() + s4() + s4();
  }

var editreservation = new Vue({
    el: "#edit",
    created: function() {
        this.fetch();
    },
    data: {
        reservation_data: {},
        formData: {},
        editing: {},
        id: 0
    },
    methods: {
        fetch: function() {
            this.$http.get("../edit/"+this.id+".json").then(function(response) {
                console.log(response.body);
                this.reservation_data = response.body;
                this.reservation_data.name = JSON.parse(this.reservation_data.name);
                for (var a in this.reservation_data.name.data) {
                    this.editing[a] = false;
                }
                console.log(this.reservation_data);
            });
        },
        save: function() {
            this.$http.post("../edit/"+this.id+".json", {name: JSON.stringify(this.reservation_data.name)}).then(function(response) {
                this.fetch();
            })
        },
        setId(id) {
            this.id = id;
            this.fetch();
        },
        accept: function() {
            this.$http.post("../setstatus/"+this.id+".json", {status: "accepted"}).then(function(response) {
                console.log(response.body);
                this.fetch();
            });
        },
        dismiss: function() {
            this.$http.post("../setstatus/"+this.id+".json", {status: "rejected"}).then(function(response) {
                console.log(response.body);
                this.fetch();
            });
        },
        delete: function() {
            this.$http.delete("../delete/"+this.id+".json").then(function(response) {
                console.log(response);
                window.location.replace("..");
            })
        }
    }
});