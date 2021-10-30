import request from "../util/request";

export function getRegions() {
    return request({
        url: 'regions',
        method: 'get'
    })
}

export function getRegionDistricts(regionId) {
    return request({
        url: `region-districts/${regionId}`,
        method: 'get'
    })
}

export function registerPatient(data) {
    return request({
        url: 'patients/register',
        method: 'post',
        data: data
    })
}


export function getPatients(data) {
    return request({
        url: 'patients/all',
        method: 'get',
        params: data
    })
}


//Permission and permissions
export function getPermission(query) {
    return request({
        url: '/admin/permissions',
        method: 'get',
        params: query,
    })
}

export function syncPermissions() {
    return request({
        url: '/admin/sync-permissions',
        method: 'get',
    })
}


export function getRoles() {
    return request({
        url: '/admin/roles',
        method: 'get',
    })
}

export function getRolePermissions(role) {
    return request({
        url: `admin/roles/${role}/permissions`,
        method: 'get',
    })
}

export function updateRolePermissions(role, data) {
    return request({
        url: `/admin/roles/${role}`,
        method: 'put',
        data: data
    })
}


//users
export function getUsers(data) {
    return request({
        url: `/admin/users`,
        method: 'get',
        params: data
    })
}

export function getUserPermissions(userId) {
    return request({
        url: `admin/users/${userId}/permissions`,
        method: 'get',
    })
}

export function updateUserPermission(id, permissions) {
    return request({
        url: `admin/users/${id}/permissions`,
        method: 'put',
        data: permissions,
    })
}



