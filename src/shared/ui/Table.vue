<template>
    <table class="table">
        <thead class="table__head">
        <TableHeadRow :columns="columns"
                      @sort-change="handleSortChange"
                      :sort-dir="sortDir"
                      :sort-key="sortKey"
        />
        </thead>
        <tbody class="table__body">
        <TransitionGroup name="slide">
            <TableBodyRow v-for="item in items"
                          :columns="columns"
                          :item="item"
                          :key="item[idKey]"
            />
        </TransitionGroup>
        </tbody>
    </table>
</template>

<script setup lang="ts">
import TableHeadRow from "@/shared/ui/TableHeadRow.vue";
import TableBodyRow from "@/shared/ui/TableBodyRow.vue";
import { TableColumns, TAvailableSorting } from "@/shared/ui/Table.types";

defineProps<{
    idKey: string,
    columns: TableColumns,
    items: Array<object>,
    sortDir: TAvailableSorting,
    sortKey: string
}>()

const emit = defineEmits<{
    (e: 'sort-change', sortDir: TAvailableSorting, sortKey: string)
}>()

function handleSortChange(sortDir, sortKey){
    emit('sort-change', sortDir, sortKey)
}
</script>
<style>
.slide-move {
    transition: transform 1s ease;
}
</style>
