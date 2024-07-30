<template>
    <div class="search" v-if="showSearch">
        <div class="textbox">
            <label class="textbox__wrapper">
                <input class="textbox__input"
                       type="text"
                       placeholder="Телефон, название..."
                       v-model.lazy="inputSearchString"
                >
            </label>
        </div>
        <a class="button" href="#"
           @click.prevent="search"
        >
            <svg class="icon icon_type_search">
                <use xlink:href="@/shared/assets/i/sprite/sprite.svg#search"></use>
            </svg>
            <span>Искать</span></a>
    </div>
    <div class="table-view">
        <Table :columns="columns"
               :items="items"
               :sort-dir="sortDir"
               :sort-key="sortColumn"
               id-key="id"
               @sort-change="handleSortChange"
        />
        <Pagination v-model="page"
                    :totalPages="5"
                    :pageLimit="limit"
                    :totalRecords="100"
        />
    </div>
</template>

<script setup lang="ts">
import Table from "@/shared/ui/Table.vue";
import { TableColumns } from "@/shared/ui/Table.types";
import { ref, watchEffect, computed } from 'vue';
import Pagination from "@/shared/ui/Pagination.vue";

defineProps<{
    showSearch?: boolean
}>()

const columns: TableColumns = [{
    minWidth: true,
    itemKey: 'avatar',
    type: 'avatar'
}, {
    title: 'ФИО',
    itemKey: 'fio',
}, {
    title: 'Имя',
    itemKey: 'name',
    type: 'link',
}, {
    title: 'Компания',
    itemKey: 'company',
}, {
    title: 'Должность',
    itemKey: 'position',
}, {
    type: 'actions',
}]

const items = ref([]);
const domain = 'http://localhost:8000';

const sortColumn = ref('company');
const sortDir = ref('asc');
const page = ref(1);
const limit = 100;

const searchString = ref('');
const inputSearchString = ref('');

function search(e){
    searchString.value = inputSearchString.value;
}

function handleSortChange(newSortDir, newSortKey){
    sortDir.value = newSortDir;
    sortColumn.value = newSortKey;
}

const apiUrl = computed(() => {
    const offset = (page.value - 1) * limit;
    let url = `${domain}/api/users?limit=${limit}&offset=${offset}`;
    if(sortColumn.value && sortDir.value){
        url += `&sortby=${sortColumn.value}&sortdir=${sortDir.value}`
    }
    if(searchString.value){
        url += `&_name=${searchString.value}`
    }
    return url
});

async function fetchDataFromServer() {
    return await fetch(apiUrl.value)
        .then((response) => response.json())
        .then((json) => {
            for(const item of json){
                item.avatar = item.avatar ? domain+item.avatar : item.avatar;
            }
            items.value = json
        })
        .catch((error) => {
            //TODO something

        })
    // .finally(() => {
    //     //TODO
    // })
}

watchEffect(fetchDataFromServer);
</script>
