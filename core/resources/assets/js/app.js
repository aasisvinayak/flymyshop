new Vue({
    el: '#plugins',
    data: {
        names: [
            { fname: "Name 1" },
            { fname: "Name 2" },
            { fname: "Name 3" }
        ],
        test: 'test101',
        plugins: ''

    },

    ready: function () {
        this.getPlugins();
    },

    methods: {
        getPlugins: function () {
            that=this;
            $.get( "/plugin_list", function( data ) {
                that.plugins=data;
            });
        }

    },


});
