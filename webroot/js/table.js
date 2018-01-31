var table = new Vue({
    el: "#table",
    created: function() {
        this.refreshTable();
    },
    data: {
        tabledata: {},
        elname: ""
    },
    methods: {
        refreshTable: function() {
            this.$http.get('../reservation.json').then(function(response) {
                this.tabledata = response.body[this.elname];
                this.tabledata.forEach(function(item, index) {
                    if (item.json) item.json = JSON.parse(item.json);
                });
            });

        },
        delete: function(id) {
            console.log("trying to delete id "+id);
            this.$http.delete("../reservation/delete/"+id+".json").then(function(response) {
                this.refreshTable();
                console.log(response);
            }, function(err) {
                console.log(err);
            })
        },
        accept: function(id) {
            console.log("trying to set status of "+id);
            this.$http.post("../reservation/setstatus/"+id+".json", {status: 'accepted'}).then(function(response) {
                console.log(response.body);
                this.refreshTable();
            })
        },
        dismiss: function(id) {
            console.log("trying to set status of "+id);
            this.$http.post("../reservation/setstatus/"+id+".json", {status: 'rejected'}).then(function(response) {
                console.log(response.body);
                this.refreshTable();
            })
        },
        getRandomId: function() {
            var S4 = function() {
                return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
             };
             return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
         
        }
    }
});