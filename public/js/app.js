new Vue({
    el: '#events',
    data: {
        event: { name: '', description: '', date: '' },
        events: []
    },
    ready: function() {
        this.fetchEvents();
    },
    methods: {
        // We dedicate a method to retrieving and setting some data
        fetchEvents: function () {
            var events = [
                {
                    id: 1,
                    name: 'TIFF',
                    description: 'Toronto International Film Festival',
                    date: '2015-09-10'
                },
                {
                    id: 2,
                    name: 'The Martian Premiere',
                    description: 'The Martian comes to theatres.',
                    date: '2015-10-02'
                },
                {
                    id: 3,
                    name: 'SXSW',
                    description: 'Music, film and interactive festival in Austin, TX.',
                    date: '2016-03-11'
                }
            ];
            // $set is a convenience method provided by Vue that is similar to pushing
            // data onto an array
            this.$set('events', events);
        },

        addEvent: function () {
            if (this.event.name) {
                this.events.push(this.event);
                this.event = {name: '', description: '', date: ''};
            }
        },

        deleteEvent: function(index) {
            if(confirm("Are you sure you want to delete this event?")) {
                // $remove is a Vue convenience method similar to splice
                this.events.$remove(index);
            }
        },


    }




});

this.$http.get('api/events').success(function(events) {
    this.$set('events', events);
}).error(function(error) {
    console.log(error);
});


this.$http.post('api/events', this.event).success(function(response) {
    this.events.push(this.event);
    console.log("Event added!");
}).error(function(error) {
    console.log(error);
});

this.$http.delete('api/events/' + event.id).success(function(response) {
    this.events.$remove(index);
}).error(function(error) {
    console.log(error);
});