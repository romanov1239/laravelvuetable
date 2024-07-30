<template>
    <tr class="table__body-row">
        <TableBodyCell v-for="column in columns"
                       v-bind="column"
                       :src="column.type === 'avatar' ? item[column.itemKey] : undefined"
                       :href="column.type === 'link' ? 'https://google.com' : undefined"
        >
            <template v-if="column.type !== 'actions' && column.itemKey">
                {{ item[column.itemKey] }}
            </template>
            <template v-else>
                <a class="button button_size_xs button_rounded button_no-text button_transparent" href="#">
                    <svg class="icon icon_type_pencil">
                        <use xlink:href="@/shared/assets/i/sprite/sprite.svg#pencil"></use>
                    </svg>
                </a>
                <a class="button button_size_xs button_rounded button_no-text button_transparent" href="#">
                    <svg class="icon icon_type_trash">
                        <use xlink:href="@/shared/assets/i/sprite/sprite.svg#trash"></use>
                    </svg>
                </a>
                <a class="button button_size_xs button_rounded button_no-text button_transparent" href="#">
                    <svg class="icon icon_type_check-circle">
                        <use xlink:href="@/shared/assets/i/sprite/sprite.svg#check-circle"></use>
                    </svg>
                </a>
            </template>
        </TableBodyCell>
    </tr>
</template>

<script setup lang="ts">
import TableBodyCell from "@/shared/ui/TableBodyCell.vue";
import { TBodyColumns } from "@/shared/ui/TableBodyRow.types";

defineProps<{
    columns: TBodyColumns,
    item: object
}>()
</script>
