<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <p>Search for city in Japan</p>
                    <input v-model="city" v-on:keyup="getCityDetails" />
                    <p>{{ fourRes }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    let timeout

    const getCityDetails = () => {
        clearTimeout(timeout)
        timeout = setTimeout(() => {
            const data = axios.get(`/api/get-location/${city}`).then((result) => {

            })
        }, 3000)
    }

    const Weather = {
        data: () => {
            return { 
                city: "",
                fourRes: []
            }
        },
        methods: {
            getCityDetails: getCityDetails
        }
        
    }

    export default Weather
</script>
