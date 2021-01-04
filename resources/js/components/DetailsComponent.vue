<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-header">Weather Forecast for {{ city }}</div>

                    <div class="card-body">
                        <div class="list-group list-group-flush" v-for="item in weatherList" v-bind:key="item.dt">
                            <div class="list-group-item list-group-item-action">
                                <p class="font-weight-bold">
                                    <img :src="weatherImgUrl + item.weather[0].icon + '.png'">
                                    {{ item.dt_txt }}
                                </p>
                                <div class="row">
                                    <div class="col-md-4 text-uppercase">{{ item.weather[0].description }}</div>
                                    <div class="col-md-4">TEMP: {{ item.main.temp }} K</div>
                                    <div class="col-md-4">PRESSURE: {{ item.main.pressure }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">Places To Visit in {{ city }}</div>

                    <div class="card-body">
                        <div class="list-group list-group-flush" v-for="venue in venuesList" v-bind:key="venue.id">
                            <div class="list-group-item list-group-item-action">
                                <p class="font-weight-bold">{{ venue.name }}</p>
                                <div>
                                    {{ venue.location.address }}, {{ venue.location.city }}, {{ venue.location.country }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const Weather = {
        data: function() {
            return { 
                city: this.$route.params.city,
                weatherList: {},
                venuesList: {},
                weatherImgUrl: 'http://openweathermap.org/img/w/'
            }
        },
        created: function() {
            const $this = this;
            const location = this.$route.params.city
            const venueAPI = `/api/location/${location}`
            const weatherAPI = `/api/weather/${location}`

            // get weather via laravel api
            this.axios.get(weatherAPI).then(function(resp) {
                if(resp.data.status) {
                    $this.weatherList = resp.data.data.content.list
                }
            })

            // get venues via laravel api
            this.axios.get(venueAPI).then(function(resp) {
                if(resp.data.status) {
                    $this.venuesList = resp.data.data.content.response.venues;
                }
            });
        },
    }

    export default Weather
</script>
