<template>
    <div>
        <b-navbar type="light" variant="primary" toggleable="lg">
            <b-navbar-brand class="nav-link logo" href="#">
                <h2>Countries</h2>
            </b-navbar-brand>
            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" class="text-white" is-nav>
                Placeholder link
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
import AddCountryForm from "../forms/AddCountryForm.vue";

export default {
    name: "MainNav",
    components: { AddCountryForm }
}
</script>

<style scoped>
.nav-link {
    margin-left: 1rem;
    color: white !important;
    transition: 0.3s;
}
.nav-link:hover {
    opacity: 0.8;
}
</style>
