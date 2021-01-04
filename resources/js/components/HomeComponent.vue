<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <p class="card-header">Check for city in Japan</p>
                    <div class="card-body">
                        <div class="list-group list-group-flush" v-for="city in cities" v-bind:key="city">
                            <router-link :to="{name: 'view', params: { city: city }}" class="center list-group-item list-group-item-action">
                                {{ city }}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const Location = {
        data: () => {
            return { 
                cities: [
                    'Tokyo',
                    'Yokohama',
                    'Kyoto',
                    'Osaka',
                    'Sapporo',
                    'Nagoya'
                ],
            }
        },
    }

    export default Location
</script>
