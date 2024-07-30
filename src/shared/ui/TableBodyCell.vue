<template>
    <td class="table__body-cell"
        :class="{
            'table__body-cell_actions': type === 'actions'
        }"
    >
        <div class="user-avatar user-avatar_size_s"
             v-if="type==='avatar'"
        >
            <div class="user-avatar__wrapper">
                <img class="user-avatar__image" :src="src" alt="avatar">
            </div>
        </div>
        <a :href="href" v-else-if="type === 'link'">
            <slot>
                {{ value }}
            </slot>
        </a>
        <slot v-else>{{ value }}</slot>
    </td>
</template>

<script setup lang="ts">
import { BodyColumnType } from "@/shared/ui/TableBodyRow.types";

const value = 'Отредактируй меня и сделай правильно'

defineProps<{
    type?: BodyColumnType,
    title?: string,
    minWidth?: boolean,
    href?: string,
    src?: string
}>()
</script>
