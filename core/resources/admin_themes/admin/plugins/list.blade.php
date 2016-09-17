<!-- index.html -->

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Vue</title>

    <!-- CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>

<!-- navigation bar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <a class="navbar-brand"><i class="glyphicon glyphicon-bullhorn"></i> Vue Events Bulletin Board</a>
    </div>
</nav>

<!-- main body of our application -->
<div class="container" id="events">

    <!-- add an event form -->
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Add an Event</h3>
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <input class="form-control" placeholder="Event Name" v-model="event.name">
                </div>

                <div class="form-group">
                    <textarea class="form-control" placeholder="Event Description" v-model="event.description"></textarea>
                </div>

                <div class="form-group">
                    <input type="date" class="form-control" placeholder="Date" v-model="event.date">
                </div>

                <button class="btn btn-primary" v-on="click: addEvent">Submit</button>

            </div>

        </div>
    </div>

    <!-- show the events -->
    <div class="col-sm-6">
        <div class="list-group">

            <a href="#" class="list-group-item" v-repeat="event in events">
                <h4 class="list-group-item-heading">
                    <i class="glyphicon glyphicon-bullhorn"></i>
{{--                    {{ event.name }}--}}
                </h4>

                <h5>
                    <i class="glyphicon glyphicon-calendar" v-if="event.date"></i>
{{--                    {{ event.date }}--}}
                </h5>

{{--                <p class="list-group-item-text" v-if="event.description">{{ event.description }}</p>--}}

                <button class="btn btn-xs btn-danger" v-on="click: deleteEvent($index)">Delete</button>
            </a>


        </div>
    </div>
</div>

<!-- JS -->
<script src="/node_modules/vue/dist/vue.js"></script>
<script src="/node_modules/vue-resource/dist/vue-resource.js"></script>
<script src="/js/app.js"></script>
</body>
</html>