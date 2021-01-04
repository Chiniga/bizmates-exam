<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <p class="card-header">{{ city }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const Weather = {
        created: function() {
            const location = this.$route.params.city
            const venueAPI = `/api/location/${location}`
            const weatherAPI = `/api/weather/${location}`

            // get weather via laravel api
            this.axios.get(weatherAPI, function(resp) {
                console.log(resp)
            })

            //
        },
        data: function() {
            return { 
                city: this.$route.params.city
            }
        }
    }

    export default Weather
</script>
