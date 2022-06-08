<template>
    <div class="row">
        <div class="col-2"> {{ item.continent_code }} </div>
        <div class="col-8"> {{ item.name }} </div>
        <b-button v-b-toggle="item.code" class="col-2" variant="primary">Country Detail</b-button>
        <b-collapse v-bind:id="item.code" class="mt-2">
            <b-card>
                <h3 class="card-text">{{ item.name }}</h3>
                <div class="row">
                    <div class="col-sm-6 col-lg-2 card-text">Code: </div>
                    <div class="col-sm-6 col-lg-10 card-text">{{ item.code }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-2 card-text">Full name: </div>
                    <div class="col-sm-6 col-lg-10 card-text">{{ item.full_name }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-2 card-text">ISO3: </div>
                    <div class="col-sm-6 col-lg-10 card-text">{{ item.iso3 }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-2 card-text">Continent code: </div>
                    <div class="col-sm-6 col-lg-10 card-text">{{ item.continent_code }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-2 card-text">Display order: </div>
                    <div class="col-sm-6 col-lg-10 card-text">{{ item.display_order }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-2 card-text">Number: </div>
                    <div class="col-sm-6 col-lg-10 card-text">{{ item.number }}</div>
                </div>
            </b-card>
        </b-collapse>
    </div>
</template>

<script>
    export default {
        name: "IndexItem",
        props: ['item']
    }
</script>

<style scoped>

</style>
