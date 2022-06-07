<template>
    <div>
        <b-button v-b-modal.modal-prevent-closing class="btn-light">Add Country</b-button>
        <b-modal
            id="modal-prevent-closing"
            ref="modal"
            title="Add new country"
        >
            <b-form ref="form" @submit.stop.prevent="onSubmit" @reset="onReset" v-if="show">
                <b-form-group
                    id="input-group-1"
                    label="Code:"
                    label-for="input-1"
                    description="Two-letter country code (ISO 3166-1 alpha-2)."
                >
                    <b-form-input
                        id="input-1"
                        v-model="form.code"
                        type="text"
                        placeholder="Enter code"
                        maxlength="2"
                        required
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-2"
                    label="Name:"
                    label-for="input-2"
                    description="English country name."
                >
                    <b-form-input
                        id="input-2"
                        v-model="form.name"
                        type="text"
                        placeholder="Enter name"
                        maxlength="64"
                        required
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-3"
                    label="Full name:"
                    label-for="input-3"
                    description="Full English country name."
                >
                    <b-form-input
                        id="input-3"
                        v-model="form.full_name"
                        type="text"
                        placeholder="Enter full name"
                        maxlength="128"
                        required
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-4"
                    label="ISO3 code:"
                    label-for="input-4"
                    description="Three-letter country code (ISO 3166-1 alpha-3)."
                >
                    <b-form-input
                        id="input-4"
                        v-model="form.iso3"
                        type="text"
                        placeholder="Enter ISO3 code"
                        maxlength="3"
                        required
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-5"
                    label="Continent code:"
                    label-for="input-5"
                    description="Two-letter continent code (ISO 3166-1 alpha-3)."
                >
                    <b-form-input
                        id="input-5"
                        v-model="form.continent_code"
                        type="text"
                        placeholder="Enter continent code"
                        maxlength="2"
                        required
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-6"
                    label="Display order:"
                    label-for="input-6"
                    description="Defaults to 900."
                >
                    <b-form-input
                        id="input-6"
                        v-model="form.display_order"
                        type="number"
                        placeholder="Enter display order"
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-7"
                    label="Number:"
                    label-for="input-7"
                    description="Three-digit country number (ISO 3166-1 numeric)."
                >
                    <b-form-input
                        id="input-7"
                        v-model="form.number"
                        type="number"
                        placeholder="Enter number"
                    ></b-form-input>
                </b-form-group>

                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
            <p class='alert-danger' v-for="error in errors">
                {{ error }}
            </p>
            <template #modal-footer="{ ok, cancel, hide }">
                <b>Countries</b>
            </template>
        </b-modal>
    </div>
</template>

<script>
    export default {
        name: 'AddCountryForm',
        data: function () {
          return {
              form: {
                  code: '',
                  name: '',
                  full_name: '',
                  iso3: '',
                  continent_code: '',
                  display_order: 0,
                  number: 0
              },
              errors: {},
              show: true
          }
        },
        methods: {
            onSubmit() {
                const valid = this.$refs.form.checkValidity()
                if (!valid) {
                    return
                }
                this.form.code = this.form.code.toUpperCase()
                axios({
                    method: 'post',
                    url: 'api/country/store',
                    data: this.form,
                }).then( response => {
                    console.log(response)
                    if (response.data.errors === undefined) {
                        this.onReset()
                        this.$nextTick(() => {
                            this.$bvModal.hide('modal-prevent-closing')
                        })
                    } else {
                        this.errors = response.data.errors
                    }
                }).catch ( error => {
                    console.log(error);
                })
            },
            onReset(event) {
                if (event !== undefined)
                    event.preventDefault()
                // Reset our form values
                this.form.code = ''
                this.form.name = ''
                this.form.full_name = ''
                this.form.iso3 = ''
                this.form.continent_code = ''
                this.form.display_order = 0
                this.form.number = 0
                this.errors = []
                // Trick to reset/clear native browser form validation state
                this.show = false
                this.$nextTick(() => {
                    this.show = true
                })
            }
        }
    }
</script>

<style scoped>

</style>
