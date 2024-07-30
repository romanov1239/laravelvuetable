<template>
    <div class="pagination">
        <div class="pagination__column">
            <div class="pagination__text pagination__text_range" v-if="pageLimit">
                {{ (page - 1) * pageLimit + 1 }} — {{ page * pageLimit }}
            </div>
            <div class="pagination__text" v-if="totalRecords">
                из {{ totalRecords }}
            </div>
        </div>
        <div class="pagination__column">
            <div class="pagination__text">страница
            </div>
            <div class="pagination__controls">
                <a class="button button_size_xs button_no-text" href="#"
                   :class="{
                        'button_disabled': page === 1
                   }"
                   @click.prevent="updatePage(page-1)"
                >
                    <svg class="icon icon_type_chevron-left">
                        <use xlink:href="@/shared/assets/i/sprite/sprite.svg#chevron-left"></use>
                    </svg>
                </a>
                <div class="textbox textbox_size_s textbox_text-center">
                    <label class="textbox__wrapper">
                        <input class="textbox__input"
                               type="text"
                               placeholder="Страница"
                               v-model.number="page"
                        />
                    </label>
                </div>
                <a class="button button_size_xs button_no-text" href="#"
                   :class="{
                        'button_disabled': totalPages && page === totalPages
                   }"
                   @click.prevent="updatePage(page+1)"
                >
                    <svg class="icon icon_type_chevron-right">
                        <use xlink:href="@/shared/assets/i/sprite/sprite.svg#chevron-right"></use>
                    </svg>
                </a>
            </div>
            <div class="pagination__text" v-if="totalPages">
                из {{ totalPages }}
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { computed } from "vue";

const props = defineProps<{
    modelValue: number,
    totalPages?: number,
    pageLimit?: number,
    totalRecords?: number
}>()

const emit = defineEmits<{
    (e: 'update:modelValue', value: number)
}>()

const page = computed({
    get(){
        return props.modelValue
    },
    set(value){
        emit('update:modelValue', value)
    }
});

function updatePage(newPageNumber){
    if(newPageNumber < 1) return;
    if(props.totalPages !== undefined && newPageNumber > props.totalPages) return;
    page.value = newPageNumber;
}
</script>
