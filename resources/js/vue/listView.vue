<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <list-item
                :item="item"
                class="item"
                v-on:itemChanged="$emit('reloadList')"
            />
        </div>
    </div>
</template>

<script>
import listItem from './listItem'

export default {
    props: ['items'],
    components: {
        listItem
    }
}
</script>

<style>
.item {
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
    font-family: 'Nunito', serif;
}
</style>
