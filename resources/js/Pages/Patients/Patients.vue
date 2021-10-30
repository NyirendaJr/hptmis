<template>
    <app-layout>
        <v-toolbar flat height="50">
            <v-toolbar-title>
                {{ $t('manage_patients') }}
            </v-toolbar-title>
        </v-toolbar>
        <v-card class="grey lighten-3" flat>
            <v-card-text>
                <v-row>
                    <v-col cols="12" md="4">
                        <v-text-field v-model="listQuery.keyword" solo flat placeholder="Search Patients Here" @keyup.native.enter="handlePatientsFilter" />
                    </v-col>
                    <v-col cols="12" md="4">
                        <inertia-link :href="route('patients.create')">
                            <v-btn color="info" large>
                                <v-icon>mdi-plus</v-icon>
                                {{ $t('register_new_patient') }}
                            </v-btn>
                        </inertia-link>

                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
        <v-container>
            <v-card>
                <v-card-title>
                    {{ $t('patients') }}
                </v-card-title>
                <v-divider />
                <v-card-text>
                    <v-data-table
                        :headers="patientsTableHeaders"
                        :items="patients"
                    />
                </v-card-text>
            </v-card>
        </v-container>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout';
import * as API from '../../api/api'
export default {
    name: "Patients",
    components: {
        AppLayout
    },
    data () {
        return {
            patientsTableHeaders: [
                { text: 'S/N', value: 'index',},
                { text: 'NIN', value: 'nin' },
                { text: 'First Name', value: 'first_name' },
                { text: 'Last Name', value: 'last_name' },
                { text: 'Gender', value: 'gender' },
                { text: 'DOB', value: 'dob' },
            ],
            patients: [],
            listQuery: {
                keyword: ''
            }
        }
    },

    created() {
        this.getPatients()
    },

    methods: {
        async getPatients() {
            const response = await API.getPatients(this.listQuery)
            this.patients = response.data
            this.patients.forEach((element, index) => {
                element['index'] = index + 1;
            });
        },

        handlePatientsFilter() {
            console.log('Yes it is here now')
            this.getPatients()
        }
    }
}
</script>

<style scoped>

</style>
