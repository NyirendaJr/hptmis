<template>
    <app-layout>
        <div class="page-dashboard">
            <v-container>
                <v-row>
                    <!-- mini statistic start -->
                    <v-col :cols="12" :sm="6" :lg="3">
                        <mini-statistic-card
                            icon="mdi-account-multiple-outline"
                            :title="totalPatients"
                            sub-title="Total patients"
                            color="indigo"
                        />
                    </v-col>
                    <!--<v-col :cols="12" :sm="6" :lg="3">
                        <mini-statistic-card
                            icon="mdi-google"
                            title="150+"
                            sub-title="Connections"
                            color="red"
                        />
                    </v-col>
                    <v-col :cols="12" :sm="6" :lg="3">
                        <mini-statistic-card
                            icon="mdi-twitter"
                            title="200+"
                            sub-title="Followers"
                            color="light-blue"
                        />
                    </v-col>
                    <v-col :cols="12" :sm="6" :lg="3">
                        <mini-statistic-card
                            icon="mdi-instagram"
                            title="50+"
                            sub-title="Shots"
                            color="purple"
                        />
                    </v-col>-->
                    <!-- mini statistic  end -->
                </v-row>
            </v-container>
        </div>
    </app-layout>
</template>


<script>
import * as API from '@/api/api'
import Material from 'vuetify/es5/util/colors'
import AppLayout from '@/Layouts/AppLayout'
import MiniStatisticCard from '@/components/card/MiniStatisticCard'
export default {
    name: 'PageDashboard',
    components: {
        AppLayout,
        MiniStatisticCard
    },
    props:['totalPatients'],
    data: () => ({}),
    created() {
        console.log(this.totalPatients)
    }
}
</script>
