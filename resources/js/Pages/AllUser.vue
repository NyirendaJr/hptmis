
<template>
    <app-layout>
        <v-container>
            <v-card tile flat>
                <v-card-title>{{ $t('users_title') }}</v-card-title>
                <v-divider/>
                <v-toolbar flat>
                    <v-text-field
                        autocomplete="off"
                        class="mt-3"
                        flat
                        v-model="query.keyword"
                        placeholder="Type here to search users..."
                        @keyup.enter.native="handleFilter"
                    />
                </v-toolbar>
                <v-divider/>
                <v-card flat class="grey lighten-4">
                    <v-card-text>
                        <v-row>
                            <v-col :cols="4">
                                <v-autocomplete
                                    clearable
                                    v-model="query.role"
                                    :items="roles"
                                    label="Roles"
                                    @change="handleFilter"
                                />
                            </v-col>
                            <!--<v-col :cols="4">
                                <v-autocomplete v-model="filter['filter[status]']" :items="getTaskStatus" label="Status" />
                            </v-col>-->
                        </v-row>
                    </v-card-text>
                    <!--<v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn text @click="handleResetFilter">Reset</v-btn>
                        <v-btn tile color="primary" @click="handleApplyFilter">Apply</v-btn>
                    </v-card-actions>-->
                </v-card>
                <v-card-text>
                    <v-data-table
                        :loading="userTableLoading"
                        :headers="usersTableHeaders"
                        :items="users"
                    >
                        <template #[`item.action`]="{item}">
                            <table-action :actions="tableActions" :item="item"/>
                        </template>
                    </v-data-table>
                </v-card-text>
            </v-card>
        </v-container>

        <!-- user permissions dialog -->
        <v-dialog v-model="userPermissionsDialog" width="900" persistent>
            <v-card :loading="loadingUserPermissions">
                <template slot="progress">
                    <v-progress-linear color="green" height="5" indeterminate/>
                </template>
                <v-card-title class="text-h5 grey lighten-2">
                    Edit Permissions for {{ currentUser.name }}
                </v-card-title>

                <v-card-text>
                    <v-container fluid>
                        <v-row>
                            <v-col cols="12" sm="6" md="6">
                                <h1 class="text-h6 lighten-2">Menus</h1>
                                <v-checkbox
                                    dense
                                    :disabled="disablePermissionsFromRole(menuPermission.value)"
                                    v-model="checkedPermissionKeys"
                                    v-for="menuPermission in menuPermissions"
                                    :key="menuPermission.value"
                                    :label="menuPermission.label"
                                    :value="menuPermission.value"
                                />
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <h1 class="text-h6 lighten-2">Permissions</h1>
                                <v-checkbox
                                    dense
                                    :disabled="disablePermissionsFromRole(otherPermission.value)"
                                    v-model="checkedPermissionKeys"
                                    v-for="otherPermission in otherPermissions"
                                    :key="otherPermission.value"
                                    :label="otherPermission.label"
                                    :value="otherPermission.value"
                                />
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>

                <v-divider/>

                <v-card-actions>
                    <v-spacer />
                    <v-btn color="red" dark @click="confirmPermission">
                        Confirm
                    </v-btn>
                    <v-btn @click="userPermissionsDialog = false">
                        Cancel
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- progressBar -->
        <progress-bar :visible="progressBarVisible" />

        <!-- user profile dialog -->
        <v-dialog v-model="userProfileDialog" persistent>
<!--            <user-profile />-->
        </v-dialog>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import * as API from '../api/api'
import TableAction from '@/components/TableAction'
import ProgressBar from "@/components/ProgressBar";
//import UserProfile from "./UserProfile";
export default {
    name: "AllUser",
    components: {
        AppLayout,
        TableAction,
        //UserProfile,
        ProgressBar
    },
    data() {
        return {
            usersTableHeaders: [
                {text: 'S/N', value: 'index'},
                {text: 'Name', value: 'name'},
                {text: 'Email', value: 'email'},
                {text: 'Roles', value: 'roles'},
                {text: 'Company', value: 'company'},
                {text: 'Actions', value: 'action'},
            ],
            userTableLoading: false,
            users: [],
            roles: [],
            query: {
                page: 1,
                limit: 15,
                keyword: '',
                role: '',
            },
            tableActions: [
                {text: 'View', icon: 'mdi-eye', click: this.handleViewUser},
                {text: 'Permissions', icon: 'mdi-pencil', click: this.handleEditPermissions},
            ],
            loadingUserPermissions: true,
            userPermissionsDialog: false,
            currentUserId: 0,
            currentUser: {
                name: '',
                permissions: [],
                rolePermissions: [],
            },
            permissionProps: {
                children: 'children',
                label: 'name',
                disabled: 'disabled',
            },
            permissions: [],
            menuPermissions: [],
            otherPermissions: [],
            checkedPermissionKeys: [],
            permissionsFromRole: [],
            progressBarVisible: false,
            userProfileDialog: false
        }
    },
    created() {
        this.getUsers()
        this.getRoles()
        this.getPermissions()
    },
    computed: {
        userMenuPermissions() {
            return this.classifyPermissions(this.userPermissions).menu;
        },
        userOtherPermissions() {
            return this.classifyPermissions(this.userPermissions).other;
        },
        userPermissions() {
            return this.currentUser.permissions.role.concat(this.currentUser.permissions.user);
        },
    },
    methods: {
        async getUsers() {
            this.userTableLoading = true
            const {limit, page} = this.query
            const response = await API.getUsers(this.query)
            const {data, meta} = response
            this.users = data
            this.serverItemsLength = meta.total
            this.itemsPerPage = meta.per_page
            this.users.forEach((element, index) => {
                element['index'] = (page - 1) * limit + index + 1
            })
            this.userTableLoading = false
        },

        async getPermissions() {
            const {data} = await API.getPermission({})
            const {all, menu, other} = this.classifyPermissions(data)
            this.permissions = all
            this.menuPermissions = menu
            this.otherPermissions = other
        },

        async getRoles() {
            const response = await API.getRoles()
            response.data.forEach((role) => {
                this.roles.push({text: role.name, value: role.name})
            });
        },

        handleFilter() {
            this.query.page = 1
            this.getUsers()
        },

        async handleEditPermissions(user) {
            this.loadingUserPermissions = true
            this.currentUserId = user.id
            this.userPermissionsDialog = true
            const { data } = await API.getUserPermissions(user.id)
            this.checkedPermissionKeys = this.permissionKeys(data.all)
            this.permissionsFromRole = data.role
            this.loadingUserPermissions = false
        },

        disablePermissionsFromRole(permissionId) {
            const foundPermission = this.permissionsFromRole.find(item => item.id === permissionId)
            if (foundPermission !== undefined) {
                return true
            }
        },

        permissionKeys(permissions) {
            return permissions.map(permssion => permssion.id)
        },

        async confirmPermission() {
            this.updateUserPermissionProgress = true
            await API.updateUserPermission(this.currentUserId, {
                permissions: this.checkedPermissionKeys
            })
            this.updateUserPermissionProgress = false
            this.userPermissionsDialog = false
        },

        classifyPermissions(permissions) {
            const all = [];
            const menu = [];
            const other = [];
            permissions.forEach(permission => {
                const permissionName = permission.name;
                all.push(permission);
                if (permissionName.startsWith('view menu')) {
                    menu.push(this.normalizeMenuPermission(permission));
                } else {
                    other.push(this.normalizePermission(permission));
                }
            });
            return {all, menu, other};
        },

        normalizeMenuPermission(permission) {
            return {value: permission.id, label: permission.name}
        },

        normalizePermission(permission) {
            return {value: permission.id, label: permission.name}
        },

        async handleViewUser(user) {
            //this.userProfileDialog = true
            window.location.replace(`users/${user.id}`)
        }
    }
}
</script>

<style scoped>

</style>
