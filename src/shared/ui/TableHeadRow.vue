<template>
    <tr class="table__head-row">
        <TableHeadCell v-for="column in columns"
                       v-bind="column"
                       @sort-change="handleSortChange"
                       :sort-dir="sortKey === column.itemKey ? sortDir : ''"
        />
    </tr>
</template>

<script setup lang="ts">
import TableHeadCell from "@/shared/ui/TableHeadCell.vue";
import { TColumns } from "@/shared/ui/TableHeadRow.types";
import { TAvailableSorting } from "@/shared/ui/Table.types";

const props = defineProps<{
    columns: TColumns,
    sortDir: TAvailableSorting,
    sortKey: string
}>();

const emit = defineEmits<{
    (e: 'sort-change', sortDir: TAvailableSorting, sortKey: string)
}>()

function handleSortChange(sortDir, sortKey){
    emit('sort-change', sortDir, sortKey)
}
</script>
