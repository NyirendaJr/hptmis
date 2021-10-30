<template>
    <v-menu>
        <template #activator="{ on: menu }">
            <v-tooltip bottom>
                <template #activator="{ on: tooltip }">
                    <v-btn icon v-on="onTooltip({ ...tooltip, ...menu })">
                        <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                </template>
                <span>Action</span>
            </v-tooltip>
        </template>
        <v-list class="pa-0" dense>
            <v-list-item v-for="action in actions" :key="action.text" @click="action.click(item)">
                <v-list-item-icon class="mr-2">
                    <v-icon small>{{ action.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-title>{{ action.text }}</v-list-item-title>
            </v-list-item>
        </v-list>
    </v-menu>
</template>

<script>
import TooltipMixin from '@/mixins/Tooltip'
export default {
    name: "TableAction",
    props: ['actions', 'item'],
    mixins: [TooltipMixin],
}
</script>

<style scoped>

</style>
