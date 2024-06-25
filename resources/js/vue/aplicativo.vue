<template>
    <div class="todoListContainer">
        <div class="heading">
            <h2 id="title">Lista de Tarefas</h2>
            <add-item-form
                v-on:reloadList="getList()"
            />
        </div>
        <list-view
            :items="items"
            v-on:reloadList="getList()"
        />
    </div>
</template>

<script>
import listView from './listView'
import addItemForm from './addItemForm'

export default {
    components: {
        addItemForm,
        listView
    },
    data: function () {
        return {
            items: []
        }
    },
    methods: {
        getList() {
            axios.get('items').then(response => {
                this.items = response.data
            })
            .catch(error => {
                console.log(error);
            })
        }
    },
    created() {
        this.getList();
    }
}
</script>

<style scoped>
.todoListContainer {
    width: 500px;
    margin: auto;
}
.heading {
    background: #e6e6e6;
    padding: 10px;
}
#title {
    text-align: center;
    font-family: 'Nunito', serif;
    font-weight: bold;
    font-size: 32px;
}
</style>
