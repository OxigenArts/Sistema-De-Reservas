var editroutine = new Vue({
    el: "#edit",
    created: function() {
        this.fetch();
    },
    data: {
        routine_data: {}
    },
    methods: {
        fetch: function() {
            this.$http.get("./routines.json").then(function(response) {
                console.log(response);
            })
        },
        save: function() {

        }
    }
});