var table = new Vue({
    el: "#table",
    created: function() {
        this.refreshTable();
    },
    data: {
        tabledata: {},
        elname: "reservation"
    },
    methods: {
        refreshTable: function() {
            this.$http.get(this.elname+'.json').then(function(response) {
                console.log(response);
                this.tabledata = response.body;
                this.tabledata.forEach(function(item, index) {
                    if (item.name) item.name = JSON.parse(item.name);
                });
            });

        },
        delete: function(id) {
            console.log("trying to delete id "+id);
            this.$http.delete(this.elname+"/delete/"+id+".json").then(function(response) {
                this.refreshTable();
                console.log(response);
            }, function(err) {
                console.log(err);
            })
        },
        accept: function(id) {
            console.log("trying to set status of "+id);
            this.$http.post(this.elname+"/setstatus/"+id+".json", {status: 'accepted'}).then(function(response) {
                console.log(response.body);
                this.refreshTable();
            })
        },
        dismiss: function(id) {
            console.log("trying to set status of "+id);
            this.$http.post(this.elname+"/setstatus/"+id+".json", {status: 'rejected'}).then(function(response) {
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