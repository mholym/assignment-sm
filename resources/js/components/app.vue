<template>
    <div>
        <main-nav/>
        <h1 class="main-text">Countries List</h1>
        <div class="view-container">
            Table
        </div>
    </div>
</template>

<script>
import MainNav from "./navigation/MainNav.vue";
import AddCountryForm from "./forms/AddCountryForm.vue";

export default {
    name: "App",
    components: { MainNav },
    mounted() {
        console.log('Component mounted.')
    }
}
</script>

<style scoped>
.view-container {
    margin: auto;
    max-width: 1400px;
    padding: 5px 0px 0px 10px;
}
.main-text {
    padding: 5px 0px 0px 10px;
}
</style>
