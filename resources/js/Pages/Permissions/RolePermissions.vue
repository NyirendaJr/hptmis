<template>
    <app-layout>
        <v-toolbar flat height="50">
            <v-toolbar-title class="text-gray-500">
                {{ $t('manage_roles') }}
            </v-toolbar-title>
        </v-toolbar>

        <v-card flat class="grey lighten-3">
            <v-card-text>
                <v-row>
                    <v-col cols="12" md="4">
                        <v-text-field
                            solo
                            flat
                            placeholder="Search Roles..."
                            hide-details
                            clearable
                            append-icon="mdi-magnify"
                        />
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>

        <v-container>
            <v-card tile>
                <v-card-title class="text-gray-500">{{ $t('role_permissions_title') }}</v-card-title>
                <v-divider/>
                <v-card-text>
                    <v-data-table
                        :loading="loadingRoles"
                        :items="roles"
                        :headers="rolesTableHeaders"
                    >
                        <template #[`item.action`]="{item}">
                            <table-action :actions="tableActions" :item="item"/>
                        </template>
                    </v-data-table>
                </v-card-text>
            </v-card>
        </v-container>

        <!-- role permissions dialog -->
        <v-dialog v-model="rolePermissionsDialog" width="900">
            <v-card :loading="loadingRolePermissions">
                <template slot="progress">
                    <v-progress-linear color="green" height="5" indeterminate/>
                </template>
                <v-card-title class="grey lighten-2">
                    {{ roleName }} Role Permissions
                </v-card-title>

                <v-card-text>
                    <v-container fluid>
                        <v-row>
                            <v-col cols="12" sm="6" md="6">
                                <h1 class="text-h6 lighten-2">Menus</h1>
                                <v-checkbox
                                    dense
                                    v-model="checkedPermissionKeys"
                                    v-for="menuPermission in menuPermissions"
                                    :key="menuPermission.id"
                                    :label="menuPermission.label"
                                    :value="menuPermission.value"
                                />
                            </v-col>
                            <v-col cols="12" sm="6" md="6">
                                <h1 class="text-h6 lighten-2">Permissions</h1>
                                <v-checkbox
                                    dense
                                    v-model="checkedPermissionKeys"
                                    v-for="otherPermission in otherPermissions"
                                    :key="otherPermission.id"
                                    :label="otherPermission.label"
                                    :value="otherPermission.value"
                                />
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>

                <v-divider/>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red" dark @click="confirmPermission">
                        Confirm
                    </v-btn>
                    <v-btn @click="rolePermissionsDialog = false">
                        Cancel
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- progress bar -->
        <progress-bar :model-activator="updateRolePermissionProgress" />
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import * as API from '@/api/api'
import TooltipMixin from '@/mixins/Tooltip'
import ProgressBar from '@/components/ProgressBar'
import TableAction from "@/components/TableAction";
export default {
    name: "RolePermissions",
    mixins: [TooltipMixin],
    components: {
        AppLayout,
        ProgressBar,
        TableAction
    },
    data() {
        return {
            roles: [],
            rolesTableHeaders: [
                {text: 'Name', value: 'name'},
                {text: 'Description', value: 'description'},
                {text: 'Action', value: 'action'},
            ],
            loadingRoles: false,
            loadingRolePermissions: false,
            rolePermissionsDialog: false,
            updateRolePermissionProgress: false,
            permissions: [],
            menuPermissions: [],
            otherPermissions: [],
            checkedPermissionKeys: [],
            roleName: '',
            currentRoleId: null,
            tableActions: [
                {
                    text: 'Edit Permissions',
                    icon: 'mdi-pencil',
                    click: this.handleEditPermissions
                },
            ],
        }
    },

    created() {
        this.getRoles()
    },

    methods: {
        async getRoles() {
            this.loadingRoles = true
            const response = await API.getRoles()
            this.roles = response.data
            this.loadingRoles = false
        },

        // async getPermissions() {
        //     const response = await API.getPermission()
        //     const { all, menu, other } = this.classifyPermissions(response.data);
        //     this.permissions = all
        //     this.menuPermissions = menu
        //     this.otherPermissions = other
        // },

        async handleEditPermissions(role) {
            this.rolePermissionsDialog = true
            this.loadingRolePermissions = true
            this.roleName = role.name
            this.currentRoleId = role.id
            const response = await API.getPermission()
            const rolePermissionResponse = await API.getRolePermissions(role.id)
            const {all, menu, other} = this.classifyPermissions(response.data)
            this.permissions = all
            this.menuPermissions = menu
            this.otherPermissions = other
            this.checkedPermissionKeys = this.permissionKeys(rolePermissionResponse.data)
            this.loadingRolePermissions = false
        },

        permissionKeys(permissions) {
            return permissions.map(permssion => permssion.id)
        },

        normalizeMenuPermission(permission) {
            return {value: permission.id, label: permission.name}
        },

        normalizePermission(permission) {
            return {value: permission.id, label: permission.name, disabled: permission.name === 'manage permission'}
        },

        classifyPermissions(permissions) {
            const all = [];
            const menu = [];
            const other = []
            permissions.forEach(permission => {
                const permissionName = permission.name
                all.push(permission)
                if (permissionName.startsWith('view menu')) {
                    menu.push(this.normalizeMenuPermission(permission))
                } else {
                    other.push(this.normalizePermission(permission))
                }
            })
            return {all, menu, other}
        },

        async confirmPermission() {
            this.updateRolePermissionProgress = true
            await API.updateRolePermissions(this.currentRoleId, {permissions: this.checkedPermissionKeys})
            this.updateRolePermissionProgress = false
            this.rolePermissionsDialog = false
            await this.getRoles()
        },
    }
}
</script>

<style scoped>

</style>

