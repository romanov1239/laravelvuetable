<template>
    <svg class="icon"
         :class="'icon_type_' + type"
    >
        <use :href="svgUrl + '#' + type"></use>
    </svg>
</template>

<script setup lang="ts">
import svgUrl from '@/shared/assets/i/sprite/sprite.svg'

defineProps<{
    type?: string
}>()
</script>
