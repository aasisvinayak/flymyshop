<div class="col-md-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                {{$reportTitle}}</h3>
        </div>
        <div class="panel-body">
            <div class="row">

                <div class="row">

                    <div  class="col-md-3">
                        <section id="labels">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="ao">
                                            <div class="ao-date">
                                                Today
                                            </div>

                                            <div class="ao-volume">

                                                {{$today}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>

                    <div  class="col-md-3">

                    </div>

                    <div  class="col-md-3">
                        <section id="labels">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="ao">
                                            <div class="ao-date">
                                                This Month
                                            </div>

                                            <div class="ao-volume">
                                                {{$thisMonth}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>
                </div>

                <div class="row">

                    <div  class="col-md-3">
                        <section id="labels">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="ao">
                                            <div class="ao-date">
                                                This Year
                                            </div>

                                            <div class="ao-volume">

                                                {{$thisYear}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>

                    <div  class="col-md-3">

                    </div>

                    <div  class="col-md-3">
                        <section id="labels">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="ao">
                                            <div class="ao-date">
                                                All Time
                                            </div>

                                            <div class="ao-volume">
                                                {{$allTime}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                    </div>
                </div>



            </div>
        </div>
    </div>
</div>