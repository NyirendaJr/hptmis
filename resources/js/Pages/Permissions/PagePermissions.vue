<template>
    <app-layout>
        <v-toolbar flat height="50">
            <v-toolbar-title class="text-gray-500">
                {{ $t('manage_permission') }}
            </v-toolbar-title>
        </v-toolbar>

        <v-card flat class="grey lighten-3">
            <v-card-text>
                <v-row>
                    <v-col cols="12" md="4">
                        <v-text-field solo flat placeholder="Search" />
                    </v-col>
                    <v-col cols="12" md="4">
                        <v-btn tile color="primary" large @click="handleSyncPermissions">
                            <v-icon>mdi-sync</v-icon>
                            Sync Permissions
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>

        <v-container>
            <v-card tile>
                <v-card-title class="text-gray-500">
                    {{ $t('page_permission_title') }}
                </v-card-title>
                <v-divider />
                <v-card-text class="pa-0">
                    <v-data-table
                        :loading="loadingItems"
                        :headers="headers"
                        :items="permissions"
                    >
                    </v-data-table>
                </v-card-text>
            </v-card>
        </v-container>

        <!-- sync permissions dialog -->
        <v-dialog v-model="dialogSyncPermissionVisible" persistent max-width="400px">
            <v-card>
                <v-card-title class="grey lighten-2 mb-3">
                    Permissions sync confirmation
                </v-card-title>
                <v-card-text>Are you sure you want to sync permissions?</v-card-text>
                <v-divider />
                <v-card-actions>
                    <v-spacer />
                    <v-btn color="red darken-1" dark @click="syncPermissions">
                        Yes
                    </v-btn>
                    <v-btn @click="dialogSyncPermissionVisible = false">
                        Cancel
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- progess bar -->
        <progress-bar :visible="progressBarVisible" />

    </app-layout>
</template>

<script>
import TooltipMixin from '@/mixins/Tooltip'
import AppLayout from '@/Layouts/AppLayout'
import * as API from '@/api/api';
import ProgressBar from "@/components/ProgressBar";

export default {
    components: {
        AppLayout,
        ProgressBar
    },
    mixins: [TooltipMixin],
    data() {
        return {
            query: {
                keyword: '',
                limit: 10,
                page: 1,
            },
            dialogSyncPermissionVisible: false,
            dialogSyncPermissionProgress: false,
            search: '',
            loadingItems: false,
            selectedItem: null,
            serverItemsLength: 0,
            itemsPerPage: 15,
            showFilter: true,
            filter: {
                page: 1,
                'filter[name]': null,
                'filter[project_id]': null,
                'filter[status]': null,
            },
            headers: [
                {
                    text: 'Name',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                { text: 'Description', value: 'description' },
                { text: 'Action', value: 'fat' },
            ],
            permissions: [],
            actions: [
                {
                    text: 'Edit Item',
                    icon: 'mdi-pencil',
                    click: this.handleEditItem,
                },
                {
                    text: 'Delete Item',
                    icon: 'mdi-close',
                    click: this.handleDeleteItem,
                },
            ],
            progressBarVisible: false
        }
    },

    created() {
        this.getPermissions();
    },

    methods: {
        updateFilterQuery(query) {
            const filter = Object.assign(this.filter, this.transformQuery(query))
            return filter
        },
        transformQuery(query) {
            const numbers = ['filter[project_id]', 'filter[status]', 'page']
            for (let key in query) {
                if (numbers.includes(key)) {
                    const val = query[key] ? parseInt(query[key]) : query[key]
                    query[key] = val
                }
            }
            return query
        },

        async getPermissions() {
            this.loadingItems = true
            const response = await API.getPermission()
            const { data, meta } = response
            this.permissions = data
            this.serverItemsLength = meta.total
            this.itemsPerPage = meta.per_page
            this.loadingItems = false
        },

        syncPermissions() {
            this.dialogSyncPermissionProgress = true
            this.dialogSyncPermissionVisible = false
            API.syncPermissions().then(() => {
                this.dialogSyncPermissionProgress = false
                this.getPermissions()
            });
        },

        getTaskStatus() {},

        handleSyncPermissions() {
            this.dialogSyncPermissionVisible = true;
        },

        handleUpdateStatus(item, status) {
            const payload = {
                id: item.id,
                data: {
                    status: status,
                },
            }
            this.$store.dispatch('updateTask', payload)
        },

        handleRefreshItem() {
            this.fetchRecords(this.filter)
        },

        // filter
        handlePageChanged(page) {
            this.filter.page = page
            this.filter.t = Date.now()
            this.$router.replace({
                path: this.$route.path,
                query: this.filter,
            })
        },

        handleResetFilter() {
            this.filter = {
                page: 1,
                'filter[name]': null,
                'filter[status]': null,
            }
            this.$router.replace({
                path: this.$route.path,
            })
        },

        handleApplyFilter() {
            this.filter.t = Date.now()
            this.$router.replace({
                path: this.$route.path,
                query: this.filter,
            })
        },

        handleClear() {
            this.resetFilter()
            this.filter.t = Date.now()
            this.$router.replace({
                path: this.$route.path,
                query: this.filter,
            })
        },

        handleFormSuccess() {
            this.showDialog = false
            this.fetchRecords()
        },
    },
}
</script>
