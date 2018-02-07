var table = new Vue({
    el: "#table",
    created: function() {

        if (window.location.href[window.location.href.length-1] == "/" ) {
            window.location.href[window.location.length-1] = "";
            window.location.replace(window.location.href);
        }
        //this.refreshTable();

    },
    data: {
        tabledata: {},
        elname: "",
        jsonfield: "",
        parseRequired: false
    },
    methods: {
        setElement: function(element, field, parseRequired) {
            this.elname = element;
            this.jsonfield = field;
            this.parseRequired = parseRequired;
            this.refreshTable();
            console.log("setting element", this.jsonfield);
        },
        refreshTable: function() {
            this.$http.get(this.elname+'.json').then(function(response) {
                console.log(response);
                this.tabledata = response.body;
                var self = this;
                if (this.parseRequired) {
                    this.tabledata.forEach(function(item, index) {
                        if (item[self.jsonfield]) item[self.jsonfield] = JSON.parse(item[self.jsonfield]);
                    });
                }
                
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
        edit: function(id) {
            window.location.replace(this.elname+"/edit/"+id);
        },
        getRandomId: function() {
            var S4 = function() {
                return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
             };
             return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
         
        },
        refresh: function() {
            this.$http.post(this.elname+"/edit.json").then(function(response) {
                console.log(response);
                this.refreshTable();
            })
        },
        dateFormatted: function(date) {
            return moment(date).format('dddd, MMMM Do YYYY');
        }
    }
});