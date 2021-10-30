<template>
    <app-layout>
        <v-toolbar flat height="50" class="mb-5">
            <v-toolbar-title>Manage Patients</v-toolbar-title>
        </v-toolbar>
        <v-container>
            <v-card flat>
                <v-card-title>Register new Patient</v-card-title>
                <v-divider />
                <v-card-text class="form-bg-color">
                    <validation-observer ref="patientFormValidation">
                        <v-form>
                            <label>National Identification Number</label>
                            <validation-provider v-slot="{ errors }" name="nin">
                                <v-text-field :error-messages="errors[0]" v-model="patient.nin" solo flat />
                            </validation-provider>

                            <v-row>
                                <v-col cols="12" md="4">
                                    <label>First Name</label>
                                    <validation-provider v-slot="{ errors }" name="first_name">
                                        <v-text-field :error-messages="errors[0]" v-model="patient.first_name" solo flat />
                                    </validation-provider>
                                </v-col>

                                <v-col cols="12" md="4">
                                    <label>Middle Name</label>
                                    <validation-provider v-slot="{ errors }" name="middle_name">
                                        <v-text-field :error-messages="errors[0]" v-model="patient.middle_name" solo flat />
                                    </validation-provider>
                                </v-col>

                                <v-col cols="12" md="4">
                                    <label>Last Name</label>
                                    <validation-provider v-slot="{ errors }" name="last_name">
                                        <v-text-field :error-messages="errors[0]" v-model="patient.last_name" solo flat />
                                    </validation-provider>
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col cols="12" md="6">
                                    <label>Gender</label>
                                    <validation-provider v-slot="{ errors }" name="gender">
                                        <v-select
                                            :error-messages="errors[0]"
                                            v-model="patient.gender"
                                            :items="genderOptions"
                                            solo flat
                                        />
                                    </validation-provider>
                                </v-col>

                                <v-col cols="12" md="6">
                                    <label>Date of Birth</label>
                                    <v-menu
                                        ref="menu"
                                        v-model="dobPickerVisible"
                                        :close-on-content-click="false"
                                        :return-value.sync="patient.dob"
                                        transition="scale-transition"
                                        offset-y
                                        min-width="auto"
                                    >
                                        <template v-slot:activator="{ on, attrs }">
                                            <validation-provider v-slot="{ errors }" name="dob">
                                                <v-text-field
                                                    :error-messages="errors[0]"
                                                    v-model="patient.dob"
                                                    readonly
                                                    v-bind="attrs"
                                                    v-on="on"
                                                    solo flat
                                                />
                                            </validation-provider>
                                        </template>
                                        <v-date-picker v-model="patient.dob" no-title scrollable>
                                            <v-spacer />
                                            <v-btn text color="primary" @click="dobPickerVisible = false">
                                                Cancel
                                            </v-btn>
                                            <v-btn text color="primary" @click="$refs.menu.save(patient.dob)">
                                                OK
                                            </v-btn>
                                        </v-date-picker>
                                    </v-menu>
                                </v-col>
                            </v-row>

                            <label>Residence</label>
                            <validation-provider v-slot="{ errors }" name="residence">
                                <v-text-field
                                    :error-messages="errors[0]"
                                    v-model="patient.residence"
                                    solo flat
                                />
                            </validation-provider>

                            <label>Phone Number</label>
                            <validation-provider v-slot="{ errors }" name="phone_number">
                                <v-text-field
                                    :error-messages="errors[0]"
                                    v-model="patient.phone_number"
                                    solo flat
                                />
                            </validation-provider>

                            <v-row>
                                <v-col cols="12" md="6">
                                    <label>Region</label>
                                    <validation-provider v-slot="{ errors }" name="region_id">
                                        <v-select
                                            :error-messages="errors[0]"
                                            v-model="patient.region_id"
                                            :items="regions"
                                            solo flat
                                            item-text="name"
                                            item-value="id"
                                            @change="getRegionDistricts($event)"
                                        />
                                    </validation-provider>
                                </v-col>

                                <v-col cols="12" md="6">
                                    <label>District</label>
                                    <validation-provider v-slot="{ errors }" name="district_id">
                                        <v-select
                                            :error-messages="errors[0]"
                                            v-model="patient.district_id"
                                            :items="districts"
                                            solo flat
                                            item-text="name"
                                            item-value="id"
                                        />
                                    </validation-provider>
                                </v-col>
                            </v-row>

                        </v-form>
                    </validation-observer>
                    <v-btn color="primary" class="mr-4" @click="registerPatient()">
                        Submit
                    </v-btn>
                </v-card-text>
            </v-card>
        </v-container>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import * as API from '@/api/api'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
export default {
    name: "RegisterPatient",
    components: {
        AppLayout,
        ValidationProvider,
        ValidationObserver
    },
    data() {
        return {
            patient: {
                nin: '',
                first_name: '',
                middle_name: '',
                last_name: '',
                dob: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
                gender: '',
                region_id: '',
                district_id: ''
            },
            genderOptions: ['Male', 'Female'],
            dobPickerVisible: false,
            regions: [],
            districts: [],
            healtFacilityId: this.$page.props.user.health_facility_id
        }
    },

    created() {
        this.getRegions();
        console.log(this.$page.props)
    },

    methods: {
        async getRegions() {
            const response = await API.getRegions()
            this.regions = response.data
        },

        async getRegionDistricts(regionId) {
            const response = await API.getRegionDistricts(regionId)
            this.districts = response.data
        },

        async registerPatient() {
            const payload = Object.assign({health_facility_id: this.healthFacilityId}, this.patient)
            const response = await API.registerPatient(payload)
            const { status, statusCode, errors} = response
            if (!status && statusCode===422) {
                this.$refs.patientFormValidation.setErrors(errors)
            } else {
                this.$store.commit('SHOW_SNACKBAR', {
                    text: 'Patient Registered successfully',
                    color: 'success'
                })
                this.clearPatientRegistrationForm()
            }
        },

        clearPatientRegistrationForm() {
            this.patient = {}
        }
    }
}
</script>

<style scoped>

</style>
