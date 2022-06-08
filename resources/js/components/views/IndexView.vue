<template>
    <div>
        <div class="row">
            <div class="col-6">
                <h1 class="main-text">Countries List</h1>
            </div>
            <div class="col-6">
                <add-country-form v-on:reloadindex="getIndex" class="nav-link"></add-country-form>
            </div>
        </div>
        <div class="item row bg-secondary text-white align-content-center">
            <div class="col-2">
                <div class="row">
                    <strong>Cont. code</strong>
                </div>
                <div class="row">
                    <form class="col-12 form-inline">
                        <label class="sr-only" for="inlineFormInputGroupUsername2" style="display:none">Username</label>
                        <div class="input-group mb-2 mr-sm-2">
                            <input type="text" v-model:value="q" class="form-control" id="inlineFormInputGroupUsername2" maxlength="2" placeholder="Search">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-8">
                <div class="row">
                    <strong>Country name </strong>
                </div>
                <div class="row">
                    <button class="mb-2 mr-sm-2 form-control col-2 btn-sort" @click="(sort === 'desc') ? sort = 'asc' : sort = 'desc'">{{ (sort === 'asc') ? 'A -> Z' : 'Z -> A' }}</button>
                </div>
            </div>
            <div class="col-2"> <strong>Details </strong></div>
        </div>
        <div v-for="(item, index) in items.data" :key="index">
            <index-item class="item" :item="item" />
        </div>
        <div>
            <ul class="pagination justify-content-center">
                <button :disabled="isActivePrev" @click="pageDown">Previous</button>
                <div class="pages">
                    <div class="row">
                        <div class="col">Page {{ items.current_page }} / {{ items.last_page }}</div>
                    </div>
                </div>
                <button :disabled="isActiveNext" @click="pageUp">Next</button>
            </ul>
        </div>
    </div>
</template>

<script>
import IndexItem from "./IndexItem.vue";
import AddCountryForm from "../forms/AddCountryForm.vue";

export default {
    name: "IndexView",
    components: { IndexItem, AddCountryForm },
    data: function () {
        return {
            sort: 'asc',
            items: [],
            q: '',
            isActivePrev: true,
            isActiveNext: false,
        }
    },
    watch: {
        q() {
            this.q = this.q.toUpperCase()
            this.getIndex()
        },
        sort() {
            this.getIndex()
        },
        items() {
            if (this.items.current_page === 1) {
                this.isActivePrev = true
            } else {
                this.isActivePrev = false
            }
            if (this.items.current_page === this.items.last_page) {
                this.isActiveNext = true
            } else {
                this.isActiveNext = false
            }
        }
    },
    methods: {
        getIndex() {
            axios.get('api/countries', {
                params: {
                    sort: this.sort,
                    q: this.q,
                    page: (this.items.current_page === undefined) ? 1 : this.items.current_page
                }
                })
                .then( response => {
                    this.items = response.data
                    console.log(this.items)
                })
                .catch( error => {
                    console.log(error)
                })
        },
        pageUp() {
            this.items.current_page = this.items.current_page + 1
            this.getIndex()
        },
        pageDown() {
            this.items.current_page = this.items.current_page - 1
            this.getIndex()
        }
    },
    mounted() {
        this.getIndex()
    }
}
</script>

<style scoped>
.item {
    margin: 0.5rem;
}
.nav-link {
    margin-left: 1rem;
    color: white !important;
    transition: 0.3s;
}
.nav-link:hover {
    opacity: 0.8;
}
.main-text {
    padding: 0.3rem 0rem 0rem 0.6rem;
}
.btn-sort {
    margin-left: calc(var(--bs-gutter-x) * 0.5);
    padding: 0.375rem 0.75rem;
    max-width: 7rem;
}
.pages {
    margin: 0.5rem;
}
</style>
