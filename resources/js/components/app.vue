<template>
    <div>
        <main-nav/>
        <div class="view-container">
            <index-view></index-view>
        </div>
    </div>
</template>

<script>
import MainNav from "./navigation/MainNav.vue";
import IndexView from "./views/IndexView.vue";

export default {
    name: "App",
    components: { MainNav, IndexView },
}
</script>

<style scoped>
.view-container {
    margin: auto;
    max-width: 1400px;
    padding: 5px 0px 0px 10px;
}
</style>
