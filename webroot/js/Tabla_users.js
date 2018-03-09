var user = new Vue({
    el: "#table",
    data: {
        tabledata: {},
        elname: "",
    },
    methods: {
        setElement: function(element) {
            this.elname = element;
            this.refreshTable();
        },
        refreshTable: function() {
            this.$http.get(this.elname+'.json').then(function(response) {
                
                this.tabledata = response.body;
                console.log(this.tabledata);
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
        
        edit: function(id) {
            window.location.replace(this.elname+"/edit/"+id);
        },
        getRandomId: function() {
            var S4 = function() {
                return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
             };
             return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
         
        }/*,
        refresh: function() {
            this.$http.post(this.elname+"/edit.json").then(function(response) {
                console.log(response);
                this.refreshTable();
            })
        },
        dateFormatted: function(date) {
            return moment(date).format('dddd, MMMM Do YYYY');
       }*/ 
    }
});